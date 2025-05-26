<form action="{{ route('akta_kematian.update', $uid) }}" method="POST" id="myForm">
    @csrf
    @method('PUT')
    @include('pages.administrasi.usulan.akta_kematian.form')            
  </form>
  <div id="response_container"></div>