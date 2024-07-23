@extends('layouts.dashboard.template')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Admins list') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="btn-toolbar mb-2 mb-md-0">
                            <div class="btn-group me-2">
                                <a type="button" class="btn btn-sm btn-info" href="{{ route('admin.register-view') }}"> <i
                                        class="bi bi-file-plus"></i> Add new manager</a>
                            </div>
                        </div>

                        @if (isset($admins))
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nom </th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Faculté</th>
                                        <th scope="col">role</th>
                                        <th scope="col">account etat</th>
                                        <th scope="col"> Action</th>

                                    </tr>
                                </thead>
                                <tbody class="table-group-divider">
                                    @foreach ($admins as $admin)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $admin->name }}</td>
                                            <td> {{ $admin->email }}</td>
                                            <td> {{ $admin->faculty->name_fr }}</td>

                                            <td>
                                                {{ $admin->role ? $admin->role->name : '-' }}
                                                {{-- @foreach ($admin->roles as $role)
                                {{ $role->name }}
                                @unless ($loop->last)
                                    , 
                                @endunless
                            @endforeach     --}}
                                            </td>
                                            <td>
                                                @if ($admin->is_active)
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-danger">Disable</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.edit', $admin->id) }}">edit</a>
                                                {{-- @if (Auth::user()->hasPermission('admin@delete'))
                                        <form method="POST" action="{{ route('admin_remove', $admin->id) }}"
                                            onsubmit="return confirm(' حذف نهائي؟');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">حذف نهائي! </button>
                                        </form>
                                    @endif --}}

                                            </td>

                                        </tr>
                                    @endforeach


                                </tbody>
                            </table>
                        @else
                            No admins to show
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
