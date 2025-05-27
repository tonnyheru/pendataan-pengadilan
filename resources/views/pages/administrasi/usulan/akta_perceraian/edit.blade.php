<form action="{{ route('akta_perceraian.update', $uid) }}" method="POST" id="myForm">
    @csrf
    @method('PUT')
    @include('pages.administrasi.usulan.akta_perceraian.form')            
  </form>
  <div id="response_container"></div>