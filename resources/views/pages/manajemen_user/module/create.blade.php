<form action="{{ route('module.store') }}" method="POST" id="myForm">
    @csrf
    @include('pages.manajemen_user.module.form')            
  </form>
  <div id="response_container"></div>
  