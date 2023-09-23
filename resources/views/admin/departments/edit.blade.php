@extends('layouts.dashboard.template')

@section('content')
<div class="container" style="margin-top: 30px;">
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Edit Department</h1>
  <div class="btn-toolbar mb-2 mb-md-0">
  </div>
</div>
<div class="container">
  <div class="row">
    <div class="col-3">
      <div class="btn-group me-2">
      
      <a type="button" class="btn btn-sm btn-info" href="{{ route('specialities', ['department' => $department->id]) }}"> <i class="bi bi-file-plus"></i> List of specialities</a>
    </div>
    <div class="btn-group me-2">
      
      <a type="button" class="btn btn-sm btn-info" href="{{ route('speciality.add', ['department' => $department->id]) }}"> <i class="bi bi-file-plus"></i> Add speciality</a>
    </div>
    </div>
    <div class="col-6">
      <form action="{{url('departments/update/'.$department->id)}}" method="post">
        @csrf
        <div class="form-group">
          <label for="name_ar">Name ar</label>
          <input type="text" class="form-control" name="name_ar" value="{{$department->name_ar}}" required>
        </div>
        <div class="form-group">
          <label for="name_fr">Name fr </label>
          <input type="text" class="form-control" name="name_fr" value="{{$department->name_fr}}" required>
        </div>
        <div class="form-group">
          <label for="speciality_max_choice">Nombre de choix par specialité </label>
          <input type="text" class="form-control" name="speciality_max_choice" value="{{$department->speciality_max_choice}}" required>
        </div>
        <div class="form-group">
          <label for="code">faculty</label>
          <select name="faculty_id" id="faculty_id" class="form-control">
            <option value="">select</option>
            @foreach ($faculties as  $fac)
              @if ($department->faculty_id== $fac->id)
              <option value="{{$fac->id}}" selected>{{$fac->name_fr}}</option>
              @endif
            <option value="{{$fac->id}}">{{$fac->name_fr}}</option>
            @endforeach
          </select>
        </div>
        <div class="row m-4">
          <button class="btn btn-primary" type="submit">Edit</button>
        </div>
      </form>
    </div>
    <div class="col-3"></div>
  </div>
</div>
</div>
@endsection