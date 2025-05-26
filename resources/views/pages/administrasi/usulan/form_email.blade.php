<form action="{{ route('usulan.sendmail_process', $uid) }}" method="PUT" id="myForm" enctype="multipart/form-data">
    @csrf
    <div class="row">
      <div class="col-md-12">
          <div class="alert bg-diy">
            <table class="table table-borderless align-items-left table-flush table-header text-white">
              <thead>
                <tr>
                  <th scope="col" colspan="3">Detail Usulan</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    Nomor Perkara
                    <h3 class="text-white">{{@$submission->no_perkara}}</h3>
                  </td>
                  <td>
                    Jenis Perkara
                    <h3 class="text-white">{{ ucwords(str_replace('_', ' ', $submission->submission_type)) }}</h3>
                  </td>
                  <td>
                    Nama Pemohon
                    <h3 class="text-white">{{ ucwords(str_replace('_', ' ', @$submission->pemohon->name)) }}</h3>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
      </div>
      <div class="col-md-12 justify-content-md-center row">
          @php
          $dokumen = [
            'ktp' => 'KTP',
            'kk' => 'Kartu Keluarga',
            'akta' => 'Akta Kelahiran',
          ];
          @endphp
          @foreach($dokumen as $key => $dok)
          <div class="col-md-4">
              <label for="foto_{{$key}}">{{ $dok }}</label>
              <div class="{{$key}}_picker my-1 position-relative rounded overflow-hidden d-flex justify-content-center align-items-center" style="height: 150px; width: 150px; border: 1.5px dotted #dee2e6; cursor: pointer;">
                  <div class="text-center {{$key}}-upload-placeholder">
                      <i class="fas fa-upload fa-2x"></i>
                      <p class="small">Klik di sini untuk mengunggah gambar atau pdf</p>
                  </div>
                  <img id="{{$key}}Preview" src="" alt="Image Preview" class="img-thumbnail position-absolute w-100 h-100" style="object-fit: cover; display: none;">
                  <div id="{{$key}}-pdfPlaceholder" class="text-center position-absolute w-100 h-100 d-none flex-column justify-content-center align-items-center">
                      <i class="fas fa-file-pdf fa-3x text-danger"></i>
                      <p class="small mt-1" id="{{$key}}-filename">File PDF</p>
                  </div>
                  <div class="{{$key}}_loading_image_picker position-absolute w-100 h-100 d-none" style="backdrop-filter: blur(2px); top: 0; left: 0;">
                      <div class="d-flex justify-content-center align-items-center h-100">
                          <img src="{{ asset('img/loading2.gif') }}" style="height: 15px;">
                          <p class="small fw-bold ms-2">Tunggu Sebentar</p>
                      </div>
                  </div>
              </div>
              <input type="file" accept="image/jpeg, image/png, image/gif, application/pdf" name="attachments[]" id="foto_{{$key}}" autocomplete="off" style="display: none;">
          </div>
          @endforeach
      </div>
    </div>        
  </form>
  <div id="response_container"></div>

<script>
 $(() => {
  const dokumen = [
      'ktp',
      'kk',
      'akta',
    ]
    dokumen.forEach(dok => {
      $(`.${dok}_picker`).on('click', function() {
          $(`#foto_${dok}`).click();
      });
  
      $(`#foto_${dok}`).change(function() {
        const file = this.files[0];
        const fileType = file['type'];
        const fileName = file.name;
        const validImageTypes = ['image/jpeg', 'image/png', 'image/gif'];
        const validFileTypes = [...validImageTypes, 'application/pdf'];
        
        if ($.inArray(fileType, validFileTypes) < 0) {
            Ryuna.noty('warning', '', 'Hanya file gambar (JPG, PNG, GIF) atau PDF yang diperbolehkan.')
            $(this).val(''); // Clear the input if invalid file
            $(`#${dok}Preview`).hide();
            
            $(`#${dok}-pdfPlaceholder`).removeClass('d-flex');
            $(`#${dok}-pdfPlaceholder`).addClass('d-none');
  
            $(`#${dok}-filename`).text("");
            $(`.${dok}-upload-placeholder`).show();
            return false;
          }
          
          const reader = new FileReader();
          reader.onload = function(e) {
            if (fileType === 'application/pdf') {
              $(`#${dok}Preview`).hide();
              $(`#${dok}-pdfPlaceholder`).removeClass('d-none');
              $(`#${dok}-pdfPlaceholder`).addClass('d-flex');
              $(`#${dok}-filename`).text(fileName);
            } else {
              $(`#${dok}Preview`).attr('src', e.target.result).show();
              $(`#${dok}-filename`).text("");
              $(`#${dok}-pdfPlaceholder`).removeClass('d-flex');
              $(`#${dok}-pdfPlaceholder`).addClass('d-none');
            }
          $(`.${dok}-upload-placeholder`).hide();
        }
        reader.readAsDataURL(file);
  
        $(`.${dok}_loading_image_picker`).removeClass('d-none');
  
        // Simulate loading delay for demo purposes
        setTimeout(function() {
            $(`.${dok}_loading_image_picker`).addClass('d-none');
        }, 1000); // Adjust as needed
      });
    });
 }) 
</script>
    