@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h4>{{ __('translation.info_personal') }}</h4></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h5>{{ __('translation.fac') }}: {{(App::isLocale('ar') ? $student->faculty->name_ar  : $student->faculty->name_fr)}}</h5>
                   
                    <h5>  {{ __('translation.student') }}: {{$student->nom_ar}}{{$student->prenom_ar}}  </h5>
                    <p> 
                        {{-- <a href="{{asset($student->file_path)}}"></a> --}}
                      <br/>  <a href="{{ route('show_uploaded_file') }}" target="_blank" > {{ __('translation.note_file_check') }} </a>
                   
                    </p>
                    @include('student.edit_file')
                    <div class="row mt-3">
                        <div class="col-12 text-center">
                            <a href="{{ route('print') }}"  target="_blank" class="btn btn-success btn-sm ml-auto"><i class="fa fa-print"></i> {{ __('translation.print') }}</a>
                        </div>
                    </div>
                    {{-- if resultat: imprimer obligatoirement leur résultat d'acceptation a fin de compléter leur
                    dossier d'inscription. --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
