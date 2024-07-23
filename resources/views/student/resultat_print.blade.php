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
                  <h5>
                  @if ($student->etat =="Accepté")
                  إستمارة التسجيل في الماستر
                @else
                {{__('translation.form_title')}}
                @endif
              </h5>
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
                 
                 {{---<tr>
                    <td><b>{{__('translation.title_Specialty_requested')}}</b></td>
                  </tr>

                  @if ($specialities != null)
                  @foreach ( $specialities as $sp)
                    
                    <tr>
                        <td>{{__('translation.choix')}} {{ $loop->iteration }}</td>
                        <td>{{$sp->speciality->title}} </td>
                    </tr>
                  @endforeach
                  @endif
                  ---}}

                  <tr>
                    <td>{{__('translation.date_inscription')}}</td>
                    <td>{{$student->created_at}} </td>
                    
                  </tr>
                 
                  
                  @if ($student->faculty->show_result)
                  <tr>
                    <?php
                    $etatList_1 = array(array('id'=>'Accepté','name_ar'=>'مقبول','color'=>'success'), array('id'=>'Refusé','name_ar'=>'مرفوض','color'=>'danger'),array('id'=>'Non traité','name_ar'=>'غير معالج','color'=>'light'));
                        ?>
                                            
                        <td> الرد من المؤسسة:  </td>
                        <td>
                        @foreach ( $etatList_1 as $state)
                        @if ($student->etat == $state['id'])
                        {{$state["name_ar"]}}  
                        @endif
                        @endforeach  
                      </td>
                     
                  </tr>
                  <tr>
                      
                    @if ($student->etat !="Accepté")
                    <td> سبب الرد:  </td> <td> {{ $student->motif }}    </td>
                    @else
                    <td>{{__('Orientation')}}:</td> <td> - 
                      {{$speciality_name[0]['title']}}
                      </td>

                    @endif
                  
                  </tr>
                @endif

                </table> 


                @if ($student->etat =="Accepté")
              <table style="height: 200px"> 
                <thead>
                  <th>إمضاء نائب المدير </th>
                  <th>إمضاء نائب العميد</th>
                </thead>
                <tr><td style="width: 50%"> </td>
                    <td style="width: 50%"> </td>
                </tr>
                <tr><td  style="width: 50%">  <div  style="width: 50%"> </div><td>
                    <td style="width: 50%"> <div  style="width: 50%"> </div></td>
              </tr>
              </table> 
                    <p dir="rtl" style="font-size: 11px">
                      -         على المترشح المقبول القدوم لإمضاء هذه الاستمارة لدا نائب المدير المكلف بالتكوين العالي في الطورين الأول والثاني والتكوين المتواصل والشهادات وكذا التكوين العالي في التدرج- جامعة الجزائر-1 .
<br>
-         يجب على المترشح المقبول التسجيل في الكلية التي قبل فيها خلال فترة لا تتجاوز 07 أيام كاملة بعد ظهور النتائج. بعد هذه المدة، يتم تعويضه بمترشح من قائمة الاحتياط.
                    </p>
                 
                @endif
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