<form action="{{ route('akta_perceraian.store') }}" method="POST" id="myForm" enctype="multipart/form-data">
    @csrf
    @include('pages.administrasi.usulan.akta_perceraian.form')            
  </form>
  <div id="response_container"></div>
  