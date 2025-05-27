<form action="{{ route('pembatalan_perceraian.store') }}" method="POST" id="myForm" enctype="multipart/form-data">
    @csrf
    @include('pages.administrasi.usulan.pembatalan_perceraian.form')            
  </form>
  <div id="response_container"></div>
  