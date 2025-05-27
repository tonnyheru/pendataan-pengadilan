<form action="{{ route('submission.approvement_store', $uid) }}" method="PUT" id="myForm" enctype="multipart/form-data">
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
                  NIK Suami
                  <h3 class="text-white">{{ ucwords(str_replace('_', ' ', @$detail->nik_suami)) }}</h3>
                </td>
                <td>
                  KK Suami
                  <h3 class="text-white">{{ @$detail->kk_suami }}</h3>
                </td>
                <td>
                  Nama Suami
                  <h3 class="text-white">{{ @$detail->nama_suami }}</h3>
                </td>
              </tr>
              <tr>
                <td>
                  NIK Istri
                  <h3 class="text-white">{{ ucwords(str_replace('_', ' ', @$detail->nik_istri)) }}</h3>
                </td>
                <td>
                  KK Istri
                  <h3 class="text-white">{{ @$detail->kk_istri }}</h3>
                </td>
                <td>
                  Nama Istri
                  <h3 class="text-white">{{ @$detail->nama_istri }}</h3>
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
  