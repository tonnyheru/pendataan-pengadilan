
<li class="nav-item dropdown">
    <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <div class="media align-items-center">
        <span>
          @php
            use App\Helpers\AuthCommon;
            $avatar = AuthCommon::user()->profile_picture;
            $avatar = $avatar != null ? asset('upload/'.$avatar) : asset('img/default-avatar.png');
          @endphp
          <img class="avatar avatar-sm rounded-circle" style="object-fit: cover" alt="Image placeholder" src="{{ $avatar }}">
        </span>
        <div class="media-body ml-2 d-none d-lg-block">
          <span class="mb-0 text-sm font-weight-bold">{{ @\App\Helpers\AuthCommon::user()->name }}</span>
          <div class="mb-0 text-sm" style="font-size: 12px !important">{{ @\App\Helpers\AuthCommon::user()->role->name }}</div>
        </div>
      </div>
    </a>
    <div class="dropdown-menu dropdown-menu-right">
      <div class="dropdown-header noti-title">
        <h6 class="text-overflow m-0">Welcome!</h6>
      </div>
      <div class="dropdown-divider"></div>
      <a href="{{ route('auth.logout') }}" class="dropdown-item">
        <i class="fas fa-sign-out-alt"></i>
        <span>Logout</span>
      </a>
    </div>
  </li>