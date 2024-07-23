@extends('layouts.master')

@section('content')

  <h4 class="mb-3">{{__('translation.ask')}}</h4>

<form class="dataForm" id="regForm"   method="POST" action="{{ $formRoute ? route($formRoute,['user'=>$user->id]) : route('student.store') }}" enctype="multipart/form-data">
    @csrf
    <h1>{{__('translation.Register')}}</h1>

    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
    <div class="alert alert-warning" role="alert">
    
      أي تصريح كاذب من قبل الطالب يشكل جريمة يعاقب عليها القانون. <br>
      Toute fausse déclaration par l'étudiant constitue une infraction punissable par la loi.<br>
    </div>
  <!-- One "tab" for each step in the form: -->
  <div class="tab"><h3>{{__('translation.info_personal')}}</h3>
	<div class="container">
		<div class="row">
			<div class="col-md-6 ">
				<label for="nom_ar" class="form-label">اللقب</label>
                 <input type="text" class="form-control" id="nom_ar"  required="" placeholder="اللقب..." oninput="this.className = ''" name="nom_ar">
				<div class="valid-feedback">
				  Looks good!
				</div>
			 </div>
			<div class="col-md-6 ">
				<label for="prenom_ar" class="form-label">الاسم</label>
                 <input type="text" class="form-control" id="prenom_ar"  required="" placeholder="الاسم..." oninput="this.className = ''" name="prenom_ar">
				<div class="valid-feedback">
				  Looks good!
				</div>
			</div>
			  <div class="col-md-6 ">
				<label for="nom_fr" class="form-label">Nom(fr)</label>
				<input type="text" class="form-control" id="nom_fr" value="{{$user->name}}" required=""  oninput="this.className = ''" name="nom_fr">
				
				<div class="valid-feedback">
				  Looks good!
				</div>
			  </div>
			  <div class="col-md-6 ">
				<label for="prenom_fr" class="form-label">Prenom(fr)</label>
				
				<input type="text" class="form-control" id="prenom_fr" value="{{$user->lastname}}" required="" oninput="this.className = ''" name="prenom_fr">
				<div class="valid-feedback">
				  Looks good!
				</div>
			  </div>
			  <div class="col-md-6">
				<label for="date_nais" class="form-label text-md-end">{{__('translation.date_nais')}}</label>
				
				<input type="date" class="form-control" id="date_nais" value="{{$user->birthday}}"  required="" placeholder="00/00/0000" oninput="this.className = ''" name="date_nais">
				
				<div class="valid-feedback">
				  Looks good!
				</div>
			  </div>
			  <div class="col-md-6">
				<label for="phone" class="col-md-3 form-label ">{{ __('translation.phone') }}</label>
				<input type="number" class="form-control" id="phone"  required=""  oninput="this.className = ''" name="phone">
				<div class="valid-feedback">
				  Looks good!
				</div>
			  </div>
			  <div class="col-md-3">
              <label for="mat_bac" class="form-label text-md-end">{{ __('translation.mat_bac') }}</label>

                  <input id="mat_bac" type="text" max="12" class="form-control " name="mat_bac" value="" required="">

                              
          </div>
		  <div class="col-sm-3">
              <label for="year_bac" class="form-label text-md-end">{{ __('translation.year_bac') }}</label>

                  <input id="year_bac" type="number" max="2022" class="form-control " name="year_bac" required="" value="">

                                
          </div>
		  {{-- <div class="col-sm-3">
            <label for="note_bac" class="form-label text-md-end"> {{ __('translation.note_bac') }}</label>

                <input id="note_bac" type="numeric" max="19" class="form-control " name="note_bac" required="" value="" >

                            
        </div> --}}
		<div class="col-sm-3">
            <label for="city_bac" class="form-label text-md-end">{{ __('translation.city_bac') }}</label>

              <select name="city_bac" id="city_bac"  required="" value="{{ old('city_bac') }}" class="form-select" >
                <option  ></option>
                  @foreach ($cities as $city)
                      @if (app()->getLocale() == 'ar')
                      <option value="{{$city->id}}">{{$city->name_ar}}</option>  
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
    <input type="hidden" id="licence_type_value" value="{{$user->licence_type}}">
    @if ($user->licence_type =='LMD')
    <input  type="radio" value="Classique" id="Classique" readonly @selected(false) disabled class="form-check-input" name="licence_type"   >
    <label class="form-check-label" for="Classique">
      {{__('translation.classique')}} 
    </label>
    <br>
    <input class="form-check-input" type="radio" readonly name="licence_type"   checked id="LMD" value="LMD"  onclick="afficherCacher()">
    <label class="form-check-label" for="LMD">
      {{__('translation.lmd')}} 
    </label>
    <br>
    <input class="form-check-input" type="radio" name="licence_type" @selected(false) disabled id="ingenieur" value="ingenieur"  onclick="afficherCacher()">
    <label class="form-check-label" for="ingenieur">
      {{__('translation.ingenieur')}} 
    </label>
    @elseif (($user->licence_type =='Classique'))
      <input  type="radio" value="Classique" id="Classique"  checked class="form-check-input" name="licence_type"   >
      <label class="form-check-label" for="Classique">
        {{__('translation.classique')}}  
      </label>
      <br>
      <input class="form-check-input" type="radio" name="licence_type" @selected(false) disabled id="LMD" value="LMD"  onclick="afficherCacher()">
      <label class="form-check-label" for="LMD">
        {{__('translation.lmd')}}
      </label>
      <br>
      <input class="form-check-input" type="radio" name="licence_type" @selected(false) disabled id="ingenieur" value="ingenieur"  onclick="afficherCacher()">
      <label class="form-check-label" for="ingenieur">
        {{__('translation.ingenieur')}} 
      </label>
      @elseif ((($user->licence_type =='ingenieur')))
      <input  type="radio" value="Classique" id="Classique" disabled  class="form-check-input" name="licence_type"   >
      <label class="form-check-label" for="Classique">
        {{__('translation.classique')}}  
      </label>
      <br>
      <input class="form-check-input" type="radio" name="licence_type" @selected(false) disabled id="LMD" value="LMD"  onclick="afficherCacher()">
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

              
                  <input id="licence" type="text" class="form-control " name="licence" required="" value="">

                            </div>
          <div class="col-md-4">
            <label for="year_last_dip" class="form-label text-md-end">{{ __('translation.year_last_dip') }}</label>

            <input id="year_last_dip" type="number" min="1970" max="2024" step="1" value="2022" class="form-control " name="year_last_dip" required="">

                        </div>
        <div class="col-md-4">
            <label for="univ_origine" class="form-label text-md-end">{{ __('translation.univ_origine') }}</label>

            
               <select name="univ_origine" id="univ_origine"  class="form-select" required="">
                    <option ></option>
                    <option >جامعة الجزائر 1</option>
                    <option >Externe-خارجي</option>
                </select>
                        </div>
    </div>
  
  <div class="row g-3">
  <div class="col-sm-4">
              <label for="S1" class="col-md-8 col-form-label ">{{ __('translation.S1') }}</label>

              <div class="col-md-4">
                  {{-- <input type="number" class="form-control numeric-input" name="S1" max="20" value="" required=""> --}}
                  <input type="number" step="0.01" id="S1"  name="S1"   class="form-control" max="20" required>

              </div>
          </div>
		  <div class="col-sm-4">
              <label for="S2" class="col-md-8 col-form-label ">{{ __('translation.S2') }}</label>

              <div class="col-md-4">
                  <input id="S2" type="number" step="0.01"  class="form-control numeric-input" name="S2" value="" max="20" required="">

              </div>
          </div>
		  <div class="col-sm-4">
              <label for="S3" class="col-md-8 col-form-label ">{{ __('translation.S3') }}</label>

              <div class="col-md-4">
                  <input id="S3" type="number" step="0.01"  class="form-control numeric-input" name="S3" value="" required="">

              </div>
          </div>
		  <div class="col-sm-4">
              <label for="S4" class="col-md-8 col-form-label ">{{ __('translation.S4') }}</label>

              <div class="col-md-4">
                  <input id="S4" type="number" step="0.01"  class="form-control numeric-input"  name="S4" value="" required="">

              </div>
          </div>
		  <div class="col-sm-4">
              <label for="S5" class="col-md-8 col-form-label ">{{ __('translation.S5') }}</label>

              <div class="col-md-4">
                  <input id="S5" type="number" step="0.01"  class="form-control numeric-input" name="S5" id="S5" value="">

              </div>
          </div>
		  <div class="col-sm-4">
              <label for="S6" class="col-md-6 col-form-label ">{{ __('translation.S6') }}</label>

              <div class="col-md-4">
                  <input id="S6" type="number" step="0.01"  class="form-control numeric-input" name="S6"  id="S6" value="">

              </div>
          </div>
		  <div class="col-sm-4">
              <label for="nb_dette" class="col-md-6 col-form-label ">{{ __('translation.Dette') }}</label>

              <div class="col-md-4">
                  <input id="nb_dette" type="number" min="0" class="form-control " name="nb_dette" value="">

              </div>
          </div>
		  <div class="col-sm-4">
              <label for="nb_rattrapage" class="col-md-6 col-form-label ">{{ __('translation.Rattrapage') }}</label>

              <div class="col-md-4">
                  <input id="nb_rattrapage" type="number" min="0" class="form-control " name="nb_rattrapage" required="">

              </div>
          </div>
		  <div class="col-sm-4">
              <label for="annee_doublon" class="col-md-6 col-form-label ">{{ __('translation.annee_doublon') }}</label>

              <div class="col-md-4">
                  <input id="annee_doublon" type="number" min="0" class="form-control " name="annee_doublon" required="">

              </div>
          </div>
  </div>
