<form action="{{ route('akta_kematian.store') }}" method="POST" id="myForm" enctype="multipart/form-data">
    @csrf
    @include('pages.administrasi.usulan.akta_kematian.form')            
  </form>
  <div id="response_container"></div>
  