<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
  <div class="position-sticky pt-3">
    <ul class="nav flex-column">
      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="#">
          <span data-feather="home"></span>
          Dashboard
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{url('/students')}}">
          <span data-feather="users"></span>
          {{__('translation.listinscrit')}}
        </a>
       
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{url('/students/1')}}">
          <span data-feather="users"></span>
          Etudients Droit
        </a>
      </li>
     
      <li class="nav-item">
        <a class="nav-link" href="#">
          <span data-feather="bar-chart-2"></span>
          Statistique
        </a>
      </li>
     
    </ul>
    @if(Auth::user()->role_id == 1)
    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
      <span>Setting</span>
      <a class="link-secondary" href="#" aria-label="Add a new report">
        <span data-feather="plus-circle"></span>
      </a>
    </h6>
    
      
  
    <ul class="nav flex-column mb-2">
      <li class="nav-item">
        <a class="nav-link" href="{{url('users')}}">
          <span data-feather="layers"></span>
          Users
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{url('faculties')}}">
          <span data-feather="layers"></span>
          Faculties
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{url('departments')}}">
          <span data-feather="layers"></span>
          Departments and specialities
        </a>
      </li>
      {{-- <li class="nav-item">
        <a class="nav-link" href="{{url('specialities')}}">
          <span data-feather="layers"></span>
          Users
        </a>
      </li> --}}
     
    </ul>
    @endif
    <hr>
    <ul class="nav flex-column">
      <li class="nav-item">
       
        <a class="dropdown-item" href="{{ route('admin.logout') }}"
        onclick="event.preventDefault();
                      document.getElementById('logout-form-admin').submit();">
         {{ __('Logout') }}
     </a>
      </li>
    </ul>                           
   
        
     
  </div>
  <form id="logout-form-admin" action="{{ route('admin.logout') }}" method="POST" class="d-none">
    @csrf
</form>
</nav>