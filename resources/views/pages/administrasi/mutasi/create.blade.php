<form action="{{ route('mutasi.store') }}" method="POST" id="myForm" enctype="multipart/form-data">
    @csrf
    @include('pages.administrasi.mutasi.form')            
  </form>
  <div id="response_container"></div>
  