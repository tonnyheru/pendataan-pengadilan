<form action="{{ route('mutasi.update', $uid) }}" method="POST" id="myForm">
    @csrf
    @method('PUT')
    @include('pages.manajemen_data.mutasi.form')            
  </form>
  <div id="response_container"></div>