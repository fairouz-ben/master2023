{{-- @extends('layouts.app') --}}
@extends('layouts.dashboard.template_2')
@section('content')
    <div class="col-12">



        <div class="card">
            <div class="card-header">
                <h3> {{ __('translation.listinscrit') }} {{$facName_ar ?? ''}}</h3>
            </div>
            <div class="row">
                <div class="  col-8">
                    <form id="filter-form" class="form-group">
                        @csrf

                        <input type="hidden"  name="" id="fac_id" value="{{$facid}}">
                        <div class="row  p-3">
                            <label for="dep_id" class="col-sm-2 form-label"> Département</label>
                            <div class="col-sm-6">
                                <select name="dep_id" onchange="applyFilter()" id="dep_id" class="form-select">
                                    <option value="">---</option>
                                    @if (Auth::guard('admin')->user()->role_id == '1')
                                        @foreach ($departments as $dep)
                                            <option value="{{ $dep->id }}">{{ $dep->name_fr }}</option>
                                        @endforeach
                                    @else
                                        @foreach (Auth::guard('admin')->user()->faculty->departments()->get() as $dep)
                                            <option value="{{ $dep->id }}">{{ $dep->name_fr }}</option>
                                        @endforeach
                                    @endif

                                </select>
                            </div>
                        </div>
                        <div class="row  p-3">
                            <label for="type_id" class="col-sm-2 form-label"> Licence type</label>
                            <div class="col-sm-6">
                                <select name="type_id" onchange="applyFilter()" id="type_id" class="form-select">
                                    <option value=""> --</option>
                                    <option value="LMD"> LMD</option>
                                    <option value="Classique">Classique</option>
                                    <option value="ingenieur">Ingenieur</option>

                                </select>
                            </div>
                        </div>


                        {{-- <button type="submit" class="btn btn-primary">Apply Filter</button>  --}}
                    </form>
                    {{-- @endif --}}
                </div>
                @if ((Auth::guard('admin')->user()->role_id == '1') || (Auth::guard('admin')->user()->role_id == '2'))
                <div class="col-4">
                    <button id="btn_etat_refus_all" type="button" class="btn btn-outline-danger">Refuser tout No
                        traité</button>

                </div>  
                @endif
                
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
            var type_id = $('#type_id').val();
            var facId    = $('#fac_id').val();
            var url = `{{ url('students/${facId}') }}`;
        var baseUrl =`"{{ route('students') }}"`;
        var facParams = new URLSearchParams({
            faculty: facId
        }).toString();
        var queryParams = new URLSearchParams({
            dep_id: dep_id,
            licenceType: type_id,
        }).toString();
/*
// window.location.href = "{{ route('students') }}";
// window.location.href = "{{ route('students') }}?dep_id=" + `${dep_id}&licenceType=${type_id}`;
*/
            if (dep_id == null)
               
                window.location.href =  `${url}`; //`${baseUrl}`;
            else
            window.location.href = `${url}?${queryParams}`;
               
        }
    </script>



    <script type="text/javascript">
        $(document).ready(function() {
            /*
       We use window.LaravelDataTables['students-table'] to access the existing DataTable instance that has been initialized by Laravel DataTables using the $dataTable->scripts() method.
       */


            // var table =window.LaravelDataTables['students-table'];
            // const table = $('#students-table').DataTable();//


            // Listen to checkbox changes
           

            //-----------------------------------





            let searchParams = new URLSearchParams(window.location.search)
            if (searchParams.has('dep_id')) {
                let param = searchParams.get('dep_id')

                $("#dep_id option[value='" + param + "']").attr("selected", "selected");


            }
            if (searchParams.has('licenceType')) {
                let param2 = searchParams.get('licenceType')

                $("#type_id option[value='" + param2 + "']").attr("selected", "selected");

            }
            /*$.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            */
            $('#btn_etat_refus_all').on('click', function() {
                if (confirm("Refuser tout No traité?") == true) {
                    var department = $('#dep_id').val();

                    //ajax
                    $.ajax({

                        type: "GET",
                        url: "{{ url('etat_refus_all/') }}" + `/ ${department}`,
                        /* data: {
                            // department: department,
                            // _token: '{!! csrf_token() !!}'
                         },*/
                        dataType: 'json',
                        success: function(res) {
                            var oTable = $('#students-table').dataTable();
                            oTable.fnDraw(false);
                            alert('fin de Refuser No traité');
                        }
                    });

                    //end ajax
                }
            });
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

                var id = $(this).data('id');
                $('#etat').val($(this).data('etat'));
                $('#motif').val($(this).data('motif'));
                $('#oriented_to_speciality').val($(this).data('oriented_to_speciality'));

                let opt0 = `<option value="null"> </option>`;
                // $('#oriented_to_speciality').append(opt0);
                //ajax
                $.ajax({
                    type: "get",
                    data: {
                        "id": id,
                        "_token": "{{ csrf_token() }}"
                    },
                    url: '{{ url('/ajax_get_sp') }}',
                    success: function(response) {
                        for (var i = 0; i < response.length; i++) {
                            if($(this).data('oriented_to_speciality') == response[i]['id']){
                                $('#oriented_to_speciality').append(
                                `<option value="${ response[i]['id']}" selected>${ response[i]['name']}</option>`
                                );
                            } else
                            $('#oriented_to_speciality').append(
                                `<option value="${ response[i]['id']}">${ response[i]['name']}</option>`
                            );
                        }

                    }
                });

                //end ajax




                $('#id_st').val(id);
                $('#id').val(id);

                $('#editUserModal').modal('show');

            });


            $("#etat").change(function() {
                if ($(this).val() == "Refusé") {
                    $("#motif").removeAttr("disabled");
                    $("#oriented_to_speciality").val("null");
                    $("#oriented_to_speciality").attr("disabled", "true");
                } else if ($(this).val() == "Accepté") {
                    $("#oriented_to_speciality").removeAttr("disabled");
                    $("#motif").val("null");
                    $("#motif").attr("disabled", true);
                } else {
                    // $("#motif").attr("disabled","true");
                    $("#oriented_to_speciality").attr("disabled", true);
                }
            });

            //Modal Events - show.bs.modal
            //Modal Events - hide.bs.modal
            $("#editUserModal").on('hidden.bs.modal', function() {

                $("#motif").removeAttr("disabled");//attr("disabled", true);
                $('#oriented_to_speciality').empty();
                // $("#oriented_to_speciality").attr("disabled",true);
            });
        });
    </script>
@endpush
