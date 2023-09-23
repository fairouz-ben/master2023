<?php 
$lang = app()->getLocale() == "ar" ? '.rtl':'';
?>
<!doctype html>
<html lang="{{(App::isLocale('ar') ? 'ar' : 'fr')}}"  dir="{{(App::isLocale('ar') ? 'rtl' : 'ltr')}}">
 
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

     <!-- Bootstrap core CSS    -->
     @if(app()->getLocale() == 'ar')
     @vite(['resources/css/bootstrap.rtl.min.css']) 
 @else

       {{--
     <link href="{{asset('build/assets/bootstrap.min.css')}}" rel="stylesheet">--}}
 @endif
</head>
<body>
    <div id="app">
     

        <main class="py-4">
            @yield('content')
        </main>
    </div>

     <!-- Scripts -->
     <script src="{{asset('build/assets/jquery-3.3.1.min.js')}}"></script> 
     <script>
         $(function () {
             $('#session-alert').fadeTo(2000, 500).slideUp(500, function () {
                 $('#session-alert').slideUp(500);
             })
         })
     </script>
 
    @yield('script')
</body>
</html>
