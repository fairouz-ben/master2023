@extends('layouts.master')

@section('content')
    <table class="table table-bordered" id="students-table">
        <thead>
            <tr>
              <th >id</th>
              <th > Nom & prenom</th>              
              <th >classement</th>
              <th >Departement</th>
              <th >Specialities</th>
              <th >Statut</th>
              
              
            </tr>
        </thead>
    </table>
@stop

@push('scripts')
<script>
$(function() {
    $('#students-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('datatables.data') !!}',
        columns: [
          { data: 'id', name: 'id' },
            { data: 'nom_ar', name: 'nom_ar' },
            { data: 'moy_classement', name: 'moy_classement' },
            { data: 'department.name_fr', name: 'department_id' },
            { data: 'special_1', name: 'special_1' },
            { data: 'etat', name: 'etat' },
        ]
    });
});
</script>
@endpush