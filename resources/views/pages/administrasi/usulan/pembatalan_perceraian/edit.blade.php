<form action="{{ route('pembatalan_perceraian.update', $uid) }}" method="POST" id="myForm">
    @csrf
    @method('PUT')
    @include('pages.administrasi.usulan.pembatalan_perceraian.form')            
  </form>
  <div id="response_container"></div>