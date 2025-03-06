<div class="row">

    <div class="form-group col-md-6">
      <label>Nama Lengkap <span class="text-danger">*</span></label>
      <input type="text" name="name" class="form-control" placeholder="Nama Lengkap" value="{{ @$data->name }}">
    </div>
    
    <div class="form-group col-md-6">
      <label>Nomor Induk kependudukan (NIK) <span class="text-danger">*</span></label>
      <input type="number" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"  maxlength="16" name="nik" class="form-control" placeholder="Nomor Induk kependudukan (NIK)" value="{{ @$data->nik }}">
    </div>

    <div class="form-group col-md-6">
      <label>Email</label>
      <input type="email" name="email" class="form-control" placeholder="Email" value="{{ @$data->email }}">
    </div>

    
    <div class="form-group col-md-6">
      <label>No Telpon <span class="text-danger">*</span></label>
      <input type="text" name="no_telp" class="form-control" placeholder="No Telpon" value="{{ @$data->no_telp }}">
    </div>

    <div class="form-group col-md-12">
      <label>Jenis Kelamin <span class="text-danger">*</span></label><br>
      <div class="custom-control custom-radio custom-control-inline">
        <input type="radio" id="jenis_kelamin0" {{ @$data->jenis_kelamin == "pria" ? "checked" : "" }} name="jenis_kelamin" class="custom-control-input" value="pria">
        <label class="custom-control-label" for="jenis_kelamin0">Pria</label>
      </div>
      <div class="custom-control custom-radio custom-control-inline">
        <input type="radio" id="jenis_kelamin1" {{ @$data->jenis_kelamin == "wanita" ? "checked" : "" }} name="jenis_kelamin" class="custom-control-input" value="wanita">
        <label class="custom-control-label" for="jenis_kelamin1">Wanita</label>
      </div>
    </div>

    @php
      $agama = [
            "islam" => "Islam",
            "kristen" => "Kristen (Protestan)",
            "katolik" => "Katolik",
            "hindu" => "Hindu",
            "buddha" => "Buddha",
            "konghucu" => "Konghucu",
      ];

      $status = [
            "bk" => "Belum Kawin",
            "k" => "Kawin",
            "ch" => "Cerai Hidup",
            "cm" => "Cerai Mati",
      ];


    @endphp
    <div class="form-group col-md-6">
      <label>Agama <span class="text-danger">*</span></label>
      <select name="agama" class="form-control select2" aria-describedby="validationtxtAgama" id="txtAgama">
          @foreach($agama as $key => $value)
          <option value="{{$key}}" {{ @$data->agama == $key ? "checked" : "" }}>{{$value}}</option>
          @endforeach
      </select>
      <div id="validationtxtAgama" class="invalid-feedback"></div>
    </div>

    <div class="form-group col-md-6">
      <label>Status <span class="text-danger">*</span></label>
      <select name="status" class="form-control select2" aria-describedby="validationtxtStatus" id="txtStatus">
          @foreach($status as $key => $value)
          <option value="{{$key}}" {{ @$data->status == $key ? "checked" : "" }}>{{$value}}</option>
          @endforeach
      </select>
      <div id="validationtxtStatus" class="invalid-feedback"></div>
    </div>

    <div class="form-group col-md-12">
      <label>Alamat <span class="text-danger">*</span></label>
      <textarea name="alamat" placeholder="Alamat" class="form-control">{{ @$data->description }}</textarea>
    </div>

    <div class="form-group col-md-6">
      <label>Username <span class="text-danger">*</span></label>
      <input type="text" name="username" class="form-control" placeholder="Username" value="{{ @$data->name }}">
    </div>
    <div class="form-group col-md-6">
      <label>Password <span class="text-danger">*</span></label>
      <input type="password" name="password" class="form-control" placeholder="Username" value="{{ @$data->name }}">
    </div>


</div>

<script>
  $('.select2').select2();
</script>