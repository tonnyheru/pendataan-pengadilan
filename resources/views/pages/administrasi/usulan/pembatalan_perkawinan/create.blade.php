<form action="{{ route('pembatalan_perkawinan.store') }}" method="POST" id="myForm" enctype="multipart/form-data">
    @csrf
    @include('pages.administrasi.usulan.pembatalan_perkawinan.form')            
  </form>
  <div id="response_container"></div>
  