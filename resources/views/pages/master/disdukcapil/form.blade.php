<div class="row">

    <div class="form-group col-md-12">
      <label>Nama Disdukcapil <span class="text-danger">*</span></label>
      <input type="text" name="nama" class="form-control" placeholder="Nama Disdukcapil" value="{{ @$data->nama }}">
    </div>

    <div class="form-group col-md-6">
      <label>No Telpon <span class="text-danger">*</span></label>
      <input type="text" name="no_telp" class="form-control" placeholder="No Telpon" value="{{ @$data->no_telp }}">
    </div>

    <div class="form-group col-md-6">
      <label>Email <span class="text-danger">*</span></label>
      <input type="email" name="email" class="form-control" placeholder="Email" value="{{ @$data->email }}">
    </div>

    <div class="form-group col-md-12">
      <label>Alamat <span class="text-danger">*</span></label>
      <textarea name="alamat" placeholder="Alamat" class="form-control">{{ @$data->alamat }}</textarea>
    </div>
    
    <div class="form-group col-md-12">
      <label>Tautan Gambar <span class="text-danger">*</span></label>
      <input type="text" name="cdn_picture" class="form-control" placeholder="Tautan Gambar" value="{{ @$data->cdn_picture }}">
    </div>

</div>
