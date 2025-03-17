<form action="{{ route('disdukcapil.update', $uid) }}" method="POST" id="myForm">
    @csrf
    @method('PUT')
    @include('pages.master.disdukcapil.form')            
  </form>
  <div id="response_container"></div>