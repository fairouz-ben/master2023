@extends('layouts.print_app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        
       
        <main>
         
            <div class="card" style="width: 100%;">
            
              <img class="card-img-top" src="{{asset('ban.png')}}" alt="logo" height="100px" width="400px">
             
             <div class="card-body text-center">
                <h5 class="card-title">{{__('translation.title')}}</h5>
                @if(app()->getLocale() == 'ar')
                <h4>  {{$user->faculty->name_ar}}</h4>
                @else
                <h4>  {{$user->faculty->name_fr}}</h4>
                @endif
                <p class="card-text">
                  <h5>{{__('translation.form_title')}}</h5>
                  
                 
                </p>
              </div>
              <div class="card-body">
                <table  class="table "> 
                  <tr>
                    <td>{{__('translation.student')}}</td>
                    <td>{{$student->nom_ar}} {{$student->prenom_ar}}
                    <br/>{{$student->nom_fr}}  {{$student->prenom_fr}}</td>
                  </tr>

                  {{-- <tr>
                    <td>{{__('translation.phone')}}</td>
                    <td>{{$student->phone}}</td>
                    
                  </tr> --}}
                  <tr>
                    <td>{{__('translation.mat_bac')}}</td>
                    <td>{{$student->mat_bac}}</td>
                    <td>{{__('translation.year_bac')}}: {{$student->year_bac}}</td>
                  </tr>
                <tr>    
                    <td>{{__('translation.licence')}}</td>
                    <td>{{$student->licence}}</td>
                    <td>{{__('translation.univ_origine')}}: {{$student->univ_origine}}</td>
                    
                  </tr>

                  <tr>
                    <td>{{__('translation.licence_type')}}</td>
                    <td>{{$user->licence_type}} </td>
                    <td> {{__('translation.department')}}: {{$user->department->name_ar}} </td>
                    
                  </tr>
                  {{-- <tr>
                    <td>{{__('translation.department')}}</td>
                    <td>{{$user->department->name_ar}} </td>
                    
                  </tr> --}}
                  <tr>
                    <td><b>{{__('translation.title_Specialty_requested')}}</b></td>
                  </tr>
{{--                  
                  <tr>
                    <td>{{__('translation.choix1')}}</td>
                    <td>{{$student->special_1}} </td>
                  </tr> --}}

                  @if ($specialities != null)
                  @foreach ( $specialities as $sp)
                    
                    <tr>
                        <td>{{__('translation.choix')}} {{ $loop->iteration }}</td>
                        <td>{{$sp->speciality->title}} </td>
                    </tr>
                  @endforeach
                  @endif
                {{-- @if ($student->special_3 != null)
                  <tr>
                    <td>{{__('translation.choix')}} 3</td>
                    <td>{{$student->special_3}} </td>
                    
                  </tr> 
                  @endif
                  @if ($student->special_4 != null)
                  <tr>
                    <td>{{__('translation.choix')}} 4</td>
                    <td>{{$student->special_4}} </td>
                    
                  </tr> 
                  @endif   --}} 

                  <tr>
                    <td>{{__('translation.date_inscription')}}</td>
                    <td>{{$student->created_at}} </td>
                    
                  </tr>
                  <tr>
                    <td>{{__('translation.Resultat')}}</td>
                    <td>{{$student->etat}} </td>
                    
                  </tr>

                </table> 
              </div>
              
              
            </div>
       </main>
        
    </div>
</div>
@endsection
@section('script')
    <script>
        window.print();
    </script>
@endsection