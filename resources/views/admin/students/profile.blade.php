@extends('layouts.dashboard.template_2')

@section('content')
<div class="card">
    <div class="card-header">{{ $title ?? "" }} Formulaire</div>

    <div class="card-body">

<form class="dataForm" id="regForm"   method="POST" action="{{ route('student.update',$student->id) }}" enctype="multipart/form-data">
    @csrf
  <div class="tab"><h3>{{__('translation.info_personal')}}</h3>
	<div class="container">
		<div class="row">
			<div class="col-md-6 ">
				<label for="nom_ar" class="form-label">اللقب</label>
                <input type="text" class="form-control" id="nom_ar" value="{{$student->nom_ar}}"  required placeholder="اللقب..."  name="nom_ar">
				<div class="valid-feedback">
				  Looks good!
				</div>
			 </div>
			<div class="col-md-6 ">
				<label for="prenom_ar" class="form-label">الاسم</label>
                 <input type="text" class="form-control" id="prenom_ar" value="{{$student->prenom_ar}}" required placeholder="الاسم..."  name="prenom_ar">
				<div class="valid-feedback">
				  Looks good!
				</div>
			</div>
			  <div class="col-md-6 ">
				<label for="nom_fr" class="form-label">Nom(fr)</label>
				<input type="text" class="form-control" id="nom_fr" value="{{$student->user->name}}" required  readonly name="nom_fr">
				
				<div class="valid-feedback">
				  Looks good!
				</div>
			  </div>
			  <div class="col-md-6 ">
				<label for="prenom_fr" class="form-label">Prenom(fr)</label>
				
				<input type="text" class="form-control" id="prenom_fr" value="{{$student->user->lastname}}" required readonly name="prenom_fr">
				<div class="valid-feedback">
				  Looks good!
				</div>
			  </div>
			  <div class="col-md-6">
				<label for="date_nais" class="form-label text-md-end">{{__('translation.date_nais')}}</label>
				
				<input type="date" class="form-control  @error('date_nais') is-invalid @enderror" id="date_nais" value="{{$student->user->birthday}}"  required readonly name="date_nais">
				
        @error('date_nais')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
			  </div>
			  <div class="col-md-6">
				<label for="phone" class="col-md-3 form-label ">{{ __('translation.phone') }}</label>
				<input type="numeric" class="form-control" id="phone" value="{{$student->phone}}"  required=""  oninput="this.className = ''" name="phone">
				<div class="valid-feedback">
				  Looks good!
				</div>
			  </div>
			  <div class="col-md-3">
              <label for="mat_bac" class="form-label text-md-end">{{ __('translation.mat_bac') }}</label>

                  <input id="mat_bac" type="text" max="12" class="form-control " name="mat_bac" value="{{$student->mat_bac}}" required="">

                              
          </div>
		  <div class="col-sm-3">
              <label for="year_bac" class="form-label text-md-end">{{ __('translation.year_bac') }}</label>

                  <input id="year_bac" type="number" max="2022" class="form-control " name="year_bac" required="" value="{{$student->year_bac}}" >

                                
          </div>
		  {{-- <div class="col-sm-3">
            <label for="note_bac" class="form-label text-md-end"> {{ __('translation.note_bac') }}</label>

                <input id="note_bac" type="numeric" max="19" class="form-control " name="note_bac" required="" value="" >

                            
        </div> --}}
		<div class="col-sm-3">
            <label for="city_bac" class="form-label text-md-end">{{ __('translation.city_bac') }}</label>

              <select name="city_bac" id="city_bac"  required="" value="{{$student->city_bac}}" class="form-select" >
                <option  ></option>
                  @foreach ($cities as $city)
                      @if ($student->city_bac == $city->id)
                      <option value="{{$city->id}}" selected>{{$city->name_fr}}</option>  
                      @else

                      <option value="{{$city->id}}">{{$city->name_fr}}</option>
                      @endif
                  @endforeach
              </select>
                @error('city_bac')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                                
          </div>
		</div>
	</div>
	 <!--- -->
  </div>
  <div class="tab">
