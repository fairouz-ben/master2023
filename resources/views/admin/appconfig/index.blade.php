@extends('layouts.dashboard.template')

@section('content')
    <div class="container" style="margin-top: 30px;">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2"> configuation</h1>

            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group me-2">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary disabled" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <i class="bi bi-file-plus"></i>Add new config
                    </button>
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
                        <th scope="col">Key</th>
                        <th scope="col">value</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($configs as $conf)
                        <tr>
                            <td>{{ $conf->id }}</td>
                            <td>{{ $conf->key }}</td>
                           
                            <td>
                                {{-- <span class="badge {{ $faculty->inscription_close_is_valid ? 'bg-success' : 'bg-danger' }}">
                                    {{ $faculty->inscription_close_date }}
                                </span> --}}
                                {{$conf->value}}
                            </td>
                        
                           
                           
                            <td>
                                
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal-{{$conf->id}}">
                                    <i class="bi bi-file-plus"></i>edit {{$conf->key}}
                                </button>
                                @include('admin.appconfig.edit')

                            </td>
                        </tr>
                    @endforeach

                </tbody>
                <tfoot>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col"> key</th>
                        <th scope="col">-</th>
                        <th scope="col"></th>
                      
                        
                    </tr>
                </tfoot>
            </table>
        </div>

 

    </div>

@endsection



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add config</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="#" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="key">Key</label>
                        <input type="text" class="form-control" name="key" required>
                    </div>
                    <div class="form-group">
                        <label for="value">value</label>
                        <input type="text" class="form-control" name="value" required>
                    </div>
                    <div class="form-group">
                        <label for="data_type">data type</label>
                        <input type="text" class="form-control" name="data_type" required>
                    </div>
                   
                    <div class="row m-4">
                        <button class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>

