@extends('layouts.dashboard.template')

@section('content')
<div class="container" style="margin-top: 30px;">
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Edit Faculty</h1>
  <div class="btn-toolbar mb-2 mb-md-0">
  </div>
</div>
<div class="container">
  <div class="row">
    <div class="col-3"></div>
    <div class="col-6">
      <form action="{{url('faculties/update/'.$Faculty->id)}}" method="post">
        @csrf
        <div class="form-group">
          <label for="name_ar">Name ar</label>
          <input type="text" class="form-control" name="name_ar" value="{{$Faculty->name_ar}}" required>
        </div>
        <div class="form-group">
          <label for="name_fr">Name fr </label>
          <input type="text" class="form-control" name="name_fr" value="{{$Faculty->name_fr}}" required>
        </div>
        <div class="form-group">
          <label for="code">Code</label>
          <input type="text" class="form-control" name="code" value="{{$Faculty->code}}" required>
        </div>
        <div class="form-group">
          <label for="speciality_max_choice">speciality_max_choice</label>
          <input type="number" class="form-control" name="speciality_max_choice" value="{{$Faculty->speciality_max_choice}}" >
        </div>
      
        <div class="form-group">
            <div class="form-check form-switch">
              <input class="form-check-input" type="checkbox" name="show_result"  {{$Faculty->show_result ? 'checked' : '' }} > 
              <label class="form-check-label" for="show_result">show_result</label>
            </div>
        </div>

        <div class="form-group">
          <label for="inscription_close_date">inscription_close_date</label>
          <input type="date" class="form-control" name="inscription_close_date" value="{{$Faculty->inscription_close_date}}" >
        </div>
        <div class="form-group">
          <label for="update_close_date">update_close_date</label>
          <input type="date" class="form-control" name="update_close_date" value="{{$Faculty->update_close_date}}" >
        </div>
        <div class="form-group">
          <label for="treatment_close_date">treatment_close_date</label>
          <input type="date" class="form-control" name="treatment_close_date" value="{{$Faculty->treatment_close_date}}" >
        </div>

        <div class="form-group">
          <label for="recoure_close_date">recoure_close_date</label>
          <input type="date" class="form-control" name="recoure_close_date" value="{{$Faculty->recoure_close_date}}" >
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