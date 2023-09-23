@extends('layouts.dashboard.template')

@section('content')
<div class="container" style="margin-top: 30px;">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Departments List</h1>
  
    <div class="btn-toolbar mb-2 mb-md-0">
      <div class="btn-group me-2">
          <!-- Button trigger modal -->
          {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <i class="bi bi-file-plus"></i>Add
          </button> --}}
        <a type="button" class="btn btn-sm btn-info" href="{{url('/departments/add')}}"> <i class="bi bi-file-plus"></i> Add</a>
      </div>
    </div>
  </div>
  @if (session()->has('success'))
    <div class="fixed bg-green-600 text-white py-2 px-4 rounded-xl bottom-3 right-3 text-sm">
        <p>{{ session()->get('success') }}</p>
    </div>
@endif
  <div class="table-responsive">
    <table class="table table-striped table-sm" style="min-height: 200px">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Faculty</th>
          <th scope="col">Name fr</th>
          <th scope="col">Nombre de choix par specialité</th>
          <th scope="col">Status</th>
          
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($departments as $department)
        <tr>
          <td>{{ $loop->iteration }}</td>
            <td>{{$department->faculty->name_fr}}</td>
            <td>{{$department->name_fr}}</td>
            <td>{{$department->speciality_max_choice}}</td>
            <td>
              @if($department->is_active)
              <span class="badge bg-success">Active</span>
              @else
              <span class="badge bg-danger">Disable</span>
              @endif

            </td>
            <td>
                    
              
              <div class="dropdown">
                  <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                  Actions
                  </button>
                  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li> <a type="submit" class="dropdown-item" href="{{url('departments/edit/'.$department->id)}}"><i class="bi bi-pencil-square m-1"></i> Edit</a></li>
                    
                    @if(!$department->is_active)
                  <li>
                      <form action="{{url('departments/active/'.$department->id)}}" method="post">
                        @csrf
                        <button type="submit" class="dropdown-item"><i class="bi bi-eye m-1"></i>  Activate</button>
                      </form> </li>
                    @else
                  <li>
                    <form action="{{url('departments/disable/'.$department->id)}}" method="post">
                      @csrf
                      <li><button type="submit" class="dropdown-item"><i class="bi bi-archive m-1"></i> Disable</button></li>
                    </form>
                  </li>
                    @endif
                  </ul>
              </div>
            </td>
          </tr>
        @endforeach
        
      </tbody>
    </table>
  </div>
</div>
@endsection



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add department</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{url('departments/store')}}" method="post">
          @csrf
          <div class="form-group">
            <label for="name">Name (ar)</label>
            <input type="text" class="form-control" name="name_ar" required>
          </div>
          <div class="form-group">
            <label for="name">Name (fr)</label>
            <input type="text" class="form-control" name="name_fr" required>
          </div>
          
          <div class="form-group">
            <label for="name">Faculty</label>
            <input type="text" class="form-control" name="faculty" required>
          </div>
          <div class="row m-4">
            <button class="btn btn-primary">Add</button>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save</button>
      </div>
    </div>
  </div>
</div>