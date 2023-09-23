@extends('layouts.dashboard.template')

@section('content')
<div class="container" style="margin-top: 30px;">
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Edit  Speciality</h1>
  <div class="btn-toolbar mb-2 mb-md-0">
  </div>
</div>
<div class="container">
  <div class="row">
    <div class="col-3"></div>
    <div class="col-6">
      <form action="{{ route('speciality.update',['speciality'=>$speciality->id]) }}" method="post">{{-- need to use route to easy insert parameter department_id--}}
        @csrf
        <input type="hidden" class="form-control" name="department_id" value="{{$speciality->department_id}}" required>
       
        <div class="form-group">
          <label for="title">titre ar</label>
          <input type="text" class="form-control" name="title"  value="{{$speciality->title}}" required>
        </div>
        <div class="form-group">
          <label for="title_fr">titre fr</label>
          <input type="text" class="form-control" name="title_fr" value="{{$speciality->title_fr}}" required>
        </div>
        <div class="form-group">
          <label for="number_available">Nombre disponible</label>
          <input type="numeric" class="form-control" name="number_available" value="{{$speciality->number_available}}">
        </div>
        <div class="form-group">
          <label for="name">Department</label>
          <select name="department_id" id="department_id" class="form-control">
            
            <option value="{{$speciality->department_id}}">{{$speciality->department->name_fr}}</option>
          
          </select>
        </div>
        <div class="form-group">
          <label for="name">Level  </label>: 
          {{$speciality->level}}
          <select name="level" id="level" class="form-control">
            
            <option value="all">for all</option>
            <option value="m1">Master 1 </option>
            <option value="m2">master 2</option>
          
          </select>
        </div>
        <div class="row m-4">
          <button class="btn btn-primary">ُEdit</button>
        </div>
      </form>
    </div>
    <div class="col-3"></div>
  </div>
</div>
</div>
@endsection