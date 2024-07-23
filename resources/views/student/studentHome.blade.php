@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4>{{ __('translation.card_info') }}</h4>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <h5>{{ __('translation.fac') }}:
                            {{ App::isLocale('ar') ? $student->faculty->name_ar : $student->faculty->name_fr }}</h5>

                        <h5> {{ __('translation.student') }}: {{ $student->nom_ar }} {{ $student->prenom_ar }} </h5>

                        @if ($student->faculty->update_is_valid)
                            <a href="{{ route('studentEditProfile', $student->id) }}" class="btn btn-info p-3">
                                {{ __('translation.edit_info') }}</a>
                        @endif
                        <p>

                            <br /> <a href="{{ route('show_uploaded_file') }}" target="_blank">
                                {{ __('translation.note_file_check') }} </a>

                        </p>

                        <!----------------->
                        <br>
                        @if ($student->faculty->show_result)
                            <?php
                            $etatList_1 = [['id' => 'Accepté', 'name_ar' => 'مقبول', 'color' => 'success'], ['id' => 'Refusé', 'name_ar' => 'مرفوض', 'color' => 'danger'], ['id' => 'Non traité', 'name_ar' => 'غير معالج', 'color' => 'light']];
                            ?>

                            <p> الوضعية:
                                @foreach ($etatList_1 as $state)
                                    @if ($student->etat == $state['id'])
                                        <span class="alert alert-{{ $state['color'] }} ">{{ $state['name_ar'] }} </span>
                                    @endif
                                @endforeach

                            </p>
                            @if ($student->etat != 'Accepté')
                                <p>السبب: {{ $student->motif }}</p>

                                @include('student.recours')
                            @else
                                <td>{{ __('Orientation') }}:</td>
                                <td> -
                                    {{ $speciality_name[0]['title'] }}
                                </td>
                            @endif

                            <div class="row mt-3">

                                <div class="col-12 text-center p-3">
                                    <a href="{{ route('resultat_print') }}" target="_blank"
                                        class="btn btn-success btn-sm ml-auto"><i class="fa fa-print"></i>
                                        {{ __('translation.print') }} resultat</a>
                                </div>
                            </div>
                        @else
                            <!------------------->

                            {{-- @include('student.edit_file') --}}
                            <div class="row mt-3">
                                <div class="col-12 text-center">
                                    <a href="{{ route('print') }}" target="_blank"
                                        class="btn btn-success btn-sm ml-auto"><i class="fa fa-print"></i>
                                        {{ __('translation.print') }}</a>
                                </div>

                                {{-- <div class="col-12 text-center p-3">
                            <a href="{{ route('resultat_print') }}"  target="_blank" class="btn btn-success btn-sm ml-auto"><i class="fa fa-print"></i> {{ __('translation.print')  }} resultat</a>
                        </div> --}}
                            </div>
                        @endif
                        {{-- if resultat: imprimer obligatoirement leur résultat d'acceptation a fin de compléter leur
                    dossier d'inscription. --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
