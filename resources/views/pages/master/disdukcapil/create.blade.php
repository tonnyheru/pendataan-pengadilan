<form action="{{ route('disdukcapil.store') }}" method="POST" id="myForm" enctype="multipart/form-data">
    @csrf
    @include('pages.master.disdukcapil.form')            
  </form>
  <div id="response_container"></div>
  