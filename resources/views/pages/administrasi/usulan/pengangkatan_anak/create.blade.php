<form action="{{ route('pengangkatan_anak.store') }}" method="POST" id="myForm" enctype="multipart/form-data">
    @csrf
    @include('pages.administrasi.usulan.pengangkatan_anak.form')            
  </form>
  <div id="response_container"></div>
  