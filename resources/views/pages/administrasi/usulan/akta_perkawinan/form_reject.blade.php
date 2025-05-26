<form action="{{ route('submission.rejectment_store', $uid) }}" method="PUT" id="myForm" enctype="multipart/form-data">
  @csrf
  @method('PUT')
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
              <tr>
                <td>
                  NIK Jenazah
                  <h3 class="text-white">{{ ucwords(str_replace('_', ' ', @$detail->nik_jenazah)) }}</h3>
                </td>
                <td>
                  Nama Jenazah
                  <h3 class="text-white">{{ @$detail->nama_jenazah }}</h3>
                </td>
                <td>
                  Tanggal Kematian
                  <h3 class="text-white">{{ @$detail->tanggal_kematian }}, pukul {{ @$detail->waktu_kematian }}</h3>
                </td>
              </tr>
              <tr>
                <td>
                  Nama Ayah
                  <h3 class="text-white">{{ @$detail->nama_ayah }}</h3>
                </td>
                <td>
                  Nama Ibu
                  <h3 class="text-white">{{ @$detail->nama_ibu }}</h3>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
    </div>
    <div class="form-group col-md-12">
      <label>Catatan <span class="text-danger">*</span></label>
      <textarea name="catatan" class="form-control" cols="30" rows="10"></textarea>
    </div>
  </div>        
</form>
<div id="response_container"></div>
  