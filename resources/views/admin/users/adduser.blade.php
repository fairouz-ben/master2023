@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Créer un nouveau compte</div>

                <div class="card-body">
                   <form method="POST" action="{{ route('user.store') }}" >
                        @csrf

                        <div class="row mb-3">
                            <label for="lastname" class="col-md-4 col-form-label text-md-end">{{ __('translation.prenom_fr') }}</label>

                            <div class="col-md-6">
                                <input id="lastname" value="" type="text" placeholder="{{ __('translation.prenom_fr') }}"  class="form-control @error('lastname') is-invalid @enderror" name="lastname"  required >

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
                                <input id="name" type="text" value="" placeholder="{{ __('translation.name_fr') }}" class="form-control @error('name') is-invalid @enderror" name="name" required autocomplete="name" autofocus>

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
                                <input id="birthday" type="date" class="form-control @error('birthday') is-invalid @enderror" name="birthday" required>

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
                                <input type="hidden" name="faculty_id" value="{{Auth::guard('admin')->user()->faculty->id}}" required>
                                <select name="department_id" required class="form-select" >
                                @foreach ($departments as $dep )
                                    
                                    <option value="{{$dep->id}}">
                                        {{(App::isLocale('ar') ? $dep->name_ar : $dep->name_fr)}}
                                        </option>  
                                
                                    
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
                                <input id="email" type="email" value="" class="form-control @error('email') is-invalid @enderror" name="email"  required autocomplete="email">
                                
                                <div id="emailHelp" class="form-text">{{__('translation.note_emailvalid')}}</div>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                       
                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('translation.password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" value="master2024@alger"  name="password" required readonly class="form-control @error('password') is-invalid @enderror" >
                                
                                <div id="passwordHelp" class="form-text" style="color: red">{{__('translation.password')}}:  master2024@alger</div>
                                @error('password')
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
    <input type="hidden" id="licence_type_value" value="">

    <input  type="radio" value="Classique" id="Classique" readonly   class="form-check-input" name="licence_type"   >
    <label class="form-check-label" for="Classique">
      {{__('translation.classique')}} 
    </label>
    <br>
    <input class="form-check-input" type="radio" readonly name="licence_type"    id="LMD" value="LMD" >
    <label class="form-check-label" for="LMD">
      {{__('translation.lmd')}} 
    </label>
    <br>
    <input class="form-check-input" type="radio" name="licence_type"   id="ingenieur" value="ingenieur" >
    <label class="form-check-label" for="ingenieur">
      {{__('translation.ingenieur')}} 
    </label>
   
     
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
               
                
            </div>
        </div>
    </div>
</div>
@endsection
