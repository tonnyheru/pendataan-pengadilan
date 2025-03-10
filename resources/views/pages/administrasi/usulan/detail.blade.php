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
</style>
<div class="">
  <div class="card-body">
    <div class="row">
      <div class="col-md-2">
          <img src="{{ asset('img/default-avatar.png')}}" class="rounded" style="width: 100px; height:100px;" alt="circle-picture">
      </div>
      <table class="table table-borderless align-items-left table-flush table-header col-md-8">
        <tbody>
          <tr>
            <td>
              Nama pemohon
              <h3>{{ @$pemohon->name }}</h3>
            </td>
            <td>
              Nomor Induk Kependudukan (NIK)
              <h3>{{ @$pemohon->nik ?? '-' }}</h3>
            </td>
          </tr>
          <tr>
            <td>
              Tempat Lahir
              <h3>{{ Str::ucfirst(@$pemohon->tempat_lahir ?? '-') }}</h3>
            </td>
            <td>
              Tanggal Lahir
              <h3>{{ @$pemohon->tanggal_lahir ?? '-' }}</h3>
            </td>
          </tr>
          <tr>
            <td>
                Jenis Kelamin
                <h3>{{ Str::ucfirst(strtolower(@$pemohon->jenis_kelamin ?? '-')) }}</h3>
            </td>
            <td>
              Agama
              <h3>{{ Str::ucfirst(@$pemohon->agama ?? '-') }}</h3>
            </td>
          </tr>
          <tr>
            <td>
              Nomor Telepon
              <h3>{{ @$pemohon->no_telp ?? '-' }}</h3>
            </td>
            <td>
              Email
              <h3>{{ @$pemohon->email ?? '-' }}</h3>
            </td>
          </tr>
          <tr>
            @php
              $status = @$pemohon->status ?? '-';
              switch ($status) {
                case 'bk':
                  $status = 'Belum Kawin';
                  break;
                case 'k':
                  $status = 'Kawin';
                  break;
                case 'cm':
                  $status = 'Cerai Mati';
                  break;
                case 'ch':
                  $status = 'Cerai Hidup';
                  break;  
                default:
                  $status = '-';
                  break;
              }
            @endphp
            <td>
              Status Pernikahan
              <h3>{{ Str::ucfirst($status) }}</h3>
            </td>
          </tr>
          <tr>
            <td>
              Alamat
              <h3>{{ @$pemohon->alamat ?? '-' }}</h3>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>