<form action="{{ route('permission.update', $uid) }}" method="POST" id="myForm">
    @csrf
    @method('PUT')
    @include('pages.manajemen_user.permission.form')            
  </form>
  <div id="response_container"></div>