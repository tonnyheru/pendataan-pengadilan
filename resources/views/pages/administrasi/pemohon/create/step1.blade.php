
<div class="step-body" data-tab="1">
  <div class="row">
    {{-- provinsi --}}
    <div class="form-group col-md-6">
      <label>Provinsi <span class="text-danger">*</span></label>
      <select id="province" class="form-control select2-province" name="province" data-selected="{{ @$data->province }}" aria-describedby="validateProvince">
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
      <select id="regency" class="form-control select2-regency" name="regency" data-selected="{{ @$data->regency }}" aria-describedby="validateRegency">
          <option value=""></option>
      </select>
      <div id="validateRegency" class="invalid-feedback">
        Kolom Kabupaten / Kota harus diisi.
      </div>
    </div>
    {{-- kecamatan --}}
    <div class="form-group col-md-6">
      <label>Kecamatan <span class="text-danger">*</span></label>
      <select id="district" class="form-control select2-district" name="district" data-selected="{{ @$data->district }}" aria-describedby="validateDistrict">
          <option value=""></option>
      </select>
      <div id="validateDistrict" class="invalid-feedback">
        Kolom Kecamatan harus diisi.
      </div>
    </div>
    {{-- desa / kelurahan --}}
    <div class="form-group col-md-6">
      <label>Desa / Kelurahan <span class="text-danger">*</span></label>
      <select id="village" class="form-control select2-village" name="village" data-selected="{{ @$data->village }}" aria-describedby="validateVillage">
          <option value=""></option>
      </select>
      <div id="validateVillage" class="invalid-feedback">
        Kolom Desa / Kelurahan harus diisi.
      </div>
    </div>
    <div class="form-group col-md-6">
      <label>Nomor Kartu Keluarga (KK) <span class="text-danger">*</span></label>
      <input type="number" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"  maxlength="16" name="kk" class="form-control" placeholder="Nomor Kartu Keluarga (KK)" value="{{ @$data->kk }}" aria-describedby="validateKK">
      <div id="validateKK" class="invalid-feedback">
        Kolom Nomor Kartu Keluarga (KK) harus diisi.
      </div>
    </div>
    <div class="form-group col-md-6">
      <label>Nomor Induk kependudukan (NIK) <span class="text-danger">*</span></label>
      <input type="number" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"  maxlength="16" name="nik" class="form-control" placeholder="Nomor Induk kependudukan (NIK)" value="{{ @$data->nik }}" aria-describedby="validateNIK">
      <div id="validateNIK" class="invalid-feedback">
        Kolom Nomor Induk kependudukan (NIK) harus diisi.
      </div>
    </div>  
    <div class="form-group col-md-12">
      <label>Nama Lengkap <span class="text-danger">*</span></label>
      <input type="text" name="name" class="form-control" placeholder="Nama Lengkap" value="{{ @$data->name }}" aria-describedby="validateName">
      <div id="validateName" class="invalid-feedback">
        Kolom Nama Lengkap harus diisi.
      </div>
    </div>
    <div class="form-group col-md-6">
      <label>Tempat Lahir <span class="text-danger">*</span></label>
      <input type="text" name="tempat_lahir" class="form-control" placeholder="Tempat Lahir" value="{{ @$data->tempat_lahir }}" aria-describedby="validateTempatLahir">
      <div id="validateTempatLahir" class="invalid-feedback">
        Kolom Tempat Lahir harus diisi.
      </div>
    </div>
    <div class="form-group col-md-6">
      <label>Tanggal Lahir <span class="text-danger">*</span></label>
      <div class='date'>
        <input type='text' class="form-control" name="tanggal_lahir" id='tanggal_lahir' style="background-color: white; " placeholder="Pilih Tanggal Lahir" value="{{ @$data->tanggal_lahir }}"  aria-describedby="validateTanggalLahir" />
        <div id="validateTanggalLahir" class="invalid-feedback">
          Kolom Tanggal Lahir harus diisi.
        </div>
      </div>
    </div>
    <div class="form-group col-md-12">
      <label>Jenis Kelamin <span class="text-danger">*</span></label><br>
      <div class="custom-control custom-radio custom-control-inline">
        <input type="radio" id="jenis_kelamin0" {{ strtolower(@$data->jenis_kelamin) == "laki-laki" ? "checked" : "" }} name="jenis_kelamin" class="custom-control-input" value="laki-laki" >
        <label class="custom-control-label" for="jenis_kelamin0">Laki-laki</label>
      </div>
      <div class="custom-control custom-radio custom-control-inline">
        <input type="radio" id="jenis_kelamin1" {{ strtolower(@$data->jenis_kelamin) == "perempuan" ? "checked" : "" }} name="jenis_kelamin" class="custom-control-input" value="perempuan" >
        <label class="custom-control-label" for="jenis_kelamin1">Perempuan</label>
        
      </div>
    </div>
    <div class="form-group col-md-12">
        <label>Alamat <span class="text-danger">*</span></label>
        <textarea name="alamat" class="form-control" placeholder="Alamat">{{ @$data->alamat }}</textarea>
    </div>
    <div class="form-group col-md-6">
      <label>Email <span class="text-danger">*</span></label>
      <input type="email" name="email" class="form-control" placeholder="Email" value="{{ @$data->email }}">
      <div id="validateEmail" class="invalid-feedback">
        Kolom Email harus diisi.
      </div>
    </div>
    <div class="form-group col-md-6">
      <label>No Telpon <span class="text-danger">*</span></label>
      <input type="text" name="no_telp" class="form-control" placeholder="No Telpon" value="{{ @$data->no_telp }}" aria-describedby="validateNoTelp">
      <div id="validateNoTelp" class="invalid-feedback">
        Kolom No Telpon harus diisi.
      </div>
    </div>
  </div>
</div>
<script>
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
  $('#tanggal_lahir').flatpickr({
    static: true,
    dateFormat: "Y-m-d",
  })

  $(() => {
    let regencies = [];
    let districts = [];
    let villages = [];

    const selectedProvince = $('#province').data('selected');
    const selectedRegency = $('#regency').data('selected');
    const selectedDistrict = $('#district').data('selected');
    const selectedVillage = $('#village').data('selected');

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
  });
</script>