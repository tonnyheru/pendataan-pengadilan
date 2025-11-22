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
    <h5 style="color: #016004">Data Pengadilan</h5>
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
  <input type="hidden" name="disdukcapil_nama" id="disdukcapil_nama">


  <div class="form-group col-md-6">
    <label>Jenis Akta <span class="text-danger">*</span></label>
    <select name="jenis_akta" class="form-control select2-jenis-akta">
      <option value=""></option>
      <option value="akta_kelahiran" @if(@$data->jenis_akta == 'akta_kelahiran') selected @endif>Akta Kelahiran</option>
      <option value="akta_kematian" @if(@$data->jenis_akta == 'akta_kematian') selected @endif>Akta Kematian</option>
      <option value="akta_perkawinan" @if(@$data->jenis_akta == 'akta_perkawinan') selected @endif>Akta Perkawinan</option>
      <option value="akta_perceraian" @if(@$data->jenis_akta == 'akta_perceraian') selected @endif>Akta Perceraian</option>
    </select>
  </div>

  <div class="form-group col-md-6">
    <label>Nomor Akta <span class="text-danger">*</span></label>
    <input type="text" name="no_akta" class="form-control" placeholder="Nomor Akta" value="{{ @$data->nomor_akta }}">
  </div>

  <div class="form-group col-md-12">
    <label>Elemen Perbaikan / Perubahan <span class="text-danger">*</span></label>
    <select name="jenis_elemen_perbaikan" class="form-control select2-elemen-perbaikan">
      <option value=""></option>
      <option value="nama" @if(@$data->jenis_elemen_perbaikan == 'nama') selected @endif>Nama</option>
      <option value="tempat_lahir" @if(@$data->jenis_elemen_perbaikan == 'tempat_lahir') selected @endif>Tempat Lahir</option>
      <option value="tanggal_lahir" @if(@$data->jenis_elemen_perbaikan == 'tanggal_lahir') selected @endif>Tanggal Lahir</option>
      <option value="jenis_kelamin" @if(@$data->jenis_elemen_perbaikan == 'jenis_kelamin') selected @endif>Jenis Kelamin</option>
    </select>
  </div>

  <div class="form-group col-md-6">
    <label>Data Sebelum Diubah <span class="text-danger">*</span></label>
    <input type="text" name="data_sebelum" class="form-control" placeholder="Data Sebelum Diubah" value="{{ @$data->data_sebelum }}">
  </div>

  <div class="form-group col-md-6">
    <label>Data Setelah Diubah <span class="text-danger">*</span></label>
    <input type="text" name="data_sesudah" class="form-control" placeholder="Data Setelah Diubah" value="{{ @$data->data_sesudah }}">
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
  @if(@$data)
    <div class="col-md-12">
      <div class="alert alert-warning">
        Peringatan : <strong>Jika tidak ada perubahan pada dokumen, maka tinggalkan kosong saja.</strong>
      </div>
    </div>
  @endif
