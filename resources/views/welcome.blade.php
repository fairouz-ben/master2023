<!doctype html>
<html lang="{{(App::isLocale('ar') ? 'ar' : 'fr')}}"  dir="{{(App::isLocale('ar') ? 'rtl' : 'ltr')}}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="master page">
    <meta name="generator" content="Hugo 0.84.0">
    <title> {{__('translation.title')}} </title>

    

    <!-- Bootstrap core CSS -->
       @vite(['resources/sass/app.scss', 'resources/js/app.js',])


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
    {{-- <link href="{{asset('build/assets/carousel.css')}}" rel="stylesheet"> --}}
    @vite('resources/css/carousel.css')
  </head>
  <body>
    
<header>
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#"> {{__('translation.title')}} </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
       <x-langselector /> 
     
        
    </div>
  </nav>
</header>

<main>

  <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
    </div>
    <div class="carousel-inner" >
      <div class="carousel-item active">
        <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#777"/></svg>

        {{-- <img src="{{asset('site_univ2022.jpg')}}" width="100%" height="100%"  alt="univ image"> --}}
        <div class="container" >
          <div class="carousel-caption text-end">
            <h1>الترشح للماستر</h1>
            <p class="lead"> منصة التسجيل للماستر 20% حسب الأماكن البيداغوجية المتاحة</p>
            {{-- <p><a class="btn btn-lg btn-primary" href="#">Lire...</a></p> --}}
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#777"/></svg>

        <div class="container">
          <div class="carousel-caption">
            <h1>Inscription au Master 20%</h1>
            <p>Platform d'inscription au Master 20% selon les places pedagogie disponible</p>
            {{-- <p><a class="btn btn-lg btn-primary" href="#">Learn more</a></p> --}}
          </div>
        </div>
      </div>
     
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>


  <!-- Marketing messaging and featurettes
  ================================================== -->
  <!-- Wrap the rest of the page in another container to center all the content. -->
@if ($etat)
<div class="container marketing">

  <!-- Three columns of text below the carousel -->
  <div class="row">
    <div class="col-lg-4">
       <img src="{{asset('islamic_fr.png')}}" class="bd-placeholder-img rounded-circle img-fluid"  width="200" height="200" alt="fac SI">
      <h2>كلية العلوم الإسلامية</h2>
      <p>Faculté Sciences Islamique</p>
      <b>{{__('translation.Inscription')}}</b>
      <p><a class="btn btn-secondary" href="{{ url('create_account/is') }}"> {{__('translation.Create an account')}} &raquo;  </a></p>
    </div>
    <!-- /.col-lg-4 -->
    <div class="col-lg-4">
      <img src="{{asset('droit_fr.png')}}" class="bd-placeholder-img rounded-circle img-fluid"  width="200" height="200" alt="fac SI">
     <h2>كلية الحقوق</h2>
     <p>Faculté de Droit</p>
     <b>{{__('translation.Inscription')}}</b>
     <p><a class="btn btn-secondary" href="{{ url('create_account/droit') }}">  {{__('translation.Create an account')}}  &raquo;</a></p>
   </div><!-- /.col-lg-4 -->
   <div class="col-lg-4">
    <img src="{{asset('sciences_fr.png')}}" class="bd-placeholder-img rounded-circle img-fluid"  width="200" height="200" alt="fac SI">
   <h2>كلية العلوم</h2>
   <p>Faculté  des Sciences </p>
   <b>{{__('translation.Inscription')}}</b>
   <p><a class="btn btn-secondary" href="{{ url('create_account/sciences') }}"> {{__('translation.Create an account')}} &raquo;</a></p>
 </div><!-- /.col-lg-4 -->
  </div><!-- /.row -->
      <!-- Three columns of text below the carousel -->
      <hr class="featurette-divider">
      <div class="row m-13">
        <div class="col-lg-12 text-center">
           <img src="{{asset('login.webp')}}" class="bd-placeholder-img rounded-circle img-fluid"  width="200" height="200" alt="fac SI">
          <h2>الدخول</h2>
          <p>login</p>
          <p><a class="btn btn-secondary" href="{{ url('login') }}"> الدخول إلى الحساب &raquo;</a></p>
        </div><!-- /.col-lg-4 -->
        
        <!-- /.col-lg-4 -->
        {{-- <div class="col-lg-4">
          <svg class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 140x140" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#777"/><text x="50%" y="50%" fill="#777" dy=".3em">140x140</text></svg>
  
          <h2>Heading</h2>
          <p>And lastly this, the third column of representative placeholder content.</p>
          <p><a class="btn btn-secondary" href="#">View details &raquo;</a></p>
        </div> --}}
      </div><!-- /.row -->


  <!-- START THE FEATURETTES -->

  {{-- <hr class="featurette-divider">

  <div class="col-6">
    <p>
      <span style="color: red">
      في حالة تعذر الحصول على 'رابط التحقق من عنوان بريدك الإلكتروني في المنصة'. يرجى مراسلتنا عبر البريد الإلكتروني
      <a href="mailto:master1@univ-alger.dz">master1@univ-alger.dz</a>
      </span>
    </p>
  </div>
  <hr class="featurette-divider"> --}}
  <!-- /END THE FEATURETTES -->

</div><!-- /.container -->
@else
<div class="container marketing">
<div class="alert alert-danger" role="alert">
  The plateform is closed!
</div>
</div>
@endif
  


  <!-- FOOTER -->
  <footer class="container">
    <p class="float-end"><a href="#">{{__('pagination.Back to the top')}} </a> <br/></p>
    <p>&copy; {{__('pagination.The Academic Year')}} &middot;  </p>
  </footer>
</main>      
  
      
  </body>
</html>
