@extends('layouts.master')

@section('content')
<div class="fac-name" >
<h1>{{$faculty->name_ar}} <br/>
{{$faculty->name_fr}}</h1>
</div>
  <div class="dataForm" >
   
    <form method="POST"  action="{{ route('register') }}">
      @csrf
      <h1>{{__('translation.Create an account')}}</h1>
      <h4 class="mb-3">{{__('translation.ask')}}</h4>
      
      <!-- One "tab" for each step in the form: -->
      <div >
        <div class="container">
            <div class="row">
                
                  <div class="col-md-6 ">
                    <label for="name" class="form-label">{{__('translation.name_fr')}}</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"  required=""   name="name" value="{{ old('name') }}"> 
                    
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="col-md-6 ">
                    <label for="lastname" class="form-label">{{__('translation.prenom_fr')}}</label>
                    
                    <input type="text" class="form-control @error('lastname') is-invalid @enderror" id="lastname"  required=""  name="lastname" value="{{ old('lastname') }}">
                    @error('lastname')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="col-md-6">
                    <label for="birthday" class="form-label text-md-end">{{ __('translation.date_nais') }}</label>
      
                    
                        <input id="birthday" type="date" class="form-control @error('birthday') is-invalid @enderror" name="birthday" value="{{ old('birthday') }}" required >
      
                        @error('birthday')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    
                </div>
                  <div class="col-md-6">
                    <label for="email" class="form-label text-md-end">{{ __('translation.email') }}</label>
                    
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"  required="" placeholder="email"  name="email" value="{{ old('email') }}">
                    <div id="emailHelp" class="form-text">{{__('translation.note_emailvalid')}}</div>
                               
                    
                  
                    @error('email')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                  <div class="col-md-6">
                    <label for="password" class="col-md-3 form-label ">{{ __('translation.password') }}</label>
                    <input type="password" class="form-control" id="password"  required=""   name="password">
                    
                     <div id="emailHelp" class="form-text">{{ __('translation.password_requier') }} </div>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                  <div class="col-md-6">
                    <label for="password-confirm" class="form-label text-md-end">{{ __('translation.password-confirm') }}</label>
      
                    <input id="password-confirm" type="password" class="form-control @error('password') is-invalid @enderror" name="password_confirmation" required >
                   
                </div>
                <div class="col g-3">
                  <label for="licence_type" class="col-md-6 col-form-label ">{{ __('translation.licence_type') }}</label>
                   
                  <div class="col-md-9">
                    <input class="form-check-input" type="radio" name="licence_type" id="LMD" value="LMD">
                    <label class="form-check-label" for="LMD"> {{__('translation.lmd')}} </label>
<br>
                    <input  type="radio" value="Classique" id="Classique" class="form-check-input" name="licence_type"   >
                    <label class="form-check-label" for="Classique">{{__('translation.classique')}}</label>
                   <br>
                    <input class="form-check-input" type="radio" name="licence_type" id="ingenieur" value="ingenieur">
                    <label class="form-check-label" for="ingenieur"> {{__('translation.ingenieur')}} </label>

                    {{-- <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" required="true" name="licence_type" id="etrange" value="etrange" disabled>
                      <label class="form-check-label" for="etrange">étrange</label>
                      </div> --}}
                     
                  </div>
              </div>
                  <div class="col-md-6">
                    <input type="hidden" name="faculty_id" id="faculty_id" required="true" value="{{$faculty->id}}"/>
                    
                      <label for="department_id" class="col-md-6 form-label ">{{__('translation.department')}}</label>
                      <select class="form-select" id="department_id" required name="department_id" value="{{ old('department_id') }}">
                          <option > </option>
                          @foreach ($departments as $dep)
                      
                          <option value="{{$dep->id}}" >{{$dep->name_ar}} -{{$dep->name_fr}}</option>
                                  
                      @endforeach
                      </select>
                      @error('department_id')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  
                  {{-- <div class="col-md-6">
                    <label for="license_specialties" class="col-md-6 form-label ">{{__('translation.license_specialties')}}</label>
                    <select class="form-select" id="license_specialties" required name="license_specialties">
                      <option ></option>
                      <option value="0">not defined</option>
                        @foreach ($sp_license as $l)
                    
                        <option value="{{$l['id']}}" >{{$l['title']}} </option>
                                
                    @endforeach
                    </select>
                    @error('license_specialties')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div> --}}
                 
                 
                  
            </div>
        </div>
         <!--- -->
      </div>
      
      
     
     
      <div class="d-grid gap-2 col-6 mx-auto" style="padding-top: 20px;">
          
          <button type="submit" class="btn btn-primary btn-lg" style=" background-color: #6b59d3;"  id="save" >{{__('translation.btn_submit_form')}}</button>
        </div>
     
      
     
    </form>
    </div>
    @endsection