@extends('layouts.app')


@section('content')
<div class="card">
    <div class="card-header">
        <h3>{{__('translation.edit_info')}}</h3>
      </div>
    <div class="card-body" >

    <form class="dataForm" id="regForm" method="POST" action="{{ route('update',['student'=>$student]) }}" enctype="multipart/form-data">
        @csrf
        {{-- <small class="text-muted"> أي تصريح كاذب من قبل الطالب يشكل جريمة يعاقب عليها القانون. <br>
            Toute fausse déclaration par l'étudiant constitue une infraction punissable par la loi.<br></small>   --}}
            
            <div class="container">
                <div class="row">
                    <h4>{{__('translation.info_personal')}}</h4>
                    <div class="col-md-6 ">
                        <label for="Nom_ar" class="form-label">اللقب</label>
                        <input type="text" class="form-control" value="{{ $student->nom_ar}}" required="" placeholder="اللقب..."
                            name="nom_ar">
                        @error('nom_ar')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-6 ">
                        <label for="Prenom_ar" class="form-label">الاسم</label>
                        <input type="text" class="form-control" value="{{ $student->prenom_ar }}"  required="" placeholder="الاسم..."
                            name="prenom_ar">
                            @error('prenom_ar')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-6 ">
                        <label for="nom_fr" class="form-label">Nom(fr)</label>
                        <input type="text" class="form-control" id="nom_fr" value="{{ $student->nom_fr }}"
                             name="nom_fr">

                        @error('nom_fr')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-6 ">
                        <label for="prenom_fr" class="form-label">Prenom(fr)</label>

                        <input type="text" class="form-control" value="{{ $student->prenom_fr }}"
                            required="" name="prenom_fr">
                            @error('prenom_fr')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="date_nais" class="form-label text-md-end">{{ __('translation.date_nais') }}</label>
                        <input type="date" name="date_nais" class="form-control @error('date_nais') is-invalid @enderror"  value="{{$student->date_nais }}" required >

                            @error('date_nais')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="phone" class="col-md-3 form-label ">{{ __('translation.phone') }}</label>
                        <input type="numeric" class="form-control" id="phone" required="true"  name="phone" value="{{$student->phone }}" >
                        @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="mat_bac" class="form-label text-md-end">{{ __('translation.mat_bac') }}</label>

                        <input id="mat_bac" type="text" max="12" class="form-control " name="mat_bac"  required="true" value="{{$student->mat_bac }}" >
                        @error('mat_bac')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                    </div>
                    <div class="col-md-3">
                        <label for="year_bac" class="form-label text-md-end">{{ __('translation.year_bac') }}</label>

                        <input id="year_bac" type="number" max="2023" class="form-control " name="year_bac"
                            required=""  value="{{$student->year_bac}}" >
                            @error('year_bac')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                    </div>
                    {{-- <div class="col-md-3">
                        <label for="Moy_BAC" class="form-label text-md-end"> {{ __('translation.note_bac') }}</label>

                        <input id="Moy_BAC" type="numeric" max="19" class="form-control " name="Moy_BAC"
                            required="" value="{{ $student->Moy_BAC }}">
                            @error('Moy_BAC')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                    </div> --}}
                 
                    <div class="col-md-3">
                        <label for="city_bac" class="form-label text-md-end">{{ __('translation.city_bac') }}</label>

                        <select name="city_bac" id="city_bac" class="form-select" required
                            class="form-control @error('city_bac') is-invalid @enderror">
                            
                            @foreach ($cities as $city)
                                @if ( $student->city_bac == $city->id)
                                    <option value="{{ $city->id }}" selected>{{(App::isLocale('ar') ? $city->name_ar : $city->name_fr ) }}</option>
                                @else
                                    <option value="{{ $city->id }}">{{(App::isLocale('ar') ? $city->name_ar : $city->name_fr ) }}</option>
                                @endif
                            @endforeach 
                        </select>
                        @error('city_bac')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>
                    <div class="row g-12 p-3">
                        <label for="licence_type" class="col-md-3 col-form-label ">{{ __('translation.licence_type') }}</label>
                         
                        <div class="col-md-9">
                          <input type="hidden" id="licence_type_value" value="{{Auth::user()->licence_type}}">
                          @if (Auth::user()->licence_type =='LMD')
                          <input  type="radio" value="Classique" id="Classique" readonly @selected(false) disabled class="form-check-input" name="licence_type"   >
                          <label class="form-check-label" for="Classique">
                            {{__('translation.classique')}} 
                          </label>
                          <input class="form-check-input" type="radio" readonly name="licence_type"   checked id="LMD" value="LMD"  onclick="afficherCacher()">
                          <label class="form-check-label" for="LMD">
                            {{__('translation.lmd')}} 
                          </label>
                          <input class="form-check-input" type="radio" name="licence_type" @selected(false) disabled id="ingenieur" value="ingenieur"  onclick="afficherCacher()">
                          <label class="form-check-label" for="ingenieur">
                            {{__('translation.ingenieur')}} 
                          </label>
                          @elseif ((Auth::user()->licence_type =='Classique'))
                            <input  type="radio" value="Classique" id="Classique"  checked class="form-check-input" name="licence_type"   >
                            <label class="form-check-label" for="Classique">
                              {{__('translation.classique')}}  
                            </label>
                            <input class="form-check-input" type="radio" name="licence_type" @selected(false) disabled id="LMD" value="LMD"  onclick="afficherCacher()">
                            <label class="form-check-label" for="LMD">
                              {{__('translation.lmd')}}
                            </label>
                            <input class="form-check-input" type="radio" name="licence_type" @selected(false) disabled id="ingenieur" value="ingenieur"  onclick="afficherCacher()">
                            <label class="form-check-label" for="ingenieur">
                              {{__('translation.ingenieur')}} 
                            </label>
                            @elseif (((Auth::user()->licence_type =='ingenieur')))
                            <input  type="radio" value="Classique" id="Classique" disabled  class="form-check-input" name="licence_type"   >
                            <label class="form-check-label" for="Classique">
                              {{__('translation.classique')}}  
                            </label>
                            <input class="form-check-input" type="radio" name="licence_type" @selected(false) disabled id="LMD" value="LMD"  onclick="afficherCacher()">
                            <label class="form-check-label" for="LMD">
                              {{__('translation.lmd')}}
                            </label>
                            <input class="form-check-input" type="radio" name="licence_type" @selected(false) checked id="ingenieur" value="ingenieur"  onclick="afficherCacher()">
                            <label class="form-check-label" for="ingenieur">
                              {{__('translation.ingenieur')}} 
                            </label>
                           
                            @endif
                        </div>
                    </div>
                  
                        <div class="row col-12">
                            <div class="col-md-8">
                                <label for="Fil_dem" class="col-sm-4 col-form-label"><b> {{ __('translation.Filière_demandé') }}</b></label>
                                {{-- <span style="color:red;"> *</span> --}}
                                
                                <select name="Fil_dem" id="Fil_dem" class="form-select">
                                    @foreach ($faculties as $fac)
                                    <optgroup label="{{App::isLocale('ar')? $fac->name_ar: $fac->name_fr}}">
                                        @foreach ($fac->departments as $dep)
                                            @if ($student->Fil_dem == $dep->id)
                                            <option selected value="{{$dep->id}}">{{App::isLocale('ar')? $dep->name_ar : $dep->name_fr}}</option>
                                            @else
                                            <option value="{{$dep->id}}">{{App::isLocale('ar')? $dep->name_ar : $dep->name_fr}}</option>
                                        
                                            @endif
                                        @endforeach
                                        
                                    @endforeach	  
                                   
                                        
                                    </select>
                               
                            </div>
                           
                        
                        </div>
                        <div class="row">
                        <p> 
                         
                          <br/>  <a href="{{ route('show_uploaded_file') }}" target="_blank" > {{ __('translation.note_file_check') }} </a>
                       
                        </p>
                        </div>
                        
            
                
                    
                    <div class="d-grid gap-2 col-6 mx-auto" style="padding-top: 20px;">
                    
                    <button type="submit" class="btn btn-primary btn-lg" style=" background-color: #6b59d3;"  id="save" >{{__('translation.save')}}</button>
                    </div>



                </div><!--end row-->
            </div><!--container--->
            
       
    </form>
    @include('student.edit_file')
</div> <!---card-body--->
</div><!---card--->
@endsection

