<form action="{{ route('permission.store') }}" method="POST" id="myForm">
    @csrf
    @include('pages.manajemen_user.permission.form')            
  </form>
  <div id="response_container"></div>
  