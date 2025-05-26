<form action="{{ route('perbaikan_akta.update', $uid) }}" method="POST" id="myForm">
    @csrf
    @method('PUT')
    @include('pages.administrasi.usulan.perbaikan_akta.form')            
  </form>
  <div id="response_container"></div>