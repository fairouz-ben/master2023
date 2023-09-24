{{-- @extends('layouts.app') --}}
@extends('layouts.dashboard.template_2')
@section('content')
<div class="col-12">
    
  
   
    <div class="card">
        <div class="card-header">
            <h3>     {{__('translation.listinscrit')}}</h3>
          </div>
          <div class=" row">
            {{-- @if(Auth::user()->hasPermission('student@list'))  --}}
            <form id="filter-form" class="form-group">
                @csrf
                 
             
                    <div class="row  p-3">
                        <label for="dep_id" class="col-sm-2 form-label">La liste est pour</label>
                        <div class="col-sm-4">
                        <select  name="dep_id"  onchange="applyFilter()"  id="dep_id" class="form-select">
                            <option value="">---</option>   
                            @if(Auth::guard('admin')->user()->role_id =='1')
                            @foreach ($departments as $dep )
                                
                            <option value="{{$dep->id}}">{{$dep->name_fr}}</option> 
                                
                            @endforeach 
                        @else
                            @foreach ( Auth::guard('admin')->user()->faculty->departments()->get() as $dep )
                                
                            <option value="{{$dep->id}}">{{$dep->name_fr}}</option> 
                                
                            @endforeach 
                        @endif

                        </select>
                        </div>
                    </div>
                  
                    
                {{-- <button type="submit" class="btn btn-primary">Apply Filter</button>  --}}
            </form>
            {{-- @endif --}}
        </div>
    
    
    <div class="card-body">
    
                    <div class="table-responsive" style="width: 95%">
                        
                        {{ $dataTable->table() }}
                    </div>
                    
                    @include('admin.students.model')
                </div>
                </div>
    </div>
   
@endsection
@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    <script>
        function applyFilter() {
            var dep_id = $('#dep_id').val();
            
            if (dep_id == null)
            window.location.href =  "{{ route('students') }}" ;
        else
            window.location.href =  "{{ route('students') }}?dep_id=" + `${dep_id}`;
            
        }
    </script>
    <script type="text/javascript">
        $(document).ready(function() {

            let searchParams = new URLSearchParams(window.location.search)
       if ( searchParams.has('dep_id'))
       {
        let param = searchParams.get('dep_id')
        //console.log(param )
        $("#dep_id option[value='"+ param +"']").attr("selected", "selected");
       
        //Last, if you have multiple entries for the same parameter (like ?id=1&id=2), you can use
        //let param = searchParams.getAll('id')
   
       }
        /*$.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        */  
            $('#students-table').on('click', '.active', function() {
                if (confirm("active Record?") == true) {
                    var id = $(this).data('id');

                    //ajax
                    $.ajax({

                        type: "POST",
                        url: "{{ url('admin/student_active') }}",
                        data: {
                            id: id,
                            _token: '{!! csrf_token() !!}'
                        },
                        dataType: 'json',
                        success: function(res) {

                            var oTable = $('#students-table').dataTable();
                            oTable.fnDraw(false);
                        }
                    });
                    
                    //end ajax
                }
            });

            $('#students-table').on('click', '.delete', function() {
                if (confirm("Désactiver Record?") == true) {
                    var id = $(this).data('id');
                    // ajax
                    $.ajax({
                        type: "POST",
                        url: "{{ url('admin/student_disable') }}",
                        data: {
                            id: id,
                            _token: '{!! csrf_token() !!}'
                        },
                        dataType: 'json',
                        success: function(res) {
                            var oTable = $('#students-table').dataTable();
                            oTable.fnDraw(false);

                        }

                    });
                }
            });
            
            $('#students-table').on('click', '.edit', function() {
               
                //$('#oriented_to_speciality').empty();
                let data =$(this).data('edit'); 
                $('#etat').val(data.etat); 
                $('#motif').val(data.motif); 
                $('#oriented_to_speciality').val(data.oriented_to_speciality);
                let opt0=`<option value="null"> </option>`;
                let opt1=`<option value="${data.special_1}">${data.special_1}</option>`;
                let opt2=`<option value="${data.special_2}">${data.special_2}</option>`;
                let opt3=`<option value="${data.special_3}">${data.special_3}</option>`;
                $('#oriented_to_speciality').append(opt0,opt1);
                $('#oriented_to_speciality').append(opt2);
                
                $('#id_st').val(data.id);
                $('#id').val(data.id);
                
                $('#editUserModal').modal('show');
                
            });


            $("#etat").change(function(){
                if($(this).val()=="Refusé"){
                $("#motif").removeAttr("disabled");
                $("#oriented_to_speciality").val("null");
                $("#oriented_to_speciality").attr("disabled","true");
                }else if($(this).val()=="Accepté"){
                $("#oriented_to_speciality").removeAttr("disabled");
                $("#motif").val("null");
                $("#motif").attr("disabled",true);
                }else{
                    $("#motif").attr("disabled","true");
                    $("#oriented_to_speciality").attr("disabled",true);
                }
            });

            //Modal Events - show.bs.modal
            //Modal Events - hide.bs.modal
            $("#editUserModal").on('hidden.bs.modal', function(){
                
                $("#motif").attr("disabled",true);
                $('#oriented_to_speciality').empty();
               // $("#oriented_to_speciality").attr("disabled",true);
            });
        });
    </script>
@endpush



