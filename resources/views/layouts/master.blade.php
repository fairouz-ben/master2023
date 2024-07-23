<?php 
$lang = app()->getLocale() == "ar" ? '.rtl':'';
?>
<!doctype html>
<html lang="{{(App::isLocale('ar') ? 'ar' : 'fr')}}"  dir="{{(App::isLocale('ar') ? 'rtl' : 'ltr')}}">
  
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="form">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>  {{__('translation.title')}}   </title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      
  <!-- Bootstrap core CSS    -->
  @if(app()->getLocale() == 'ar')
   @vite(['resources/css/bootstrap.rtl.min.css']) 
  @else
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

  @endif
  
  <link rel="stylesheet" href="{{asset('asset/css/scripts-multi-step-form.css')}}" id="main-style-link">
  
   <!-- Fonts -->
<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">

<body>
<div class=" banner d-flex justify-content-center">  
    <div class="col-12">	 
     {{-- <img  src="{{asset('ban.png')}}"  style="width:600px;"> --}}
	 
	 <blockquote class="blockquote text-center">
     <p class="mb-0"><h3>تسجيلات ماستر %20  </h3></p>
	  <p class="mb-0"><h3>Inscription Master 20%</h3></p>
	  <p> <h4>2024/2025</h4></p>
      {{-- <h2>{{$faculty->name_ar}} <br/>{{$faculty->name_fr}} </h2> --}}
      <p class="lead">{{__('translation.not')}}</p>
   
	</blockquote>
	</div>
   </div>
   
   <div class=" row mb-3">  
    <a class="btn btn-secondary " href="{{ url('/') }}">{{ __('pagination.home') }}</a>
   
    {{-- <x-langselector />  --}}
  </div>
  @guest
  @if (Route::has('login'))
  <a class="btn btn-secondary" href="{{ route('login') }}">{{ __('auth.Login') }}</a>
      
  @endif


@else
  <div class="col-4">
    <a class="btn btn-secondary" href="{{ route('logout') }}"
    onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">
     {{ __('auth.Logout') }}
 </a>
 <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
  @csrf
</form>

  </div>
  @endif
  @include('flash-message') 
  @yield('content')

  <footer class="my-5 pt-5 text-muted text-center text-small">
    <p class="mb-1" style="color:white;">&copy; {{__('pagination.The Academic Year')}} </p>
   
   
  </footer>
  @vite(['resources/js/app.js'])
  <script src="{{asset('asset/js/scripts-multi-step-form.js')}}"></script> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
   

    
    </body>
    </html>
    
