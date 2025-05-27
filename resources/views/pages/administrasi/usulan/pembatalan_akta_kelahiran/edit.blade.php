<form action="{{ route('pembatalan_akta_kelahiran.update', $uid) }}" method="POST" id="myForm">
    @csrf
    @method('PUT')
    @include('pages.administrasi.usulan.pembatalan_akta_kelahiran.form')            
  </form>
  <div id="response_container"></div>