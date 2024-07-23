@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">informations de compte</div>

                <div class="card-body">
                    <a href="{{route('select.student',['user'=>$user->id])}}"><h5>  Aller à l'inscription </h5> </a>
                    <form method="POST" action="{{ route('user.update',['user'=>$user->id]) }}" >
                        @csrf

                        <div class="row mb-3">
                            <label for="lastname" class="col-md-4 col-form-label text-md-end">{{ __('translation.prenom_fr') }}</label>

                            <div class="col-md-6">
                                <input id="lastname" value="{{$user->lastname}}" type="text" placeholder="{{ __('translation.prenom_fr_') }}"  class="form-control @error('lastname') is-invalid @enderror" name="lastname"  required >

                                @error('lastname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('translation.name_fr') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" value="{{$user->name}}" placeholder="{{ __('translation.name_fr_') }}" class="form-control @error('name') is-invalid @enderror" name="name" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="birthday" class="col-md-4 col-form-label text-md-end">{{ __('translation.date_nais') }}</label>

                            <div class="col-md-6">
                                <input id="birthday" type="date" class="form-control @error('birthday') is-invalid @enderror" name="birthday" value="{{ $user->birthday}}" required autocomplete="birthday" autofocus>

                                @error('birthday')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="department_id" class="col-md-4 col-form-label text-md-end">{{ __('translation.department') }}</label>

                            <div class="col-md-6">
                                <select name="department_id" required class="form-select" >
                                @foreach ($departments as $dep )
                                    @if ($user->department_id === $dep->id)
                                    <option value="{{$dep->id}}" selected>
                                        {{(App::isLocale('ar') ? $dep->name_ar : $dep->name_fr)}}
                                        </option>  
                                    @else
                                    <option value="{{$dep->id}}">
                                        {{(App::isLocale('ar') ? $dep->name_ar : $dep->name_fr)}}
                                        </option>  
                                    @endif
                                
                                    
                                @endforeach
                                </select>
                                @error('department_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('translation.email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" value="{{ $user->email}}" class="form-control @error('email') is-invalid @enderror" name="email"  required autocomplete="email">
                                
                                <div id="emailHelp" class="form-text">{{__('translation.note_emailvalid')}}</div>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
<!------------------------------------->
<div class="row mb-3">
  <label for="licence_type" class="col-md-4 col-form-label  text-md-end ">{{ __('translation.licence_type') }}</label>
   
  <div class="col-md-6">
    <input type="hidden" id="licence_type_value" value="{{$user->licence_type}}">
    @if ($user->licence_type =='LMD')
    <input  type="radio" value="Classique" id="Classique" readonly @selected(false)  class="form-check-input" name="licence_type"   >
    <label class="form-check-label" for="Classique">
      {{__('translation.classique')}} 
    </label>
    <br>
    <input class="form-check-input" type="radio" readonly name="licence_type"   checked id="LMD" value="LMD"  onclick="afficherCacher()">
    <label class="form-check-label" for="LMD">
      {{__('translation.lmd')}} 
    </label>
    <br>
    <input class="form-check-input" type="radio" name="licence_type" @selected(false)  id="ingenieur" value="ingenieur"  onclick="afficherCacher()">
    <label class="form-check-label" for="ingenieur">
      {{__('translation.ingenieur')}} 
    </label>
    @elseif (($user->licence_type =='Classique'))
      <input  type="radio" value="Classique" id="Classique"  checked class="form-check-input" name="licence_type"   >
      <label class="form-check-label" for="Classique">
        {{__('translation.classique')}}  
      </label>
      <br>
      <input class="form-check-input" type="radio" name="licence_type" @selected(false)  id="LMD" value="LMD"  onclick="afficherCacher()">
      <label class="form-check-label" for="LMD">
        {{__('translation.lmd')}}
      </label>
      <br>
      <input class="form-check-input" type="radio" name="licence_type" @selected(false)  id="ingenieur" value="ingenieur"  onclick="afficherCacher()">
      <label class="form-check-label" for="ingenieur">
        {{__('translation.ingenieur')}} 
      </label>
      @elseif ((($user->licence_type =='ingenieur')))
      <input  type="radio" value="Classique" id="Classique"   class="form-check-input" name="licence_type"   >
      <label class="form-check-label" for="Classique">
        {{__('translation.classique')}}  
      </label>
      <br>
      <input class="form-check-input" type="radio" name="licence_type" @selected(false)  id="LMD" value="LMD"  onclick="afficherCacher()">
      <label class="form-check-label" for="LMD">
        {{__('translation.lmd')}}
      </label>
      <br>
      <input class="form-check-input" type="radio" name="licence_type" @selected(false) checked id="ingenieur" value="ingenieur"  onclick="afficherCacher()">
      <label class="form-check-label" for="ingenieur">
        {{__('translation.ingenieur')}} 
      </label>
     
      @endif
  </div>
</div>

<!------------------------------------------>
                        
  

                        <div class="d-grid gap-2 col-4 mx-auto">
                           
                                <button type="submit" class="btn btn-primary">
                                    {{ __('translation.save') }}
                                </button>
                           
                        </div>
                    </form>
                </div>
                <div class="col align-self-end p-5">
                  @if(Auth::guard('admin')->user()->role_id =='1')
                <form method="POST" action="{{ route('users.delete', $user->id) }}" onsubmit="return confirm('Are you sure you want to submit this form?');" >
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Suppression définitive !</button>
                </form>
                @endif
                  </div>
                
            </div>
        </div>
    </div>
</div>
@endsection
