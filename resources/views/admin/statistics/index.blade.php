@extends('layouts.dashboard.template')

@section('content')
    <div class="container" style="margin-top: 30px;">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2"> Statistique</h1>


        </div>
        @if (session()->has('success'))
            <div class="fixed bg-green-600 text-white py-2 px-4 rounded-xl bottom-3 right-3 text-sm">
                <p>{{ session()->get('success') }}</p>
            </div>
        @endif
        <div class=" table-responsive" >
            <h5>Résultats générés le: {{ $currentDateTime }}</h5>
            <table class="table table-bordered  table-striped  ">
                <thead>
                    <tr>
                        <th>Faculté </th>
                        <th>Accepté</th>
                        <th>Refusé</th>
                        <th>Non traité</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($statistics as $faculty_name => $stats)
                        <tr>
                            <td>{{ $faculty_name }}</td>
                            <td>{{ $stats->where('etat', 'Accepté')->first()->total ?? 0 }}</td>
                            <td>{{ $stats->where('etat', 'Refusé')->first()->total ?? 0 }}</td>
                            <td>{{ $stats->where('etat', 'Non traité')->first()->total ?? 0 }}</td>
                            <td>{{ $facultyTotals[$faculty_name] ?? 0 }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Total</th>
                        <th>{{ $totals['Accepté'] ?? 0 }}</th>
                        <th>{{ $totals['Refusé'] ?? 0 }}</th>
                        <th>{{ $totals['Non traité'] ?? 0 }}</th>
                        <th>{{ array_sum($facultyTotals->toArray()) }}</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="table-responsive">
          <table class="table table-striped table-sm">
           

        </div>



    </div>
@endsection