<h2>{{__('translation.info_licence')}}:</h2>
<div class="row g-12 p-3">
  <label for="licence_type" class="col-md-3 col-form-label ">{{ __('translation.licence_type') }}</label>
   
  <div class="col-md-9">
    <input type="hidden" id="licence_type_value" value="{{$student->licence_type}}">
    @if ($student->licence_type =='LMD')
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
    @elseif (($student->licence_type =='Classique'))
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
      @elseif ((($student->licence_type =='ingenieur')))
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
  <div class="row g-3">
          
          <div class="col-md-4">
              <label for="licence" class="form-label text-md-end"> {{ __('translation.licence') }}</label>

              
                  <input id="licence" type="text" class="form-control " name="licence" required="" value="{{$student->licence}}" >

                            </div>
          {{-- <div class="col-md-4">
            <label for="year_last_dip" class="form-label text-md-end">{{ __('translation.year_last_dip') }}</label>

            <input id="year_last_dip" type="number"  value="{{$student->year_last_dip}}"  class="form-control " name="year_last_dip" required="">

                        </div> --}}
        <div class="col-md-4">
            <label for="univ_origine" class="form-label text-md-end">{{ __('translation.univ_origine') }}</label>

            
               <select name="univ_origine" id="univ_origine"  class="form-select" required="">
                    <option >{{$student->univ_origine}}</option>
                    <option >جامعة الجزائر 1</option>
                    <option >Externe-خارجي</option>
                </select>
                        </div>
    </div>
  
  <div class="row g-3">
  <div class="col-sm-4">
              <label for="S1" class="col-md-8 col-form-label ">{{ __('translation.S1') }}</label>

              <div class="col-md-4">
                  <input id="S1" type="numeric" class="form-control " name="S1" max="20" value="{{$student->S1}}" required="">

              </div>
          </div>
		  <div class="col-sm-4">
              <label for="S2" class="col-md-8 col-form-label ">{{ __('translation.S2') }}</label>

              <div class="col-md-4">
                  <input id="S2" type="number" class="form-control " name="S2" value="{{$student->S2}}" max="20" required="">

              </div>
          </div>
		  <div class="col-sm-4">
              <label for="S3" class="col-md-8 col-form-label ">{{ __('translation.S3') }}</label>

              <div class="col-md-4">
                  <input id="S3" type="numeric" class="form-control " name="S3" value="{{$student->S3}}" required="">

              </div>
          </div>
		  <div class="col-sm-4">
              <label for="S4" class="col-md-8 col-form-label ">{{ __('translation.S4') }}</label>

              <div class="col-md-4">
                  <input id="S4" type="numeric" class="form-control " name="S4" value="{{$student->S4}}" required="">

              </div>
          </div>
		  <div class="col-sm-4">
              <label for="S5" class="col-md-8 col-form-label ">{{ __('translation.S5') }}</label>

              <div class="col-md-4">
                  <input id="S5" type="numeric" class="form-control " name="S5" id="S5" value="{{$student->S5}}">

              </div>
          </div>
		  <div class="col-sm-4">
              <label for="S6" class="col-md-6 col-form-label ">{{ __('translation.S6') }}</label>

              <div class="col-md-4">
                  <input id="S6" type="numeric" class="form-control " name="S6"  id="S6" value="{{$student->S6}}">

              </div>
          </div>
		  <div class="col-sm-4">
              <label for="nb_dette" class="col-md-6 col-form-label ">{{ __('translation.Dette') }}</label>

              <div class="col-md-4">
                  <input id="nb_dette" type="number" min="0" class="form-control " name="nb_dette" value="{{$student->nb_dette}}">

              </div>
          </div>
		  <div class="col-sm-4">
              <label for="nb_rattrapage" class="col-md-6 col-form-label ">{{ __('translation.Rattrapage') }}</label>

              <div class="col-md-4">
                  <input id="nb_rattrapage" type="number" min="0" class="form-control " name="nb_rattrapage" required="" value="{{$student->nb_rattrapage}}">

              </div>
          </div>
		  <div class="col-sm-4">
              <label for="annee_doublon" class="col-md-6 col-form-label ">{{ __('translation.annee_doublon') }}</label>

              <div class="col-md-4">
                  <input id="annee_doublon" type="number" min="0" class="form-control " name="annee_doublon" required="" value="{{$student->annee_doublon}}">

              </div>
          </div>

          <div class="col-sm-4">
            <label for="moyenne_classement" class="col-md-6 col-form-label ">{{ __('Moyenne de classement') }}</label>

            <div class="col-md-4">
                <input type="number" min="0" class="form-control " readonly name="moyenne_classement"  value="{{$student->moy_classement ?? 0}}">

            </div>
        </div>
  </div>
