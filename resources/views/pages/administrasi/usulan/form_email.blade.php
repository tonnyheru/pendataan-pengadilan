<form action="{{ route('usulan.sendmail_process', $uid) }}" method="PUT" id="myForm" enctype="multipart/form-data">
    @csrf
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
                    <h3 class="text-white">{{@$usulan->no_perkara}}</h3>
                  </td>
                  <td>
                    Jenis Perkara
                    <h3 class="text-white">{{@$usulan->jenis_perkara}}</h3>
                  </td>
                  <td>
                    Nama Pemohon
                    <h3 class="text-white">{{@$usulan->pemohon->name}}</h3>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
      </div>
      <div class="form-group col-md-12">
        <label>Link dokumen terbaru <span class="text-danger">*</span></label>
        <input type="text" name="link" class="form-control" placeholder="Link : https://drive.google.com/.....">
      </div>
    </div>        
  </form>
  <div id="response_container"></div>
    