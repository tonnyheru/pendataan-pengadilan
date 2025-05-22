<form action="{{ route('perbaikan_akta.store') }}" method="POST" id="myForm" enctype="multipart/form-data">
    @csrf
    @include('pages.administrasi.usulan.perbaikan_akta.form')            
  </form>
  <div id="response_container"></div>
  