</div>
  <div class="tab"><h2>{{ __('translation.master_inscription') }} </h2>
	
	
	<div class="form-group row p-2">
            <label for="departments" class="col-md-3 col-form-label text-left"><h5> {{__('translation.department')}}<span style="color:red;"> *</span></h5></label>
            <div class="col-md-9">
                <select name="department_id" id="department_id" class="form-select" required="true" >	  
                  <option value="{{$student->department_id }}" selected data-speciality_max_choice="{{$student->department->speciality_max_choice}}">{{$student->department->name_fr}}</option>
                      
                @foreach ($departments as $dep)
                    
                @if ($dep->is_active)
                  @if ($student->department_id == $dep->id)
                  <option value="{{$dep->id}}"  data-speciality_max_choice="{{$dep->speciality_max_choice}}">{{$dep->name_fr}} - {{$dep->name_ar}}</option>
                  
                  @else
                  <option value="{{$dep->id}}" data-speciality_max_choice="{{$dep->speciality_max_choice}}">{{$dep->name_fr}} - {{$dep->name_ar}}</option>
                  
                  @endif
               
                @endif    

            @endforeach      
                  </select>
          </div>  
          
          </div>
          <h5>{{__('translation.title_Specialty_requested')}}</h5>
          {{-- @if ($SpecialityStudent != null)
          @foreach ( $SpecialityStudent as $sp)
            
            <div class="form-group row p-2">
          
              <label for="departments" class="col-sm-4 col-form-label text-left" > <b>{{__("translation.choix")}}{{ $loop->iteration }}<span style="color:red;"> *</span></b></label>
                <div class="col-sm-8">
            
                <i > {{$sp->speciality->title}} </i>
                
               </div> 
            </div>
          @endforeach
          @endif --}}
         
          <div id="sp">

            
              @if ($SpecialityStudent != null)
              @foreach ( $SpecialityStudent as $sp)
                
                <div class="form-group row p-2">
              
                  <label for="departments" class="col-sm-4 col-form-label text-left" > <b>{{__("translation.choix")}}{{ $loop->iteration }}<span style="color:red;"> *</span></b></label>
                    <div class="col-sm-8">
                  <select name="special_{{$loop->iteration}}" id="special_{{$loop->iteration}}"  required="true"  class="form-select" >
          
                    <option class="form-control"  value="{{$sp->speciality->id}}"> {{$sp->speciality->title}} </option>
                    
                  
                  </select> </div> 
                </div>
              @endforeach
              @endif
            
          
          </div>
          <hr class="my-4">  
          <label for="recours"></label>
        
          <div class="row">
            <div class="col-md-6 ">

              <label for="recours" class="form-label">الطعن</label>
                      
                      <textarea name="recours" id="" cols="30" rows="5"  readonly class="form-control">
                        {{$student->recours}}
                      </textarea>
             </div>
            <div class="col-md-6 ">
              <label for="recours_reponse" class="form-label">الرد على الطعن</label>
                      
              <textarea name="recours_reponse" id="" cols="30" rows="5" {{ Auth::user()->role_id == 3 ? 'readonly' : ''}}  class="form-control">{{$student->recours_reponse}}
              </textarea>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 p-3 ">
             
            
              <h3>الوضعية: 
              @if ($student->etat == 'Accepté' )  <span class="badge bg-success">   {{$student->etat}}</span>
              @elseif ($student->etat == 'Refusé' )
              <span class="badge bg-danger">   {{$student->etat}}</span>
              @else <span class="badge bg-secondary">   {{$student->etat}}</span>
              @endif
            </h3>
             
            </div>
            

          </div>
          {{-- <p><input oninput="this.className = ''" name="fin"></p> --}}
  </div>
  <hr class="my-4"> 
  <div class="d-grid gap-2 col-4 mx-auto">

    <button type="submit" class="btn btn-primary">
      {{ __('translation.save') }}
  </button>
  </div>
 
</form>


<div class="form-group  p-2">
      
    <label for="file" class="col-md-3 col-form-label ">{{ __('translation.file') }}</label>
    <p><a href="{{route('admin.show_uploaded_file',['id'=>$student->id])}}">Lisez le fichier téléchargé :</a></p>

    <div class="col-md-9">
     
       
        <p id="errorMessage" style="color: red;"></p>
    </div>
    @include('student.edit_file')
</div>
<div class="col-12 text-center">
  <a href="{{ route('resultat_print_admin',['id'=>$student->id]) }}"  target="_blank" class="btn btn-success btn-sm ml-auto"><i class="fa fa-print"></i> {{ __('translation.print') }}</a>
</div>
<div class="col align-self-end text-end p-5">
  @if (Auth::guard('admin')->user()->role_id =='1')
<form method="POST" action="{{ route('student.delete', $student->id) }}"  onsubmit="return confirm('Are you sure you want to submit this form?');">
  @csrf
  @method('DELETE')
  <button type="submit" class="btn btn-danger"> Suppression définitive ! </button>
</form>
@endif
</div>

</div>
</div>

<script type="text/javascript">
  $(document).ready(function()
 { 
 //it is in   'asset/js/scripts-multi-step-form.js'
 $('select#department_id').change(function() 
     {	
        //$(this).find(":selected").data("speciality_max_choice"); //works good
         var max_choice= $('#department_id option:selected').attr('data-speciality_max_choice');
         var licence_type =$('#licence_type_value').val();
        $.ajax({
             type: "get",
             data: {"department": this.value,"level":licence_type, "_token": "{{ csrf_token() }}" },
             url: "{{url('get_specialities')}}", 
             success: function(response){
                 
                     ///alert( (Math.min(3, response.length)));
                     var nb_choix = Math.min(max_choice, response.length);
                     html = "";
                     for($i=1;$i<=nb_choix;$i++){ 
                             
                         html += ' <div class="form-group row p-2">';
                         
                         html +=  '<label for="departments" class="col-sm-4 col-form-label text-left" > <b>{{__("translation.choix")}}'+$i+'<span style="color:red;"> *</span></b></label>';
                         html +=' <div class="col-sm-8">';
                         html +='<select name="special_'+$i+'" id="special_'+$i+'"  required="true"  class="form-select" >'  ;
                         html +='<option disabled="true"  selected required="true"></option>';
                     
                         $.each(response, function( index, value ) {

                             html += '<option class="form-control"  value="'+ value.id +'"> - '+ value.title+'</option>';
                         
                         });
                         html += '</select> </div>  </div>';
                     }  
                     
                     $('#sp').empty('').append(html);
             
             }    
     });
     });  	

   });  

</script>
@endsection
