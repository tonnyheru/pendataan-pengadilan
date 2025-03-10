<form action="{{ route('usulan.update', $uid) }}" method="POST" id="myForm">
    @csrf
    @method('PUT')
    @include('pages.administrasi.usulan.form')            
  </form>
  <div id="response_container"></div>