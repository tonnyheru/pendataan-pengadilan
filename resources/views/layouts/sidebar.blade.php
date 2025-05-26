<style>
  
</style>
<nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">

  <div class="scrollbar-inner">
    <!-- Brand -->
    <div class="sidenav-header d-flex align-items-center">
      <a class="navbar-brand text-center">
        @php
        $logo = asset('img/logo.png');
        $title = 'PN Bale Bandung';
        $block = '';
        $slug = auth()->user()->role->slug;
        switch ($slug) {
          case 'disdukcapil_kota_cimahi':
            $logo = asset('img/logo-cimahi.png');
            $title = 'Disdukcapil Cimahi';
            break;
          case 'disdukcapil_kabupaten_bandung':
            $logo = asset('img/logo-bandung.png');
            $title = 'Disdukcapil Kabupaten <br> Bandung';
            $block = 'd-block';
            break;
          case 'disdukcapil_kabupaten_bandung_barat':
            $logo = asset('img/logo-barat.png');
            $title = 'Disdukcapil Kabupaten <br> Bandung Barat';
            $block = 'd-block';
            break;
          default:
            $logo = asset('img/logo.png');
            $title = 'PN Bale Bandung';
            break;
        }

        @endphp
        <img src="{{ $logo }}" style="max-height: 2rem !important;"> 
        <span class="text-sm font-weight-bold {{$block}}" style="font-size: 12px !important;">{!!$title!!}</span>
        
      </a>
      <div class="ml-auto">
        <!-- Sidenav toggler -->
        <div class="sidenav-toggler d-none d-xl-block" data-action="sidenav-unpin" data-target="#sidenav-main">
          <div class="sidenav-toggler-inner">
            <i class="sidenav-toggler-line"></i>
            <i class="sidenav-toggler-line"></i>
            <i class="sidenav-toggler-line"></i>
          </div>
        </div>
      </div>
    </div>
    <div class="navbar-inner">
      @php
      use App\Helpers\Menu;
      use App\Helpers\AuthCommon;
      $menu = '';
      // $role = session('role_permit');
      $permission = session('slug_permit');

      // dd($permission);

      $obj_menu = new Menu();
      $obj_menu->setPermission($permission);
      $obj_menu->init()
      ->start_group()
      ->item('Dashboard', 'ni ni-tv-2', 'app/dashboard', Request::is('app/dashboard'), "dashboard.view")
      ->end_group();

      $obj_menu->start_group()
      ->start_accordion()
      ->sub_item_accordion('Master','master',["disdukcapil.list"],'fas fa-cabinet-filing')
      ->start_item_accordion('master', (
      Request::is('app/disdukcapil')
      ))
      ->item('Disdukcapil', 'fas fa-poll-people', 'app/disdukcapil', Request::is('app/disdukcapil'), "disdukcapil.list")
      ->end_item_accordion()
      ->end_accordion()
      ->end_group();

      $obj_menu->start_group()
      ->start_accordion()
      ->sub_item_accordion('Administrasi','administrasi',["mutasi.list", "usulan.list", "mutasi.list"],'fas fa-database')
      ->start_item_accordion('administrasi', (
      Request::is('app/mutasi') ||
      Request::is('app/pemohon') ||
      Request::is('app/usulan') ||
      Request::is('app/usulan/perbaikan_akta') ||
      Request::is('app/usulan/akta_kematian')
      ))
      ->item('Pemohon', 'fas fa-clipboard-user', 'app/pemohon', Request::is('app/pemohon'), "pemohon.list")
      ->item('Usulan', 'fas fa-user-md-chat', 'app/usulan', (
        Request::is('app/usulan') ||
        Request::is('app/usulan/perbaikan_akta') ||
        Request::is('app/usulan/akta_kematian')
      ), "usulan.list")
      // ->item('Mutasi Data', 'fas fa-file-exclamation', 'app/mutasi', Request::is('app/mutasi'), "mutasi.list")
      ->end_item_accordion()
      ->end_accordion()
      ->end_group();


      

      $obj_menu->start_group()
      ->start_accordion()
      ->sub_item_accordion('Manajemen User','user-management',["module.list", "role.list", "user.list"], 'ni ni-badge')
      ->start_item_accordion('user-management', (
        Request::is('app/module') ||
      Request::is('app/user') ||
      Request::is('app/role') ||
      Request::is('app/permission') ||
      Request::is('app/role/permission/*')
      ))
      ->item('Manage Module', 'fas fa-project-diagram', 'app/module', (Request::is('app/module') || Request::is('app/permission')) , "module.list")
      ->item('Manage Role', 'fas fa-user-astronaut', 'app/role', (Request::is('app/role') || Request::is('app/role/permission/*')), "role.list")
      ->item('Manage User', 'ni ni-circle-08', 'app/user', Request::is('app/user'), "user.list")
      ->end_item_accordion()
      ->end_accordion()
      ->end_group();

      $obj_menu
      ->start_group()
      ->item('Profile', 'fas fa-user-cog', 'app/profile', Request::is('app/profile'), "profile.view")
      ->end_group();


      $menu = $obj_menu->to_html();
      @endphp
      {!! $menu !!}
    </div>
  </div>
</nav>