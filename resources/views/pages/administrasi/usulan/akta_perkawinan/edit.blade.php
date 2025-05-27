<form action="{{ route('akta_perkawinan.update', $uid) }}" method="POST" id="myForm">
    @csrf
    @method('PUT')
    @include('pages.administrasi.usulan.akta_perkawinan.form')            
  </form>
  <div id="response_container"></div>