@extends('layouts.dashboard.template')

@section('content')
<div class="container" style="margin-top: 30px;">
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Add department</h1>
  <div class="btn-toolbar mb-2 mb-md-0">
  </div>
</div>
<div class="container">
  <div class="row">
    <div class="col-3"></div>
    <div class="col-6">
      <form action="{{url('departments/store')}}" method="post">
        @csrf
        <div class="form-group">
          <label for="name">Name ar</label>
          <input type="text" class="form-control" name="name_ar" required>
        </div>
        <div class="form-group">
          <label for="name">Name fr</label>
          <input type="text" class="form-control" name="name_fr" required>
        </div>
        <div class="form-group">
          <label for="name">Faculty</label>
          <select name="faculty_id" id="faculty_id" class="form-control">
            <option value="">select</option>
            @foreach ($faculties as  $fac)
            <option value="{{$fac->id}}">{{$fac->name_fr}}</option>
            @endforeach
          </select>
        </div>
        <div class="row m-4">
          <button class="btn btn-primary">Add</button>
        </div>
      </form>
    </div>
    <div class="col-3"></div>
  </div>
</div>
</div>
@endsection