<style>
  .select2-selection__rendered {
    padding: 0px 5px !important;
  }
  .select2-container .select2-selection--single {
      height: 75px !important;
  }
  .select2-selection__arrow {
      height: 30px !important;
      top: 0px !important;
  }
</style>
<div class="row">

    <div class="form-group col-md-6">
      <label>Nomor Perkara <span class="text-danger">*</span></label>
      <input type="text" name="no_perkara" class="form-control" placeholder="Nomor Perkara" value="{{ @$data->no_perkara }}">
    </div>

    <div class="form-group col-md-6">
      <label>Jenis Perkara <span class="text-danger">*</span></label>
      <input type="text" name="jenis_perkara" class="form-control" placeholder="Jenis Perkara" value="{{ @$data->jenis_perkara }}">
    </div>

    <div class="form-group col-md-12">
      <label>Pemohon <span class="text-danger">*</span></label>
      <select name="pemohon_uid" class="form-control select2-pemohon">
        <option value="" data-jk="" data-nik="asd"></option>
        @foreach ($pemohon as $item)
            <option value="{{ $item->uid }}" @if($item->uid == @$data->pemohon_uid) selected @endif data-nik="{{ $item->nik }}" data-jk="{{ ucfirst(strtolower($item->jenis_kelamin)) }}">{{ $item->name }}</option>
        @endforeach
      </select>
    </div>

    <div class="form-group col-md-12">
      <label>Delegasikan Ke <span class="text-danger">*</span></label>
      <select name="delegasi" class="form-control select2-delegasi">
        <option value=""></option>
        @foreach ($disdukcapil as $item)
            <option value="{{ $item->uid }}" data-alamat="{{ $item->alamat }}" data-logo="{{ $item->cdn_picture }}" @if($item->uid == @$data->disdukcapil_uid) selected @endif>{{ $item->nama }}</option>
        @endforeach

      </select>
    </div>

    @if(@$data)
    <div class="col-md-12">
        <div class="alert alert-warning">
            Peringatan : <strong>Jika tidak ada perubahan pada dokumen, maka tinggalkan kosong saja.</strong>
        </div>
    </div>
    @endif
    <div class="col-md-12 justify-content-md-start row">
        @php
        $dokumen = [
          'ktp' => 'KTP',
          'kk' => 'Kartu Keluarga',
          'akta' => 'Akta Kelahiran',
          'pendukung' => 'Dokumen Pendukung',
          'penetapan' => 'Dokumen Penetapan',
          'nikah' => 'Surat Nikah',
          'pengantar' => 'Surat Pengantar',
        ];
        @endphp
        @foreach($dokumen as $key => $dok)
        <div class="col-md-3">
            <label for="foto_{{$key}}">{{ $dok }} @if($key != 'pendukung') @if(!@$data)<span class="text-danger">*</span> @endif @endif</label>
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
            <input type="file" accept="image/jpeg, image/png, image/gif, application/pdf" name="file_{{$key}}" id="foto_{{$key}}" autocomplete="off" style="display: none;">
        </div>
        @endforeach
    </div>

</div>

<script>
  $(() => {
    const dokumen = [
      'ktp',
      'kk',
      'akta',
      'pendukung',
      'penetapan',
      'nikah',
      'pengantar',
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
              console.log('pdf')
              $(`#${dok}Preview`).hide();
              $(`#${dok}-pdfPlaceholder`).removeClass('d-none');
              $(`#${dok}-pdfPlaceholder`).addClass('d-flex');
              $(`#${dok}-filename`).text(fileName);
            } else {
              console.log('img')
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

    // Select2 Initialization
    $('.select2-pemohon').select2({
      placeholder: "Pilih Pemohon",
      allowClear: true,
      templateResult: formatResult,
      templateSelection: formatSelection
    });

    // Helper functions for Select2
    function formatResult(res) {
      if (!res.id) return res.text;
      const $container = $(
        `<div class='select2-result-repository clearfix'>
          <div class='select2-result-repository__avatar'><img src='${base_url}img/default-avatar.png'/></div>
          <div class='select2-result-repository__meta'>
            <div class='select2-result-repository__title'></div>
            <div class='select2-result-repository__description'></div>
          </div>
        </div>`
      );
      var nik = $(res.element).data('nik');
      var jenis_kelamin = $(res.element).data('jk');
      $container.find(".select2-result-repository__title").text(res.text || '-');
      $container.find(".select2-result-repository__description").html(nik ? `NIK : ${nik} <br> Jenis Kelamin : ${jenis_kelamin}` : '-');
      return $container;
    }

    function formatSelection(res) {
      const $container = $(`<span><img width='50' class='img-thumbnail' src='${base_url}img/default-avatar.png'/></div> <span class='selection-text'></span> </span>`);
      var nik = $(res.element).data('nik') || '';
      $container.find('.selection-text').text(res.text + (nik ? ' - ' : '') + nik || '-');
      return $container;
    }

    $('.select2-delegasi').select2({
      placeholder: "Pilih Kantor Disdukcapil",
      allowClear: true,
      templateResult: formatResultDelegasi,
      templateSelection: formatSelectionDelegasi
    });

    // Helper functions for Select2
    function formatResultDelegasi(res) {
      if (!res.id) return res.text;
      const $container = $(
        `<div class='select2-result-repository clearfix'>
          <div class='select2-result-repository__avatar'><img src='${base_url}img/default-kantor.png'/></div>
          <div class='select2-result-repository__meta'>
            <div class='select2-result-repository__title'></div>
            <div class='select2-result-repository__description'></div>
          </div>
        </div>`
      );
      
      var alamat = $(res.element).data('alamat');
      var logo = $(res.element).data('logo') || `${base_url}img/default-kantor.png`;
      $container.find(".select2-result-repository__title").text(res.text || '-');
      $container.find(".select2-result-repository__description").html(alamat ? `Alamat : ${alamat}` : '-');
      $container.find('.select2-result-repository__avatar img').attr('src', logo);
      return $container;
    }

    function formatSelectionDelegasi(res) {
      const $container = $(`<span><img width='50' class='img-thumbnail result-select2' src='${base_url}img/default-kantor.png'/></div> <span class='selection-text'></span> </span>`);
      
      var logo = $(res.element).data('logo') || `${base_url}img/default-kantor.png`;
      $container.find('.selection-text').text(res.text);
      $container.find('.result-select2').attr('src',logo);
      return $container;
    }
  })
</script>