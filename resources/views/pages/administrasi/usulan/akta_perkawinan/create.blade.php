<form action="{{ route('akta_perkawinan.store') }}" method="POST" id="myForm" enctype="multipart/form-data">
    @csrf
    @include('pages.administrasi.usulan.akta_perkawinan.form')            
  </form>
  <div id="response_container"></div>
  