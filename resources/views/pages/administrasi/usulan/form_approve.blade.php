<form action="{{ route('usulan.store') }}" method="POST" id="myForm" enctype="multipart/form-data">
    @csrf
    @include('pages.administrasi.usulan.form')            
  </form>
  <div id="response_container"></div>
  