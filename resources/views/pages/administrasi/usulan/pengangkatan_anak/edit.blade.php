<form action="{{ route('pengangkatan_anak.update', $uid) }}" method="POST" id="myForm">
    @csrf
    @method('PUT')
    @include('pages.administrasi.usulan.pengangkatan_anak.form')            
  </form>
  <div id="response_container"></div>