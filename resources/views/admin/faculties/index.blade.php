@extends('layouts.dashboard.template')

@section('content')
    <div class="container" style="margin-top: 30px;">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">faculties List</h1>

            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group me-2">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <i class="bi bi-file-plus"></i>Add new faculty
                    </button>
                    {{-- <a type="button" class="btn btn-sm btn-info" href="{{url('/faculties/add')}}"> <i class="bi bi-file-plus"></i> Add</a> --}}
                </div>
            </div>
        </div>
        @if (session()->has('success'))
            <div class="fixed bg-green-600 text-white py-2 px-4 rounded-xl bottom-3 right-3 text-sm">
                <p>{{ session()->get('success') }}</p>
            </div>
        @endif
        <div class="table-responsive">
            <table class="table table-striped table-sm" style="min-height: 200px">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Status</th>
                        <th scope="col">inscription close date</th>
                        <th scope="col">update close date</th>
                        {{-- <th scope="col">treatment close date</th> --}}
                        <th scope="col">show result</th>
                        <th scope="col">recoure close date</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($faculties as $faculty)
                        <tr>
                            <td>{{ $faculty->id }}</td>
                            <td>{{ $faculty->name_fr }}</td>
                            <td>
                                @if ($faculty->is_active)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Disable</span>
                                @endif

                            </td>
                            <td>
                                <span class="badge {{ $faculty->inscription_close_is_valid ? 'bg-success' : 'bg-danger' }}">
                                    {{ $faculty->inscription_close_date }}
                                </span>
                            </td>
                            <td>
                                <span class="badge {{ $faculty->update_is_valid ? 'bg-success' : 'bg-danger' }}">
                                    {{ $faculty->update_close_date }}
                                </span>
                            </td>
                            {{-- <td>
                                <span class="badge {{ $faculty->treatment_is_valid ? 'bg-success' : 'bg-danger' }}">
                                    {{ $faculty->treatment_close_date }}
                                </span>
                            </td> --}}
                            <td>
                                @if ($faculty->show_result)
                                    <span class="badge bg-success">ON</span>
                                @else
                                    <span class="badge bg-danger">OFF</span>
                                @endif

                            </td>
                            <td>
                                <span class="badge {{ $faculty->recoure_is_valid ? 'bg-success' : 'bg-danger' }}">
                                    {{ $faculty->recoure_close_date }}
                                </span>
                            </td>
                            <td>


                                <div class="dropdown">
                                    <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton1"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        Actions
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <li> <a type="submit" class="dropdown-item"
                                                href="{{ url('faculties/edit/' . $faculty->id) }}"><i
                                                    class="bi bi-pencil-square m-1"></i> Edit</a></li>

                                        @if (!$faculty->is_active)
                                            <li>
                                                <form action="{{ url('faculties/active/' . $faculty->id) }}" method="post">
                                                    @csrf
                                                    <button type="submit" class="dropdown-item"><i
                                                            class="bi bi-eye m-1"></i> Activate Status</button>
                                                </form>
                                            </li>
                                        @else
                                            <li>
                                                <form action="{{ url('faculties/disable/' . $faculty->id) }}" method="post">
                                                    @csrf
                                            <li><button type="submit" class="dropdown-item"><i
                                                        class="bi bi-archive m-1"></i> Disable Status</button></li>
                                            </form>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
                <tfoot>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col"> global config</th>
                        <th scope="col">-</th>
                        <th scope="col"><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#globalconfigInscription">
                            global config Inscription
                          </button></th>
                        <th scope="col"><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#globalconfigUpdate">
                            global config Update
                          </button></th>
                        {{-- <th scope="col"><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#globalConfigTreatment">
                             globalConfig Treatment
                          </button></th> --}}
                        <th scope="col"><button type="button" class="btn btn-primary sm" data-bs-toggle="modal" data-bs-target="#globalConfigShowResult">
                         globalConfig ShowResult
                          </button></th>
                          <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                </tfoot>
            </table>
        </div>

        <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#globalconfig">
  global config
</button>
@include('admin.faculties.globalConfig')
@include('admin.faculties.globalConfigShowResult')
@include('admin.faculties.globalConfigtTreatment')
@include('admin.faculties.globalConfigInscription')
@include('admin.faculties.globalConfigUpdate')
    </div>

@endsection



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add faculty</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ url('faculties/store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name (ar)</label>
                        <input type="text" class="form-control" name="name_ar" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Name (fr)</label>
                        <input type="text" class="form-control" name="name_fr" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Code</label>
                        <input type="text" class="form-control" name="code" required>
                    </div>
                    <div class="row m-4">
                        <button class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
               
            </div>
        </div>
    </div>
</div>

