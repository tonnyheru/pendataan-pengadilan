<style>
  .pemohon .select2-selection__rendered {
    padding: 0px 5px !important;
  }
  .disdukcapil .select2-selection__rendered {
    padding: 0px 5px !important;
  }
  .pemohon .select2-container .select2-selection--single {
      height: 75px !important;
  }
  .disdukcapil .select2-container .select2-selection--single {
      height: 75px !important;
  }
  .pemohon .select2-selection__arrow {
      height: 30px !important;
      top: 0px !important;
  }
  .disdukcapil .select2-selection__arrow {
      height: 30px !important;
      top: 0px !important;
  }
</style>
<div class="row">
  <div class="col-md-12 justify-content-start">
    <h5 style="color: #016004">Data Dokumen</h5>
    <hr class="bg-diy"style="height: 2px; margin-top: 0px !important; margin-bottom: 10px !important;">
  </div>
  <div class="form-group col-md-12">
    <label>Nomor Perkara <span class="text-danger">*</span></label>
    <input type="text" name="no_perkara" class="form-control" placeholder="Nomor Perkara" value="{{ @$data->submission->no_perkara }}">
  </div>

  <div class="form-group col-md-12 pemohon">
    <label>Pemohon <span class="text-danger">*</span></label>
    <select name="pemohon_uid" class="form-control select2-pemohon">
      <option value="" data-jk="" data-nik="asd"></option>
      @foreach ($pemohon as $item)
          <option value="{{ $item->uid }}" @if($item->uid == @$data->submission->pemohon_uid) selected @endif data-nik="{{ $item->nik }}" data-jk="{{ ucfirst(strtolower($item->jenis_kelamin)) }}">{{ $item->name }}</option>
      @endforeach
    </select>
  </div>

  <div class="form-group col-md-12 disdukcapil">
    <label>Delegasi Disdukcapil <span class="text-danger">*</span></label>
    <select name="disdukcapil" class="form-control select2-disdukcapil">
      <option value=""></option>
      @foreach ($disdukcapil as $item)
          <option value="{{ $item->uid }}" data-alamat="{{ $item->alamat }}" data-logo="{{ $item->cdn_picture }}" @if($item->uid == @$data->submission->disdukcapil_uid) selected @endif>{{ $item->nama }}</option>
      @endforeach
    </select>
  </div>

  <div class="form-group col-md-12">
    <label>Catatan</label>
    @if(@$data)
    @php
      $catatan = json_decode($data->submission->catatan);
    @endphp
    <textarea name="catatan" class="form-control" rows="2">{{ @$catatan[0]->catatan }}</textarea>
    @else
    <textarea name="catatan" class="form-control" rows="2"></textarea>
    @endif
  </div>

  <div class="col-md-12 justify-content-start">
    <h5 style="color: #016004">Data Suami</h5>
    <hr class="bg-diy"style="height: 2px; margin-top: 0px !important; margin-bottom: 10px !important;">
  </div>

  <div class="form-group col-md-6">
    <label>NIK Suami <span class="text-danger">*</span></label>
    <input type="text" name="nik_suami" class="form-control" placeholder="NIK Suami" value="{{ @$data->nik_suami }}" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"  maxlength="16">
  </div>
  <div class="form-group col-md-6">
    <label>KK Suami <span class="text-danger">*</span></label>
    <input type="text" name="kk_suami" class="form-control" placeholder="KK Suami" value="{{ @$data->kk_suami }}" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"  maxlength="16">
  </div>
  <div class="form-group col-md-6">
    <label>Paspor Suami</label>
    <input type="text" name="paspor_suami" class="form-control" placeholder="Paspor Suami" value="{{ @$data->paspor_suami }}">
  </div>
  <div class="form-group col-md-6">
    <label>Nama Suami <span class="text-danger">*</span></label>
    <input type="text" name="nama_suami" class="form-control" placeholder="Nama Suami" value="{{ @$data->nama_suami }}">
  </div>
  <div class="form-group col-md-6">
    <label>Tempat Lahir Suami <span class="text-danger">*</span></label>
    <input type="text" name="tempat_lahir_suami" class="form-control" placeholder="Tempat Lahir Suami" value="{{ @$data->tempat_lahir_suami }}">
  </div>
  <div class="form-group col-md-6">
    <label>Tanggal Lahir Suami <span class="text-danger">*</span></label>
    <div class='date'>
      <input type='text' class="form-control" name="tanggal_lahir_suami" id='tanggal_lahir_suami' style="background-color: white; " placeholder="Pilih Tanggal Lahir Suami" value="{{ @$data->tanggal_lahir_suami }}" />
    </div>
  </div>
  
  <div class="form-group col-md-12">
    <label>Alamat Lengkap Suami <span class="text-danger">*</span></label>
    <textarea name="alamat_suami" class="form-control" rows="3">{{ @$data->alamat_suami }}</textarea>
  </div>
  
  <div class="form-group col-md-6">
    <label>Perceraian Ke- <span class="text-danger">*</span></label>
    <input type="number" name="perceraian_ke" class="form-control" placeholder="Perceraian Ke" value="{{ @$data->perceraian_ke }}">
  </div>

  <div class="form-group col-md-6">
    <label>Kewarganegaraan Suami <span class="text-danger">*</span></label>
    <input type="text" name="kewarganegaraan_suami" class="form-control" placeholder="Kewarganegaraan Suami" value="{{ @$data->kewarganegaraan_suami }}">
  </div>

  <div class="col-md-12 justify-content-start">
    <h5 style="color: #016004">Data Istri</h5>
    <hr class="bg-diy"style="height: 2px; margin-top: 0px !important; margin-bottom: 10px !important;">
  </div>

  <div class="form-group col-md-6">
    <label>NIK Istri <span class="text-danger">*</span></label>
    <input type="text" name="nik_istri" class="form-control" placeholder="NIK Istri" value="{{ @$data->nik_istri }}" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"  maxlength="16">
  </div>
  <div class="form-group col-md-6">
    <label>KK Istri <span class="text-danger">*</span></label>
    <input type="text" name="kk_istri" class="form-control" placeholder="KK Istri" value="{{ @$data->kk_istri }}" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"  maxlength="16">
  </div>
  <div class="form-group col-md-6">
    <label>Paspor Istri</label>
    <input type="text" name="paspor_istri" class="form-control" placeholder="Paspor Istri" value="{{ @$data->paspor_istri }}" >
  </div>
  <div class="form-group col-md-6">
    <label>Nama Istri <span class="text-danger">*</span></label>
    <input type="text" name="nama_istri" class="form-control" placeholder="Nama Istri" value="{{ @$data->nama_istri }}">
  </div>
  <div class="form-group col-md-6">
    <label>Tempat Lahir Istri <span class="text-danger">*</span></label>
    <input type="text" name="tempat_lahir_istri" class="form-control" placeholder="Tempat Lahir Istri" value="{{ @$data->tempat_lahir_istri }}">
  </div>
  <div class="form-group col-md-6">
    <label>Tanggal Lahir Istri <span class="text-danger">*</span></label>
    <div class='date'>
      <input type='text' class="form-control" name="tanggal_lahir_istri" id='tanggal_lahir_istri' style="background-color: white; " placeholder="Pilih Tanggal Lahir Istri" value="{{ @$data->tanggal_lahir_istri }}" />
    </div>
  </div>
  
  <div class="form-group col-md-12">
    <label>Alamat Lengkap Istri <span class="text-danger">*</span></label>
    <textarea name="alamat_istri" class="form-control" rows="3">{{ @$data->alamat_istri }}</textarea>
  </div>
  <div class="form-group col-md-6">
    <label>Kewarganegaraan Istri <span class="text-danger">*</span></label>
    <input type="text" name="kewarganegaraan_istri" class="form-control" placeholder="Kewarganegaraan Istri" value="{{ @$data->kewarganegaraan_istri }}">
  </div>


  <div class="col-md-12 justify-content-start">
    <h5 style="color: #016004">Data Pendukung</h5>
    <hr class="bg-diy"style="height: 2px; margin-top: 0px !important; margin-bottom: 10px !important;">
  </div>

  <div class="form-group col-md-6">
    <label>Yang Mengajukan <span class="text-danger">*</span></label>
    <input type="text" name="yang_mengajukan" class="form-control" placeholder="Yang Mengajukan" value="{{ @$data->yang_mengajukan }}">
  </div>
  <div class="form-group col-md-6">
    <label>Nomor Akta Kawin <span class="text-danger">*</span></label>
    <input type="text" name="no_akta_kawin" class="form-control" placeholder="Nomor Akta Kawin" value="{{ @$data->no_akta_kawin }}">
  </div>
  <div class="form-group col-md-6">
    <label>Tanggal Akta Kawin <span class="text-danger">*</span></label>
    <div class='date'>
      <input type='text' class="form-control" name="tanggal_akta_kawin" id='tanggal_akta_kawin' style="background-color: white; " placeholder="Pilih Tanggal Akta Kawin" value="{{ @$data->tanggal_akta_kawin }}" />
    </div>
  </div>

  <div class="form-group col-md-6">
    <label>Tempat Perkawinan <span class="text-danger">*</span></label>
    <input type="text" name="tempat_perkawinan" class="form-control" placeholder="Tempat Perkawinan" value="{{ @$data->tempat_perkawinan }}">
  </div>

  <div class="form-group col-md-6">
    <label>Nomor Putusan <span class="text-danger">*</span></label>
    <input type="text" name="no_putusan" class="form-control" placeholder="Nomor Putusan" value="{{ @$data->no_putusan }}">
  </div>

  <div class="form-group col-md-6">
    <label>Tanggal Putusan <span class="text-danger">*</span></label>
    <div class='date'>
      <input type='text' class="form-control" name="tanggal_putusan" id='tanggal_putusan' style="background-color: white; " placeholder="Pilih Tanggal Putusan" value="{{ @$data->tanggal_putusan }}" />
    </div>
  </div>

  <div class="form-group col-md-12">
    <label>Sebab Perceraian <span class="text-danger">*</span></label>
    <textarea name="sebab_perceraian" class="form-control" rows="3">{{ @$data->sebab_perceraian }}</textarea>
  </div>

  <div class="form-group col-md-6">
    <label>Tanggal Lapor <span class="text-danger">*</span></label>
    <div class='date'>
      <input type='text' class="form-control" name="tanggal_lapor" id='tanggal_lapor' style="background-color: white; " placeholder="Pilih Tanggal Lapor" value="{{ @$data->tanggal_lapor }}" />
    </div>
  </div>

  <div class="form-group col-md-6">
    <label>Waktu Lapor <span class="text-danger">*</span></label>
    <div class='time'>
      <input type='text' class="form-control" name="waktu_lapor" id='waktu_lapor' style="background-color: white; " placeholder="Pilih Waktu Lapor" value="{{ @$data->waktu_lapor }}" />
    </div>
  </div>

  <div class="form-group col-md-12">
    <label>Keterangan</label>
    <textarea name="keterangan" class="form-control" rows="3">{{ @$data->keterangan }}</textarea>
  </div>


  <div class="col-md-12 justify-content-start">
    <h5 style="color: #016004">Dokumen-Dokumen</h5>
    <hr class="bg-diy"style="height: 2px; margin-top: 0px !important; margin-bottom: 10px !important;">
  </div>

  @if(@$data)
    <div class="col-md-12">
      <div class="alert alert-warning">
        Peringatan : <strong>Jika tidak ada perubahan pada dokumen, maka tinggalkan kosong saja.</strong>
      </div>
    </div>
  @endif
  @php
  $dokumen = [
    'penetapan_pengadilan' => 'Penetapan Pengadilan',
    'akta_perkawinan' => 'Akta Perkawinan (Asli)',
    'kk_suami' => 'Kartu Keluarga Suami',
    'ktp_suami' => 'KTP Suami',
    'kk_istri' => 'Kartu Keluarga Istri',
    'ktp_istri' => 'KTP Istri',
  ];
  @endphp
  @foreach($dokumen as $key => $dok)
    <div class="col-md-3">
        <label for="foto_{{$key}}">{{ $dok }} @if($key != 'keabsahan') @if(!@$data)<span class="text-danger">*</span> @endif @endif</label>
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
<script>
  $(() => {
    $('#tanggal_lahir_suami').flatpickr({
      static: true,
      dateFormat: "Y-m-d",
    })
    $('#tanggal_lahir_istri').flatpickr({
      static: true,
      dateFormat: "Y-m-d",
    })
    $('#tanggal_akta_kawin').flatpickr({
      static: true,
      dateFormat: "Y-m-d",
    })
    $('#tanggal_lapor').flatpickr({
      static: true,
      dateFormat: "Y-m-d",
    })
    $('#tanggal_putusan').flatpickr({
      static: true,
      dateFormat: "Y-m-d",
    })
    $('#waktu_lapor').flatpickr({
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        time_24hr: true
    })
    const dokumen = [
      'penetapan_pengadilan',
      'akta_perkawinan',
      'kk_suami',
      'ktp_suami',
      'kk_istri',
      'ktp_istri'
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
    $('.select2-pemohon').select2({
      placeholder: "Pilih Pemohon",
      allowClear: true,
      templateResult: formatResultPemohon,
      templateSelection: formatSelectionPemohon
    });

    // Helper functions for Select2
    function formatResultPemohon(res) {
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

    function formatSelectionPemohon(res) {
      const $container = $(`<span><img width='50' class='img-thumbnail' src='${base_url}img/default-avatar.png'/></div> <span class='selection-text'></span> </span>`);
      var nik = $(res.element).data('nik') || '';
      $container.find('.selection-text').text(res.text + (nik ? ' - ' : '') + nik || '-');
      return $container;
    }

    $('.select2-disdukcapil').select2({
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

    $('.select2-agama').select2({
      placeholder: "Pilih Agama",
      allowClear: true
    });

  })
</script>