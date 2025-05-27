<form action="{{ route('pembatalan_akta_kelahiran.store') }}" method="POST" id="myForm" enctype="multipart/form-data">
    @csrf
    @include('pages.administrasi.usulan.pembatalan_akta_kelahiran.form')            
  </form>
  <div id="response_container"></div>
  