</div>
  <div class="tab"><h2>{{ __('translation.master_inscription') }} </h2>
	<div class="form-group row p-2">
    <div class="alert alert-danger alert-dismissible fade show col-11" role="alert">
      {{__('translation.doc_alert_message')}}
      <ul><li> - شهادة البكالوريا</li>
        <li>- شهادة الليسانس/ الدبلوم</li>
        <li>- كشوف النقاط</li></ul>
     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
            <label for="file" class="col-md-3 col-form-label ">{{ __('translation.file') }}</label>

            <div class="col-md-9">
               <input id="file" type="file" accept="application/pdf" class="form-control @error('file') is-invalid @enderror" name="file"  required  >

                @error('file')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <p id="errorMessage" style="color: red;"></p>
            </div>
        </div>
    
	
	<div class="form-group row p-2">
            <label for="departments" class="col-md-3 col-form-label text-left"><h5> {{__('translation.department')}}<span style="color:red;"> *</span></h5></label>
            <div class="col-md-9">
                <select name="department_id" id="department_id" class="form-select" required="true" >	  
              
                <option value="" selected="" required="true">{{__('translation.select_departement')}}</option>
                                        
                @foreach ($departments as $dep)
                    
                @if ($dep->is_active)
                <option value="{{$dep->id}}" data-speciality_max_choice="{{$dep->speciality_max_choice}}">{{$dep->name_fr}} - {{$dep->name_ar}}</option>
                
                @endif    

            @endforeach      
                  </select>
          </div>  
          
          </div>
          <h5>{{__('translation.title_Specialty_requested')}}</h5>
          <div id="sp"></div>
          <hr class="my-4">  
          {{-- <p><input oninput="this.className = ''" name="fin"></p> --}}
  </div>
  
 
  
   <div class="text-end " style="overflow:auto;padding-left: 15px; padding-right: 15px;">
    <div class="col align-self-end next-prev" >
      <button type="button"  id="prevBtn" onclick="nextPrev(-1)">&#8810;{{__('pagination.previous')}}</button>
      
      
      <button type="button"  id="nextBtn" onclick="nextPrev(1)">{{__('pagination.next')}}  &#8811;</button>
    </div>
  </div>
  
  <!-- Circles which indicates the steps of the form: -->
  <div style="text-align:center;margin-top:40px;">
    <span class="step">1</span>
    <span class="step">2</span>
    <span class="step">3</span>
  </div>
</form>
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
