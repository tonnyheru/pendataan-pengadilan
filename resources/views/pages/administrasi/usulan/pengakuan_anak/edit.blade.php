<form action="{{ route('pengakuan_anak.update', $uid) }}" method="POST" id="myForm">
    @csrf
    @method('PUT')
    @include('pages.administrasi.usulan.pengakuan_anak.form')            
  </form>
  <div id="response_container"></div>