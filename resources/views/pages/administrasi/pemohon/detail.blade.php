@php
use App\Helpers\Utils;
use Illuminate\Support\Str;
@endphp
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
            <h3 id="d-nama">{{ @$pemohon->name }}</h3>
          </td>
        </tr>
        <tr>
          <td>
            <h3 class="d-inline"><i class="fas fa-street-view"></i></h3> Tempat, Tanggal Lahir
            <h3 id="d-tempat-tanggal-lahir">{{ @$pemohon->tempat_lahir }}, {{ @$pemohon->tanggal_lahir }}</h3>
          </td>
          <td>
            <h3 class="d-inline"><i class="fas fa-street-view"></i></h3> Jenis Kelamin
            <h3 id="d-jenis-kelamin">{{ @$pemohon->jenis_kelamin }}</h3>
          </td>
        </tr>
        <tr>
          <td>
            <h3 class="d-inline"><i class="fas fa-street-view"></i></h3> Golongan Darah
            <h3 id="d-golongan-darah">{{ @$pemohon->blood_type }}</h3>
          </td>
          <td>
            <h3 class="d-inline"><i class="fas fa-street-view"></i></h3> Agama
            <h3 id="d-agama">{{ @$pemohon->religion }}</h3>
          </td>
        </tr>
        <tr style="border-bottom: 1px #016004 solid">
          <td>
            <h3 class="d-inline"><i class="fas fa-street-view"></i></h3> Pendidikan
            <h3 id="d-pendidikan">{{ @$pemohon->education }}</h3>
          </td>
          <td>
            <h3 class="d-inline"><i class="fas fa-street-view"></i></h3> Pekerjaan
            <h3 id="d-pekerjaan">{{ @$pemohon->job }}</h3>
          </td>
        </tr>
        <tr>
          <td colspan="2"><h3 class="txt-diy">Informasi Identitas</h3></td>
        </tr>
        <tr>
          <td>
            <h3 class="d-inline"><i class="fas fa-hdd"></i></h3> Nomor Induk Kependudukan (NIK)
            <h3 id="d-nik">{{ @$pemohon->nik }}</h3>
          </td>
        </tr>
        <tr>
          <td>
            <h3 class="d-inline"><i class="fas fa-hdd"></i></h3> Nomor Kartu Keluarga (KK)
            <h3 id="d-kk">{{ @$pemohon->kk }}</h3>
          </td>
          <td>
            <h3 class="d-inline"><i class="fas fa-street-view"></i></h3> Akta Kelahiran
            <h3 id="d-akta-kelahiran">{{ @$pemohon->akta_kelahiran }}</h3>
          </td>
        </tr>
        <tr style="border-bottom: 1px #016004 solid">
          <td>
            <h3 class="d-inline"><i class="fas fa-street-view"></i></h3> Nomor Paspor
            <h3 id="d-nomor-paspor">{{ @$pemohon->nomor_paspor }}</h3>
          </td>
          <td>
            <h3 class="d-inline"><i class="fas fa-street-view"></i></h3> Tanggal Berlaku Paspor
            <h3 id="d-tanggal-berlaku-paspor">{{ @$pemohon->tanggal_berlaku_paspor }}</h3>
          </td>
        </tr>
        
        <tr>
          <td colspan="2"><h3 class="txt-diy">Informasi Kontak</h3></td>
        </tr>
        <tr style="border-bottom: 1px #016004 solid">
          <td>
            <h3 class="d-inline"><i class="fas fa-street-view"></i></h3> Email
            <h3 id="d-email">{{ @$pemohon->email }}</h3>
          </td>
          <td>
            <h3 class="d-inline"><i class="fas fa-street-view"></i></h3> No Telepon
            <h3 id="d-telpon">{{ @$pemohon->no_telp }}</h3>
          </td>
        </tr>


        <tr>
          <td colspan="2"><h3 class="txt-diy">Alamat dan Domisili</h3></td>
        </tr>
        <tr>
          <td>
            <h3 class="d-inline"><i class="fas fa-memory"></i></h3> Provinsi
            <h3 id="d-provinsi">{{ @$pemohon->province }}</h3>
          </td>
          <td>
            <h3 class="d-inline"><i class="fas fa-user"></i></h3> Kabupaten / Kota
            <h3 id="d-kabupaten-kota">{{ @$pemohon->regency }}</h3>
          </td>
        </tr>
        <tr style="border-bottom: 1px #016004 solid">
          <td>
            <h3 class="d-inline"><i class="fas fa-street-view"></i></h3> Kecamatan
            <h3 id="d-kecamatan">{{ @$pemohon->district }}</h3>
          </td>
          <td>
            <h3 class="d-inline"><i class="fas fa-street-view"></i></h3> Desa / Kelurahan
            <h3 id="d-desa-kelurahan">{{ @$pemohon->village }}</h3>
          </td>
        </tr>
        

        <tr>
          <td colspan="2"><h3 class="txt-diy">Status Keluarga dan Perkawinan</h3></td>
        </tr>
        <tr>
          <td>
            <h3 class="d-inline"><i class="fas fa-street-view"></i></h3> Status Hubungan Keluarga
            <h3 id="d-status-hubungan-keluarga">{{ @$pemohon->family_relationship }}</h3>
          </td>
          <td>
            <h3 class="d-inline"><i class="fas fa-street-view"></i></h3> Status Perkawinan
            <h3 id="d-status-perkawinan">{{ @$pemohon->marital_status }}</h3>
          </td>
        </tr>
        <tr>
          <td>
            <h3 class="d-inline"><i class="fas fa-street-view"></i></h3> Akta Kawin
            <h3 id="d-akta-kawin">{{ @$pemohon->akta_kawin }}</h3>
          </td>
          <td>
            <h3 class="d-inline"><i class="fas fa-street-view"></i></h3> Tanggal Kawin
            <h3 id="d-tanggal-kawin">{{ @$pemohon->tanggal_kawin }}</h3>
          </td>
        </tr>
        <tr style="border-bottom: 1px #016004 solid">
          <td>
            <h3 class="d-inline"><i class="fas fa-street-view"></i></h3> Akta Cerai
            <h3 id="d-akta-cerai">{{ @$pemohon->akta_cerai }}</h3>
          </td>
          <td>
            <h3 class="d-inline"><i class="fas fa-street-view"></i></h3> Tanggal Terbit Akta Cerai
            <h3 id="d-tanggal-cerai">{{ @$pemohon->tanggal_cerai }}</h3>
          </td>
        </tr>

        <tr>
          <td colspan="2"><h3 class="txt-diy">Informasi Tambahan</h3></td>
        </tr>
        <tr>
          <td>
            <h3 class="d-inline"><i class="fas fa-street-view"></i></h3> Nama Ibu
            <h3 id="d-nama-ibu">{{ @$pemohon->nama_ibu }}</h3>
          </td>
          <td>
            <h3 class="d-inline"><i class="fas fa-street-view"></i></h3> Nama Ayah
            <h3 id="d-nama-ayah">{{ @$pemohon->nama_ayah }}</h3>
          </td>
        </tr>
        <tr>
          <td>
            <h3 class="d-inline"><i class="fas fa-street-view"></i></h3> Keterangan
            <h3 id="d-keterangan">{{ @$pemohon->keterangan }}</h3>
          </td>
        </tr>
      </tbody>
    </table>
  </div>  