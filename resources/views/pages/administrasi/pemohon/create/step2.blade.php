
<div class="step-body" data-tab="2" style="display: none;">
  <div class="row">
    <div class="form-group col-md-12">
        <label>Akta Kelahiran</label>
        <input type="text" name="akta_kelahiran" class="form-control" placeholder="Akta Kelahiran" value="{{ @$data->akta_kelahiran }}">
    </div>
    <div class="form-group col-md-6">
      <label>Golongan Darah <span class="text-danger">*</span></label>
      <select id="blood_type" class="form-control select2-blood-type" name="blood_type">
          <option value=""></option>
      </select>
    </div>
    <div class="form-group col-md-6">
      <label>Agama <span class="text-danger">*</span></label>
      <select id="religion" class="form-control select2-religion" name="religion">
          <option value=""></option>
      </select>
    </div>
    <div class="form-group col-md-12">
      <label>Status Kawin <span class="text-danger">*</span></label>
      <select id="marital_status" class="form-control select2-marital-status" name="marital_status">
          <option value=""></option>
      </select>
    </div>
    <div class="form-group col-md-6">
        <label>Akta Kawin</label>
        <input type="text" name="akta_kawin" class="form-control" placeholder="Akta Kawin" value="{{ @$data->akta_kawin }}">
    </div>
    <div class="form-group col-md-6">
      <label>Tanggal Kawin <span class="text-danger">*</span></label>
      <div class='date'>
        <input type='text' class="form-control" name="tanggal_kawin" id='tanggal_kawin' style="background-color: white; " placeholder="Pilih Tanggal Kawin" value="{{ @$data->tanggal_kawin }}" />
      </div>
    </div>
    <div class="form-group col-md-6">
        <label>Akta Cerai</label>
        <input type="text" name="akta_cerai" class="form-control" placeholder="Akta Cerai" value="{{ @$data->akta_cerai }}">
    </div>
    <div class="form-group col-md-6">
      <label>Tanggal Terbit Akta Cerai <span class="text-danger">*</span></label>
      <div class='date'>
        <input type='text' class="form-control" name="tanggal_cerai" id='tanggal_cerai' style="background-color: white; " placeholder="Pilih Tanggal Cerai" value="{{ @$data->tanggal_cerai }}" />
      </div>
    </div>
    <div class="form-group col-md-12">
      <label>Status Hubungan Keluarga <span class="text-danger">*</span></label>
      <select id="family_relationship" class="form-control select2-family-relationship" name="family_relationship">
          <option value=""></option>
      </select>
    </div>
    <div class="form-group col-md-6">
      <label>Pendidikan <span class="text-danger">*</span></label>
      <select id="education" class="form-control select2-education" name="education">
          <option value=""></option>
      </select>
    </div>
    <div class="form-group col-md-6">
      <label>Pekerjaan <span class="text-danger">*</span></label>
      <select id="job" class="form-control select2-job" name="job">
          <option value=""></option>
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
    <div class="form-group col-md-12">
        <label>Nomor Paspor</label>
        <input type="text" name="nomor_paspor" class="form-control" placeholder="Nomor Paspor" value="{{ @$data->nomor_paspor }}">
    </div>
    <div class="form-group col-md-6">
      <label>Tanggal Berlaku Paspor <span class="text-danger">*</span></label>
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