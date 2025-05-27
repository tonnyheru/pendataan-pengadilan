<form action="{{ route('pembatalan_perkawinan.update', $uid) }}" method="POST" id="myForm">
    @csrf
    @method('PUT')
    @include('pages.administrasi.usulan.pembatalan_perkawinan.form')            
  </form>
  <div id="response_container"></div>