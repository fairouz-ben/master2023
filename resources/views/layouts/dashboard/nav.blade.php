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
              <a class="nav-link" href="{{ url('users') }}">
                  <span data-feather="layers"></span>
                  Users
              </a>
          </li>
            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                <span> la liste des inscrits</span>
                <a class="link-secondary" href="#" aria-label="listinscrit">
                    <span data-feather="layers"></span>
                </a>
            </h6>

            @if (Auth::user()->role_id == 1)
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/students/1') }}">
                        <span data-feather="users"></span>
                        Faculté de Droit
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/students/2') }}">
                        <span data-feather="users"></span>
                        Faculté Sciences Islamique
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/students/5') }}">
                        <span data-feather="users"></span>
                        Faculté de Sciences


                    </a>

                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{route('admin.students.stat')}}">
                        <span data-feather="bar-chart-2"></span>
                        Statistique
                    </a>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/students') }}">
                        <span data-feather="users"></span>
                        {{-- Faculté de Sciences --}}
                        {{ Auth::guard('admin')->user()->faculty->name_fr }}

                    </a>

                </li>
            @endif

            @if (Auth::guard('admin')->user()->hasRole('administrator') || Auth::guard('admin')->user()->hasRole('manager'))
                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                    <span> {{ __('Recours') }}</span>
                    <a class="link-secondary" href="#" aria-label="listinscrit">
                        <span data-feather="layers"></span>
                    </a>
                </h6>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/list_recours') }}">
                        <span data-ask="users"></span>
                        Liste des recours
                    </a>

                </li>
            @endif
           

          

        </ul>
        @if (Auth::user()->role_id == 1)
            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                <span>Setting</span>
                <a class="link-secondary" href="#" aria-label="Add a new report">
                    <span data-feather="plus-circle"></span>
                </a>
            </h6>



            <ul class="nav flex-column mb-2">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('appconfig') }}">
                        <span data-feather="users"></span>
                        Configuration: Open/close
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.list') }}">
                        <span data-feather="users"></span>
                        Admins
                    </a>
                </li>


                <li class="nav-item">
                    <a class="nav-link" href="{{ url('faculties') }}">
                        <span data-feather="layers"></span>
                        Faculties
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('departments') }}">
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

                <a class="dropdown-item" 
                    onclick="event.preventDefault();
                      document.getElementById('logout-admin').submit();">
                    {{ __('Logout') }}
                </a>
            </li>
        </ul>
        



    </div>
    <form id="logout-admin" action="{{ route('admin.logout') }}" method="POST" class="d-none">
        @csrf
    </form>
</nav>
