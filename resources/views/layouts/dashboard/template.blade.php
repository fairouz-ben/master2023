<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Master univ alger">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Master</title>
    <!-- Bootstrap core CSS -->
  
    @vite(['resources/sass/app.scss', 'resources/js/app.js',]) 
    <link href="{{asset('asset22/css/bootstrap.min.css') }}" rel="stylesheet"> 
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="{{asset('asset22/css/dashboard.css') }}" rel="stylesheet">
  </head>
  <body>
    
<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">Administration</a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
  <div class="navbar-nav">
    <div class="nav-item text-nowrap">
    
      <a class="nav-link px-3" href="{{ route('logout') }}"
      onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
      {{ __('auth.Logout') }}
  </a>
    </div>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
      @csrf
  </form>
    </div>
  </div>
</header>

<div class="container-fluid">
  <div class="row">
    @include('layouts.dashboard.nav')
    

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      @yield('content')
      
    </main>
  </div>
</div>


    {{-- <script src="{{asset('build/asset/js/bootstrap.bundle.min.js') }}"></script> --}}

    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
    <script src="{{asset('asset22/js/dashboard.js') }}"></script>

    </body>
</html>
