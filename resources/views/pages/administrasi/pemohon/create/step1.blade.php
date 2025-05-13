
<div class="step-body" data-tab="1">
  <div class="row">
    {{-- provinsi --}}
    <div class="form-group col-md-6">
      <label>Provinsi <span class="text-danger">*</span></label>
      <select id="province" class="form-control select2-province" name="province">
          <option value=""></option>
          @foreach($provinces as $province)
              <option value="{{ $province->id }}">{{ $province->name }}</option>
          @endforeach
      </select>
    </div>
    {{-- kabupaten / kota --}}
    <div class="form-group col-md-6">
      <label>Kabupaten / Kota <span class="text-danger">*</span></label>
      <select id="regency" class="form-control select2-regency" name="regency">
          <option value=""></option>
      </select>
    </div>
    {{-- kecamatan --}}
    <div class="form-group col-md-6">
      <label>Kecamatan <span class="text-danger">*</span></label>
      <select id="district" class="form-control select2-district" name="district">
          <option value=""></option>
      </select>
    </div>
    {{-- desa / kelurahan --}}
    <div class="form-group col-md-6">
      <label>Desa / Kelurahan <span class="text-danger">*</span></label>
      <select id="village" class="form-control select2-village" name="village">
          <option value=""></option>
      </select>
    </div>
    <div class="form-group col-md-6">
      <label>Nomor Kartu Keluarga (KK) <span class="text-danger">*</span></label>
      <input type="number" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"  maxlength="16" name="kk" class="form-control" placeholder="Nomor Kartu Keluarga (KK)" value="{{ @$data->kk }}">
    </div>
    <div class="form-group col-md-6">
      <label>Nomor Induk kependudukan (NIK) <span class="text-danger">*</span></label>
      <input type="number" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"  maxlength="16" name="nik" class="form-control" placeholder="Nomor Induk kependudukan (NIK)" value="{{ @$data->nik }}">
    </div>  
    <div class="form-group col-md-12">
      <label>Nama Lengkap <span class="text-danger">*</span></label>
      <input type="text" name="name" class="form-control" placeholder="Nama Lengkap" value="{{ @$data->name }}">
    </div>
    <div class="form-group col-md-6">
      <label>Tempat Lahir</label>
      <input type="text" name="tempat_lahir" class="form-control" placeholder="Tempat Lahir" value="{{ @$data->tempat_lahir }}">
    </div>
    <div class="form-group col-md-6">
      <label>Tanggal Lahir <span class="text-danger">*</span></label>
      <div class='date'>
        <input type='text' class="form-control" name="tanggal_lahir" id='tanggal_lahir' style="background-color: white; " placeholder="Pilih Tanggal Lahir" value="{{ @$data->tanggal_lahir }}" />
      </div>
    </div>
    <div class="form-group col-md-12">
      <label>Jenis Kelamin <span class="text-danger">*</span></label><br>
      <div class="custom-control custom-radio custom-control-inline">
        <input type="radio" id="jenis_kelamin0" {{ @$data->jenis_kelamin == "laki-laki" ? "checked" : "" }} name="jenis_kelamin" class="custom-control-input" value="laki-laki">
        <label class="custom-control-label" for="jenis_kelamin0">Laki-laki</label>
      </div>
      <div class="custom-control custom-radio custom-control-inline">
        <input type="radio" id="jenis_kelamin1" {{ @$data->jenis_kelamin == "perempuan" ? "checked" : "" }} name="jenis_kelamin" class="custom-control-input" value="perempuan">
        <label class="custom-control-label" for="jenis_kelamin1">Perempuan</label>
      </div>
    </div>
    <div class="form-group col-md-6">
      <label>Email <span class="text-danger">*</span></label>
      <input type="email" name="email" class="form-control" placeholder="Email" value="{{ @$data->email }}">
    </div>
    <div class="form-group col-md-6">
      <label>No Telpon <span class="text-danger">*</span></label>
      <input type="text" name="no_telp" class="form-control" placeholder="No Telpon" value="{{ @$data->no_telp }}">
    </div>
  </div>
</div>
<script>
  $('.select2-province').select2({
    placeholder: "Pilih Provinsi",
    allowClear: true
  });
  $(() => {
    let regencies = [];
    let districts = [];
    let villages = [];

    // Load JSON files
    $.getJSON('/data/regencies.json', function(data) {
        regencies = data;
    });

    $.getJSON('/data/districts.json', function(data) {
        districts = data;
    });

    $.getJSON('/data/villages.json', function(data) {
        villages = data;
    });

    // Province change
    $('#province').on('change', function() {
        const provinceId = $(this).val();
        $('#regency').empty().append('<option value=""></option>');
        $('#district').empty().append('<option value=""></option>');
        $('#village').empty().append('<option value=""></option>');
        $('.select2-regency').select2({
          placeholder: "Pilih Kabupaten / Kota",
          allowClear: true
        });

        const filteredRegencies = regencies.filter(r => r.province_id === provinceId);
        $.each(filteredRegencies, function(i, regency) {
            $('#regency').append(`<option value="${regency.id}">${regency.name}</option>`);
        });
        
    });

    // kabupaten / Kota change
    $('#regency').on('change', function() {
        const regencyId = $(this).val();
        $('#district').empty().append('<option value=""></option>');
        $('#village').empty().append('<option value=""></option>');
        $('.select2-district').select2({
          placeholder: "Pilih Kabupaten / Kota",
          allowClear: true
        });

        const filteredDistricts = districts.filter(d => d.regency_id === regencyId);
        $.each(filteredDistricts, function(i, district) {
            $('#district').append(`<option value="${district.id}">${district.name}</option>`);
        });
    });
    // kecamatan change
    $('#district').on('change', function() {
        const districtId = $(this).val();
        $('#village').empty().append('<option value=""></option>');
        $('.select2-village').select2({
          placeholder: "Pilih Desa / Kelurahan",
          allowClear: true
        });

        const filteredVillages = villages.filter(v => v.district_id === districtId);
        $.each(filteredVillages, function(i, village) {
            $('#village').append(`<option value="${village.id}">${village.name}</option>`);
        });
    });
  })
</script>