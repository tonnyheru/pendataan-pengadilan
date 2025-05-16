<!DOCTYPE html>
<!--
=========================================================
* Argon Dashboard 2 PRO - v2.0.4
=========================================================

* Product Page:  https://www.creative-tim.com/product/argon-dashboard-pro 
* Copyright 2024 Creative Tim (https://www.creative-tim.com)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
--><html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="favicons/img-apple-icon.png">
  <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}">
  <title>
    Login | Pengadilan Negeri Bale Bandung  
  </title>
  <!-- Extra details for Live View on GitHub Pages -->
  <!-- Canonical SEO -->
  <!--  Social tags      -->
  <meta name="keywords" content="creative tim, html dashboard, html css dashboard, web dashboard, bootstrap 5 dashboard, bootstrap 5, css3 dashboard, bootstrap 5 admin, Argon Dashboard bootstrap 5 dashboard, frontend, responsive bootstrap 5 dashboard, soft design, soft dashboard bootstrap 5 dashboard">
  <meta name="description" content="Argon Dashboard PRO is a beautiful Bootstrap 5 admin dashboard with a large number of components, designed to look beautiful, clean and organized. If you are looking for a tool to manage dates about your business, this dashboard is the thing for you.">
  
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Nucleo Icons -->
  <link href="{{asset('argon2/assets/css/css-nucleo-icons.css')}}" rel="stylesheet">
  <link href="{{asset('argon2/assets/css/css-nucleo-svg.css')}}" rel="stylesheet">
  <!-- Font Awesome Icons -->
  <link href="{{asset('argon2/assets/css/css-nucleo-svg.css')}}" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="{{asset('argon2/assets/css/css-argon-dashboard.min.css')}}" rel="stylesheet">
  <!-- Anti-flicker snippet (recommended)  -->
  <style>
    .async-hide {
      opacity: 0 !important
    }
  </style>
</head>

<body class="bg-gray-100">
  
  <main class="main-content  mt-0">
    <div class="page-header align-items-start min-vh-50 pt-7 pb-9 m-3 border-radius-lg" style="background-image: url('{{asset('img/pengadilan.png')}}'); background-size: 80%; ">
      <span class="mask bg-gradient-dark opacity-4"></span>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-8 text-center mx-auto">
            <img src="{{asset('img/logo.png')}}" width="200">
            <img src="{{asset('img/logo-cimahi.png')}}" width="150">
            <img src="{{asset('img/logo-bandung.png')}}" width="250">
            <img src="{{asset('img/logo-barat.png')}}" width="150">
            <h3 class="text-white mb-2 mt-5">Pengadilan Negeri Bale Bandung</h3>
            <p class="text-lead text-white">Pengadilan Negeri Bale Bandung Kelas 1A merupakan sebuah lembaga peradilan di lingkungan Peradilan Umum yang berkedudukan di Kabupaten Bandung.</p>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row mt-lg-n10 mt-md-n11 mt-n10 justify-content-center">
        <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
          <div class="card mt-5">
            <div class="card-header pb-0 text-start">
              <h3 class="font-weight-bolder">Log In</h3>
              <p class="mb-0">Masukan username dan password untuk Log In</p>
            </div>
            <div class="card-body">
              @if(session('error'))
              <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{session('error')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              @endif
              @error('login_failed')
              <div class="alert alert-danger alert-dismissible fade show text-white" role="alert">
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              @enderror
              <form role="form" class="text-start" method="POST" action="{{ route('auth.login_process') }}">
                @csrf
                <label>Username</label>
                <div class="mb-3">
                  <input type="text" name="username" class="form-control" placeholder="Username" aria-label="Userame">
                  @if($errors->has('username'))
                    <span class="text-danger text-sm">{{ $errors->first('username') }}</span>
                  @endif
                </div>
                <label>Password</label>
                <div class="mb-3">
                  <input type="password" name="password" class="form-control" placeholder="Password" aria-label="Password">
                  @if($errors->has('password'))
                    <span class="text-danger text-sm">{{ $errors->first('password') }}</span>
                  @endif
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary w-100 mt-4 mb-0" style="background: #016004 !important">Log In</button>
                </div>
              </form>
            </div>
            
          </div>
        </div>
      </div>
    </div>
  </main>
  <!-- -------- START FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
  <footer class="footer py-5">
    <div class="container">
      <div class="row">
        <div class="col-8 mx-auto text-center mt-1">
          <p class="mb-0 text-secondary">
            Copyright &copy; {{date('Y')}}, M Tonny Heru Susanto. All rights reserved
          </p>
        </div>
      </div>
    </div>
  </footer>
  <!-- -------- END FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
  <!--   Core JS Files   -->
  <script src="{{asset('argon2/assets/js/core-popper.min.js')}}"></script>
  <script src="{{asset('argon2/assets/js/core-bootstrap.min.js')}}"></script>
  <script src="{{asset('argon2/assets/js/plugins-perfect-scrollbar.min.js')}}"></script>
  <script src="{{asset('argon2/assets/js/plugins-smooth-scrollbar.min.js')}}"></script>
  <!-- Kanban scripts -->
  <script src="{{asset('argon2/assets/js/dragula-dragula.min.js')}}"></script>
  <script src="{{asset('argon2/assets/js/jkanban-jkanban.js')}}"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="{{asset('argon2/assets/js/buttons.github.io-buttons.js')}}"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{asset('argon2/assets/js/js-argon-dashboard.min.js')}}"></script>
</body>

</html>