</div>
<div class="row" id="form-cimahi" style="display: none;">
  <div class="col-md-12 justify-content-start">
    <h5 style="color: #016004">Data Yang Diusulkan</h5>
    <hr class="bg-diy"style="height: 2px; margin-top: 0px !important; margin-bottom: 10px !important;">
  </div>
  {{-- provinsi --}}
  <div class="form-group col-md-6">
    <label>Provinsi <span class="text-danger">*</span></label>
    <select id="province" class="form-control select2-province" name="subject[province]" data-selected="{{ @$data->province }}" aria-describedby="validateProvince">
        <option value=""></option>
        @foreach($provinces as $province)
            <option value="{{ $province->id }}">{{ $province->name }}</option>
        @endforeach
    </select>
    <div id="validateProvince" class="invalid-feedback">
      Kolom provinsi harus diisi.
    </div>
  </div>
  {{-- kabupaten / kota --}}
  <div class="form-group col-md-6">
    <label>Kabupaten / Kota <span class="text-danger">*</span></label>
    <select id="regency" class="form-control select2-regency" name="subject[regency]" data-selected="{{ @$data->regency }}" aria-describedby="validateRegency">
        <option value=""></option>
    </select>
    <div id="validateRegency" class="invalid-feedback">
      Kolom Kabupaten / Kota harus diisi.
    </div>
  </div>
  {{-- kecamatan --}}
  <div class="form-group col-md-6">
    <label>Kecamatan <span class="text-danger">*</span></label>
    <select id="district" class="form-control select2-district" name="subject[district]" data-selected="{{ @$data->district }}" aria-describedby="validateDistrict">
        <option value=""></option>
    </select>
    <div id="validateDistrict" class="invalid-feedback">
      Kolom Kecamatan harus diisi.
    </div>
  </div>
  {{-- desa / kelurahan --}}
  <div class="form-group col-md-6">
    <label>Desa / Kelurahan <span class="text-danger">*</span></label>
    <select id="village" class="form-control select2-village" name="subject[village]" data-selected="{{ @$data->village }}" aria-describedby="validateVillage">
        <option value=""></option>
    </select>
    <div id="validateVillage" class="invalid-feedback">
      Kolom Desa / Kelurahan harus diisi.
    </div>
  </div>

  <div class="form-group col-md-12">
    <label>Nomor Induk Kependudukan (NIK) <span class="text-danger">*</span></label>
    <input type="text" name="subject[nik]" class="form-control" placeholder="Nomor NIK" value="{{ @$data->nik }}" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"  maxlength="16">
  </div>
  <div class="form-group col-md-6">
    <label>Nama Yang Diusulkan <span class="text-danger">*</span></label>
    <input type="text" name="subject[name]" class="form-control" placeholder="Nama Yang Diusulkan" value="{{ @$data->name }}">
  </div>
  <div class="form-group col-md-6">
    <label>Jenis Kelamin</label>
    <select id="gender" class="form-control select2-gender" name="subject[gender]" >
        <option value=""></option>
        <option value="1" {{ @$data->gender == '1' ? 'selected' : '' }}>1 - Laki-laki</option>
        <option value="2" {{ @$data->gender == '2' ? 'selected' : '' }}>2 - Perempuan</option>
    </select>
  </div>
  <div class="form-group col-md-6">
    <label>Tempat Lahir</label>
    <input type="text" name="subject[tempat_lahir]" class="form-control" placeholder="Tempat Lahir" value="{{ @$data->tempat_lahir }}" aria-describedby="validateTempatLahir">
    <div id="validateTempatLahir" class="invalid-feedback">
      Kolom Tempat Lahir harus diisi.
    </div>
  </div>
  <div class="form-group col-md-6">
    <label>Tanggal Lahir</label>
    <div class='date'>
      <input type='text' class="form-control" name="subject[tanggal_lahir]" id='tanggal_lahir' style="background-color: white; " placeholder="Pilih Tanggal Lahir" value="{{ @$data->tanggal_lahir }}"  aria-describedby="validateTanggalLahir" />
      <div id="validateTanggalLahir" class="invalid-feedback">
        Kolom Tanggal Lahir harus diisi.
      </div>
    </div>
  </div>
  <div class="form-group col-md-12">
    <label>Akta Kelahiran</label>
    <input type="text" name="subject[akta_kelahiran]" class="form-control" placeholder="Akta Kelahiran" value="{{ @$data->akta_kelahiran }}">
  </div>
  <div class="form-group col-md-6">
    <label>Golongan Darah</label>
    <select id="blood_type" class="form-control select2-blood-type" name="subject[blood_type]">
        <option value=""></option>
        @foreach(\App\Helpers\DataHelper::getGolonganDarah() as $key => $value)
            <option value="{{ $key }}" {{ @$data->blood_type == $key ? 'selected' : '' }}>{{ $value }}</option>
        @endforeach
    </select>
  </div>
  <div class="form-group col-md-6">
    <label>Agama</label>
    <select id="religion" class="form-control select2-religion" name="subject[religion]">
        <option value=""></option>
        @foreach(\App\Helpers\DataHelper::getAgama() as $key => $value)
            <option value="{{ $key }}" {{ @$data->agama == $key ? 'selected' : '' }}>{{ $key }} - {{ $value }}</option>
        @endforeach
    </select>
  </div>
  <div class="form-group col-md-12">
    <label>Status Kawin</label>
    <select id="marital_status" class="form-control select2-marital-status" name="subject[status_kawin]">
        <option value=""></option>
        @foreach(\App\Helpers\DataHelper::getStatusPernikahan() as $key => $value)
            <option value="{{ $key }}" {{ @$data->status_kawin == $key ? 'selected' : '' }}>{{ $key }} - {{ $value }}</option>
        @endforeach
    </select>
  </div>
  <div class="form-group col-md-6">
      <label>Akta Kawin</label>
      <input type="text" name="subject[akta_kawin]" class="form-control" placeholder="Akta Kawin" value="{{ @$data->akta_kawin }}">
  </div>
  <div class="form-group col-md-6">
    <label>Tanggal Kawin</label>
    <div class='date'>
      <input type='text' class="form-control" name="subject[tanggal_kawin]" id='tanggal_kawin' style="background-color: white; " placeholder="Pilih Tanggal Kawin" value="{{ @$data->tanggal_kawin }}" />
    </div>
  </div>
  <div class="form-group col-md-6">
      <label>Akta Cerai</label>
      <input type="text" name="subject[akta_cerai]" class="form-control" placeholder="Akta Cerai" value="{{ @$data->akta_cerai }}">
  </div>
  <div class="form-group col-md-6">
    <label>Tanggal Terbit Akta Cerai</label>
    <div class='date'>
      <input type='text' class="form-control" name="subject[tanggal_cerai]" id='tanggal_cerai' style="background-color: white; " placeholder="Pilih Tanggal Cerai" value="{{ @$data->tanggal_cerai }}" />
    </div>
  </div>
  <div class="form-group col-md-12">
    <label>Status Hubungan Keluarga</label>
    <select id="family_relationship" class="form-control select2-family-relationship" name="subject[family_relationship]">
        <option value=""></option>
        @foreach(\App\Helpers\DataHelper::getStatusHubunganKeluarga() as $key => $value)
            <option value="{{ $key }}" {{ @$data->family_relationship == $key ? 'selected' : '' }}>{{ $key }} - {{ $value }}</option>
        @endforeach
    </select>
  </div>
  <div class="form-group col-md-6">
    <label>Pendidikan</label>
    <select id="education" class="form-control select2-education" name="subject[education]">
        <option value=""></option>
        @foreach(\App\Helpers\DataHelper::getPendidikan() as $key => $value)
            <option value="{{ $key }}" {{ @$data->education == $key ? 'selected' : '' }}>{{ $key }} - {{ $value }}</option>
        @endforeach
    </select>
  </div>
  <div class="form-group col-md-6">
    <label>Pekerjaan</label>
    <select id="job" class="form-control select2-job" name="subject[job]">
        <option value=""></option>
        @foreach(\App\Helpers\DataHelper::getPekerjaan() as $key => $value)
            <option value="{{ $key }}" {{ @$data->job == $key ? 'selected' : '' }}>{{ $key }} - {{ $value }}</option>
        @endforeach
    </select>
  </div>
  <div class="form-group col-md-12">
      <label>Nama Ibu</label>
      <input type="text" name="subject[nama_ibu]" class="form-control" placeholder="Nama Ibu" value="{{ @$data->nama_ibu }}">
  </div>
  <div class="form-group col-md-12">
      <label>Nama Ayah</label>
      <input type="text" name="subject[nama_ayah]" class="form-control" placeholder="Nama Ayah" value="{{ @$data->nama_ayah }}">
  </div>
  <div class="form-group col-md-6">
      <label>Nomor Paspor</label>
      <input type="text" name="subject[nomor_paspor]" class="form-control" placeholder="Nomor Paspor" value="{{ @$data->nomor_paspor }}">
  </div>
  <div class="form-group col-md-6">
    <label>Tanggal Berlaku Paspor</label>
    <div class='date'>
      <input type='text' class="form-control" name="subject[tanggal_berlaku_paspor]" id='tanggal_berlaku_paspor' style="background-color: white; " placeholder="Pilih Tanggal Berlaku Paspor" value="{{ @$data->tanggal_berlaku_paspor }}" />
    </div>
  </div>
  <div class="form-group col-md-12">
      <label>Keterangan</label>
      <textarea name="subject[keterangan]" class="form-control" placeholder="Keterangan">{{ @$data->keterangan }}</textarea>
  </div>
