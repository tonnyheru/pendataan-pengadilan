
<div class="step-body" data-tab="2" style="display: none;">
  <div class="row">
    <div class="form-group col-md-12">
        <label>Akta Kelahiran</label>
        <input type="text" name="akta_kelahiran" class="form-control" placeholder="Akta Kelahiran" value="{{ @$data->akta_kelahiran }}">
    </div>
    <div class="form-group col-md-6">
      <label>Golongan Darah</label>
      <select id="blood_type" class="form-control select2-blood-type" name="blood_type">
          <option value=""></option>
          @foreach(\App\Helpers\DataHelper::getGolonganDarah() as $key => $value)
              <option value="{{ $key }}" {{ @$data->blood_type == $key ? 'selected' : '' }}>{{ $value }}</option>
          @endforeach
      </select>
    </div>
    <div class="form-group col-md-6">
      <label>Agama</label>
      <select id="religion" class="form-control select2-religion" name="religion">
          <option value=""></option>
          @foreach(\App\Helpers\DataHelper::getAgama() as $key => $value)
              <option value="{{ $key }}" {{ @$data->religion == $key ? 'selected' : '' }}>{{ $value }}</option>
          @endforeach
      </select>
    </div>
    <div class="form-group col-md-12">
      <label>Status Kawin</label>
      <select id="marital_status" class="form-control select2-marital-status" name="marital_status">
          <option value=""></option>
          @foreach(\App\Helpers\DataHelper::getStatusPernikahan() as $key => $value)
              <option value="{{ $key }}" {{ @$data->marital_status == $key ? 'selected' : '' }}>{{ $value }}</option>
          @endforeach
      </select>
    </div>
    <div class="form-group col-md-6">
        <label>Akta Kawin</label>
        <input type="text" name="akta_kawin" class="form-control" placeholder="Akta Kawin" value="{{ @$data->akta_kawin }}">
    </div>
    <div class="form-group col-md-6">
      <label>Tanggal Kawin</label>
      <div class='date'>
        <input type='text' class="form-control" name="tanggal_kawin" id='tanggal_kawin' style="background-color: white; " placeholder="Pilih Tanggal Kawin" value="{{ @$data->tanggal_kawin }}" />
      </div>
    </div>
    <div class="form-group col-md-6">
        <label>Akta Cerai</label>
        <input type="text" name="akta_cerai" class="form-control" placeholder="Akta Cerai" value="{{ @$data->akta_cerai }}">
    </div>
    <div class="form-group col-md-6">
      <label>Tanggal Terbit Akta Cerai</label>
      <div class='date'>
        <input type='text' class="form-control" name="tanggal_cerai" id='tanggal_cerai' style="background-color: white; " placeholder="Pilih Tanggal Cerai" value="{{ @$data->tanggal_cerai }}" />
      </div>
    </div>
    <div class="form-group col-md-12">
      <label>Status Hubungan Keluarga</label>
      <select id="family_relationship" class="form-control select2-family-relationship" name="family_relationship">
          <option value=""></option>
          @foreach(\App\Helpers\DataHelper::getStatusHubunganKeluarga() as $key => $value)
              <option value="{{ $key }}" {{ @$data->family_relationship == $key ? 'selected' : '' }}>{{ $value }}</option>
          @endforeach
      </select>
    </div>
    <div class="form-group col-md-6">
      <label>Pendidikan</label>
      <select id="education" class="form-control select2-education" name="education">
          <option value=""></option>
          @foreach(\App\Helpers\DataHelper::getPendidikan() as $key => $value)
              <option value="{{ $key }}" {{ @$data->education == $key ? 'selected' : '' }}>{{ $value }}</option>
          @endforeach
      </select>
    </div>
    <div class="form-group col-md-6">
      <label>Pekerjaan</label>
      <select id="job" class="form-control select2-job" name="job">
          <option value=""></option>
          @foreach(\App\Helpers\DataHelper::getPekerjaan() as $key => $value)
              <option value="{{ $key }}" {{ @$data->job == $key ? 'selected' : '' }}>{{ $value }}</option>
          @endforeach
      </select>
    </div>
    <div class="form-group col-md-12">
        <label>Nama Ibu</label>
        <input type="text" name="nama_ibu" class="form-control" placeholder="Nama Ibu" value="{{ @$data->nama_ibu }}">
    </div>
    <div class="form-group col-md-12">
        <label>Nama Ayah</label>
        <input type="text" name="nama_ayah" class="form-control" placeholder="Nama Ayah" value="{{ @$data->nama_ayah }}">
    </div>
    <div class="form-group col-md-6">
        <label>Nomor Paspor</label>
        <input type="text" name="nomor_paspor" class="form-control" placeholder="Nomor Paspor" value="{{ @$data->nomor_paspor }}">
    </div>
    <div class="form-group col-md-6">
      <label>Tanggal Berlaku Paspor</label>
      <div class='date'>
        <input type='text' class="form-control" name="tanggal_berlaku_paspor" id='tanggal_berlaku_paspor' style="background-color: white; " placeholder="Pilih Tanggal Berlaku Paspor" value="{{ @$data->tanggal_berlaku_paspor }}" />
      </div>
    </div>
    <div class="form-group col-md-12">
        <label>Keterangan</label>
        <textarea name="keterangan" class="form-control" placeholder="Keterangan">{{ @$data->keterangan }}</textarea>
    </div>

  </div>
</div>

<script>
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
</script>