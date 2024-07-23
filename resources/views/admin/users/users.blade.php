<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="master">
    <meta name="generator" content="Master">
    <title>Dashboard </title>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
 

    <!-- Bootstrap core CSS  app.cf2a0f77.css-->
<link href="{{asset('build/assets/app.0720a852.css')}}" rel="stylesheet">

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
    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom bg-dark text-white">
      <a href="/" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
        <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"></use></svg>
      </a>

      <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
        <li><a href="#" class="nav-link px-2 link-secondary">Home</a></li>
        <li><a href="#" class="nav-link px-2 ">Features</a></li>
      </ul>

      <div class="col-md-3 text-end">
        
        <a class="dropdown-item" href="{{ route('admin.logout') }}"
        onclick="event.preventDefault();
                      document.getElementById('logout-form-admin').submit();">
         
         <button type="button" class="btn btn-primary">{{ __('Logout') }}</button>
     </a>

     <form id="logout-form-admin" action="{{ route('admin.logout') }}" method="POST" class="d-none">
         @csrf
     </form>
      </div>
    </header>
    <nav class="navbar navbar-light bg-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">
          
          <img src="{{asset('logo.png')}}" alt="" width="30" height="24" class="d-inline-block align-text-top">
          Admin
        </a>
      </div>
    </nav> 


<div class="container-fluid">
  <div class="row">
    @include('layouts.dashboard.nav')

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <a class="btn btn-primary" href="{{route('user.create')}}"><h5> Créer un nouveau compte</h5> </a>
                   
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Users List</h1>
       
      </div>
      <div class="table-responsive">
        {{ $dataTable->table() }}
      </div>
      @push('scripts')
        {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
      @endpush
    </main>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
  
  /*$.ajaxSetup({
      headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
  */  
      $('#users-table').on('click', '.active', function() {
       
          if (confirm("définir l'e-mail comme vérifié?") == true) {
              var id = $(this).data('id');

              //ajax
              $.ajax({

                  type: "POST",
                  url: "{{ url('users/user_email_verified') }}",
                  data: {
                      id: id,
                      _token: '{!! csrf_token() !!}'
                  },
                  dataType: 'json',
                  success: function(res) {

                      var oTable = $('#users-table').dataTable();
                      oTable.fnDraw(false);
                  }
              });
              
              //end ajax
          }
      });

  


  });
</script>
   
      <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
    <script src="{{asset('build/assets/app.48c416dd.js ')}}"></script>
      {{-- app.9508c71c.js  --}}
      @stack('scripts')
  </body>
</html>