</div>
<div class="row">
  <div class="col-md-12 justify-content-start">
    <h5 style="color: #016004">Dokumen Persyaratan</h5>
    <hr class="bg-diy"style="height: 2px; margin-top: 0px !important; margin-bottom: 10px !important;">
  </div>
  @php
  $dokumen = [
    'penetapan_pengadilan' => 'Penetapan Pengadilan',
    'akta_kelahiran' => 'Akta Kelahiran (ASLI)',
    'kk_pemohon' => 'Kartu Keluarga Pemohon',
    'ktp_pemohon' => 'KTP Pemohon',
    'keabsahan' => 'Keabsahan Akta Kelahiran',
    'akta_perkawinan' => 'Akta Perkawinan',
    'akta_perceraian' => 'Akta Perceraian',
    'keterangan_medis' => 'Keterangan Medis',
    'ijazah' => 'Ijazah',
    'keterangan_status_pekerjaan' => 'Keterangan Status Pekerjaan',
    'paspor' => 'Paspor',
    'sptjm' => 'Surat Pernyataan Tanggung Jawab Mutlak (SPTJM)',
    'dokumen_tambahan' => 'Dokumen Tambahan'
  ];
  @endphp
  @foreach($dokumen as $key => $dok)
    <div class="col-md-3 mt-3">
        <label for="foto_{{$key}}">{{ $dok }} @if($key != 'keabsahan' && $key != 'akta_perkawinan' && $key != 'akta_perceraian' && $key != 'keterangan_medis' && $key != 'ijazah' && $key != 'keterangan_status_pekerjaan' && $key != 'paspor' && $key != 'sptjm' && $key != 'dokumen_tambahan') @if(!@$data)<span class="text-danger">*</span> @endif @endif</label>
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
    let regencies = [];
    let districts = [];
    let villages = [];

    const selectedProvince = $('#province').data('selected');
    const selectedRegency = $('#regency').data('selected');
    const selectedDistrict = $('#district').data('selected');
    const selectedVillage = $('#village').data('selected');

    const dokumen = [
      'penetapan_pengadilan',
      'akta_kelahiran',
      'kk_pemohon',
      'ktp_pemohon',
      'keabsahan',
      'akta_perkawinan',
      'akta_perceraian',
      'keterangan_medis',
      'ijazah',
      'keterangan_status_pekerjaan',
      'paspor',
      'sptjm',
      'dokumen_tambahan'
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

    $('.select2-province').select2({
      placeholder: "Pilih Provinsi",
      allowClear: true
    });
    $('.select2-regency').select2({
      placeholder: "Pilih Kabupaten / Kota",
      allowClear: true
    });
    $('.select2-district').select2({
      placeholder: "Pilih Kabupaten / Kota",
      allowClear: true
    });
    $('.select2-village').select2({
      placeholder: "Pilih Desa / Kelurahan",
      allowClear: true
    });
    $('.select2-gender').select2({
      placeholder: "Pilih Jenis Kelamin",
      allowClear: true
    });
    $('#tanggal_lahir').flatpickr({
      static: true,
      dateFormat: "Y-m-d",
    })
    $('.select2-blood-type').select2({
      placeholder: "Pilih Golongan Darah",
      allowClear: true
    });
    $('.select2-religion').select2({
      placeholder: "Pilih Agama",
      allowClear: true
    });
    $('.select2-marital-status').select2({
      placeholder: "Pilih Status Kawin",
      allowClear: true
    });
    $('.select2-family-relationship').select2({
      placeholder: "Pilih Status Hubungan Keluarga",
      allowClear: true
    });
    $('.select2-education').select2({
      placeholder: "Pilih Pendidikan",
      allowClear: true
    });
    $('.select2-job').select2({
      placeholder: "Pilih Pekerjaan",
      allowClear: true
    });

    $('#tanggal_kawin').flatpickr({
      static: true,
      dateFormat: "Y-m-d",
    })
    $('#tanggal_cerai').flatpickr({
      static: true,
      dateFormat: "Y-m-d",
    })
    $('#tanggal_berlaku_paspor').flatpickr({
      static: true,
      dateFormat: "Y-m-d",
    })


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

    $('.select2-jenis-akta').select2({
      placeholder: "Pilih Jenis Akta",
      allowClear: true
    });
    $('.select2-elemen-perbaikan').select2({
      placeholder: "Pilih Elemen Perbaikan / Perubahan",
      allowClear: true
    });

    // Load JSON files (async chaining)
    $.when(
      $.getJSON('/data/regencies.json', data => { regencies = data }),
      $.getJSON('/data/districts.json', data => { districts = data }),
      $.getJSON('/data/villages.json', data => { villages = data })
    ).done(function () {
      // Prefill data for edit
      if (selectedProvince) {
        $('#province').val(selectedProvince).trigger('change');

        const filteredRegencies = regencies.filter(r => r.province_id === selectedProvince);
        $.each(filteredRegencies, function (i, regency) {
          $('#regency').append(`<option value="${regency.id}" ${regency.id == selectedRegency ? 'selected' : ''}>${regency.name}</option>`);
        });

        if (selectedRegency) {
          $('#regency').val(selectedRegency).trigger('change');

          const filteredDistricts = districts.filter(d => d.regency_id === selectedRegency);
          $.each(filteredDistricts, function (i, district) {
            $('#district').append(`<option value="${district.id}" ${district.id == selectedDistrict ? 'selected' : ''}>${district.name}</option>`);
          });

          if (selectedDistrict) {
            $('#district').val(selectedDistrict).trigger('change');

            const filteredVillages = villages.filter(v => v.district_id === selectedDistrict);
            $.each(filteredVillages, function (i, village) {
              $('#village').append(`<option value="${village.id}" ${village.id == selectedVillage ? 'selected' : ''}>${village.name}</option>`);
            });

            $('#village').val(selectedVillage).trigger('change');
          }
        }
      }
    });

    // Handle province change
    $('#province').on('change', function () {
      const provinceId = $(this).val();
      $('#regency').empty().append('<option value=""></option>');
      $('#district').empty().append('<option value=""></option>');
      $('#village').empty().append('<option value=""></option>');

      const filteredRegencies = regencies.filter(r => r.province_id === provinceId);
      $.each(filteredRegencies, function (i, regency) {
        $('#regency').append(`<option value="${regency.id}">${regency.name}</option>`);
      });
    });

    // Handle regency change
    $('#regency').on('change', function () {
      const regencyId = $(this).val();
      $('#district').empty().append('<option value=""></option>');
      $('#village').empty().append('<option value=""></option>');

      const filteredDistricts = districts.filter(d => d.regency_id === regencyId);
      $.each(filteredDistricts, function (i, district) {
        $('#district').append(`<option value="${district.id}">${district.name}</option>`);
      });
    });

    // Handle district change
    $('#district').on('change', function () {
      const districtId = $(this).val();
      $('#village').empty().append('<option value=""></option>');

      const filteredVillages = villages.filter(v => v.district_id === districtId);
      $.each(filteredVillages, function (i, village) {
        $('#village').append(`<option value="${village.id}">${village.name}</option>`);
      });
    });

    function toggleCimahiForm() {
      const selectedText = $('.select2-disdukcapil option:selected').text().toLowerCase();
      if (selectedText.includes('cimahi')) {
        $('#form-cimahi').show();
      } else {
        $('#form-cimahi').hide();
      }
    }

    // Jalankan saat halaman pertama kali dimuat (untuk mode edit)
    toggleCimahiForm();
    $('.select2-disdukcapil').on('change', function () {
      toggleCimahiForm();
    });

    function updateDisdukcapilNama() {
        var selectedText = $('.select2-disdukcapil option:selected').text();
        $('#disdukcapil_nama').val(selectedText);
    }

    // Trigger saat pertama kali halaman dimuat (jika ada selected)
    updateDisdukcapilNama();

    // Trigger setiap kali user mengganti pilihan
    $('.select2-disdukcapil').on('change', function () {
        updateDisdukcapilNama();
    });
  })
</script>