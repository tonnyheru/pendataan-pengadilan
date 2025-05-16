
<style>
  td h3 {
      word-wrap: break-word; /* Ensures long words wrap to the next line */
      white-space: normal; /* Allows wrapping for multiple lines of text */
      max-width: 300px;
      min-width: 300px;
  }
  .txt-diy {
    color: #016004;
  }
</style>
<div class="step-body" data-tab="3" style="display: none;">
  <div class="row justify-content-center mt-5">
    <div class="col-md-2">
        <img src="{{ asset('img/default-avatar.png')}}" class="rounded" style="width: 100px; height:100px;" alt="circle-picture">
    </div>
    <table class="table table-borderless align-items-left table-flush table-header col-md-8">
      <tbody>
        <tr>
          <td colspan="2"><h3 class="txt-diy">Informasi Pribadi</h3></td>
        </tr>
        <tr>
          <td>
            <h3 class="d-inline"><i class="fas fa-microchip"></i></h3> Nama Lengkap
            <h3 id="d-nama"></h3>
          </td>
        </tr>
        <tr>
          <td>
            <h3 class="d-inline"><i class="fas fa-street-view"></i></h3> Tempat, Tanggal Lahir
            <h3 id="d-tempat-tanggal-lahir"></h3>
          </td>
          <td>
            <h3 class="d-inline"><i class="fas fa-street-view"></i></h3> Jenis Kelamin
            <h3 id="d-jenis-kelamin"></h3>
          </td>
        </tr>
        <tr>
          <td>
            <h3 class="d-inline"><i class="fas fa-street-view"></i></h3> Golongan Darah
            <h3 id="d-golongan-darah"></h3>
          </td>
          <td>
            <h3 class="d-inline"><i class="fas fa-street-view"></i></h3> Agama
            <h3 id="d-agama"></h3>
          </td>
        </tr>
        <tr style="border-bottom: 1px #016004 solid">
          <td>
            <h3 class="d-inline"><i class="fas fa-street-view"></i></h3> Pendidikan
            <h3 id="d-pendidikan"></h3>
          </td>
          <td>
            <h3 class="d-inline"><i class="fas fa-street-view"></i></h3> Pekerjaan
            <h3 id="d-pekerjaan"></h3>
          </td>
        </tr>
        <tr>
          <td colspan="2"><h3 class="txt-diy">Informasi Identitas</h3></td>
        </tr>
        <tr>
          <td>
            <h3 class="d-inline"><i class="fas fa-hdd"></i></h3> Nomor Induk Kependudukan (NIK)
            <h3 id="d-nik"></h3>
          </td>
        </tr>
        <tr>
          <td>
            <h3 class="d-inline"><i class="fas fa-hdd"></i></h3> Nomor Kartu Keluarga (KK)
            <h3 id="d-kk"></h3>
          </td>
          <td>
            <h3 class="d-inline"><i class="fas fa-street-view"></i></h3> Akta Kelahiran
            <h3 id="d-akta-kelahiran"></h3>
          </td>
        </tr>
        <tr style="border-bottom: 1px #016004 solid">
          <td>
            <h3 class="d-inline"><i class="fas fa-street-view"></i></h3> Nomor Paspor
            <h3 id="d-nomor-paspor"></h3>
          </td>
          <td>
            <h3 class="d-inline"><i class="fas fa-street-view"></i></h3> Tanggal Berlaku Paspor
            <h3 id="d-tanggal-berlaku-paspor"></h3>
          </td>
        </tr>
        
        <tr>
          <td colspan="2"><h3 class="txt-diy">Informasi Kontak</h3></td>
        </tr>
        <tr style="border-bottom: 1px #016004 solid">
          <td>
            <h3 class="d-inline"><i class="fas fa-street-view"></i></h3> Email
            <h3 id="d-email"></h3>
          </td>
          <td>
            <h3 class="d-inline"><i class="fas fa-street-view"></i></h3> No Telpon
            <h3 id="d-telpon"></h3>
          </td>
        </tr>


        <tr>
          <td colspan="2"><h3 class="txt-diy">Alamat dan Domisili</h3></td>
        </tr>
        <tr>
          <td>
            <h3 class="d-inline"><i class="fas fa-memory"></i></h3> Provinsi
            <h3 id="d-provinsi"></h3>
          </td>
          <td>
            <h3 class="d-inline"><i class="fas fa-user"></i></h3> Kabupaten / Kota
            <h3 id="d-kabupaten-kota"></h3>
          </td>
        </tr>
        <tr style="border-bottom: 1px #016004 solid">
          <td>
            <h3 class="d-inline"><i class="fas fa-street-view"></i></h3> Kecamatan
            <h3 id="d-kecamatan"></h3>
          </td>
          <td>
            <h3 class="d-inline"><i class="fas fa-street-view"></i></h3> Desa / Kelurahan
            <h3 id="d-desa-kelurahan"></h3>
          </td>
        </tr>
        

        <tr>
          <td colspan="2"><h3 class="txt-diy">Status Keluarga dan Perkawinan</h3></td>
        </tr>
        <tr>
          <td>
            <h3 class="d-inline"><i class="fas fa-street-view"></i></h3> Status Hubungan Keluarga
            <h3 id="d-status-hubungan-keluarga"></h3>
          </td>
          <td>
            <h3 class="d-inline"><i class="fas fa-street-view"></i></h3> Status Perkawinan
            <h3 id="d-status-perkawinan"></h3>
          </td>
        </tr>
        <tr>
          <td>
            <h3 class="d-inline"><i class="fas fa-street-view"></i></h3> Akta Kawin
            <h3 id="d-akta-kawin"></h3>
          </td>
          <td>
            <h3 class="d-inline"><i class="fas fa-street-view"></i></h3> Tanggal Kawin
            <h3 id="d-tanggal-kawin"></h3>
          </td>
        </tr>
        <tr style="border-bottom: 1px #016004 solid">
          <td>
            <h3 class="d-inline"><i class="fas fa-street-view"></i></h3> Akta Cerai
            <h3 id="d-akta-cerai"></h3>
          </td>
          <td>
            <h3 class="d-inline"><i class="fas fa-street-view"></i></h3> Tanggal Terbit Akta Cerai
            <h3 id="d-tanggal-cerai"></h3>
          </td>
        </tr>

        <tr>
          <td colspan="2"><h3 class="txt-diy">Informasi Tambahan</h3></td>
        </tr>
        <tr>
          <td>
            <h3 class="d-inline"><i class="fas fa-street-view"></i></h3> Nama Ibu
            <h3 id="d-nama-ibu"></h3>
          </td>
          <td>
            <h3 class="d-inline"><i class="fas fa-street-view"></i></h3> Nama Ayah
            <h3 id="d-nama-ayah"></h3>
          </td>
        </tr>
        <tr>
          <td>
            <h3 class="d-inline"><i class="fas fa-street-view"></i></h3> Keterangan
            <h3 id="d-keterangan"></h3>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>