<form action="{{ route('module.update', $uid) }}" method="POST" id="myForm">
    @csrf
    @method('PUT')
    @include('pages.manajemen_user.module.form')            
  </form>
  <div id="response_container"></div>