<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>{{__('translation.title')}} </title>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- Bootstrap core CSS -->
@vite(['resources/sass/app.scss', 'resources/js/app.js',])
@vite('resources/css/dashboard.css')
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

    
  </head>
  <body>
    
<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  
<nav class="navbar navbar-expand-lg navbar-dark bg-dark" aria-label="Ninth navbar example">
  <div class="container-xl">
    <a class="navbar-brand" href="#">Administration</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample07XL" aria-controls="navbarsExample07XL" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarsExample07XL">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">        
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="dropdown07XL" data-bs-toggle="dropdown" aria-expanded="false">
            {{ Auth::guard('admin')->user()->name }}
          </a>
          <ul class="dropdown-menu" aria-labelledby="dropdown07XL">
            <li>
              <a class="dropdown-item" href="{{ route('admin.logout') }}"
              onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
               {{ __('Logout') }}
           </a>
 
           <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
               @csrf
           </form>

            </li>
          </ul>
        </li>
      </ul>
      
        
    </div>
  
  </div>
</nav>
</header>
<div class="container-fluid">
  <div class="row" style="margin-top: 50px;">
    @include('layouts.dashboard.nav')

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 g-20" style="margin-top: 50px;">
      @yield('content')
    </main>
  </div>
</div>



      <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
     {{-- <script src="{{asset('build/assets/pp/app.9508c71c.js')}}"></script>
  --}}
     @stack('scripts')
  </body>
</html>
