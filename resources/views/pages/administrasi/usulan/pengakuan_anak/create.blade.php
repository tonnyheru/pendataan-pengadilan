<form action="{{ route('pengakuan_anak.store') }}" method="POST" id="myForm" enctype="multipart/form-data">
    @csrf
    @include('pages.administrasi.usulan.pengakuan_anak.form')            
  </form>
  <div id="response_container"></div>
  