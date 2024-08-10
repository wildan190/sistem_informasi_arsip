@extends('cms.layouts.app')
@section('content')

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">{{ __('Users') }}</h1>

@if (session('success'))
<div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@if (session('status'))
<div class="alert alert-success border-left-success" role="alert">
    {{ session('status') }}
</div>
@endif

<div class="row">
    <div class="col-lg-12 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">{{ __('Users') }}</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="usersTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>{{ __('No.') }}</th>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Email') }}</th>
                                <th>{{ __('Roles') }}</th>
                                <th>{{ __('Email Verified') }}</th>
                                <th>{{ __('Created At') }}</th>
                                <th>{{ __('Updated At') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->roles ? $user->roles->pluck('name')->join(', ') : '' }}</td>
                                <td>
                                    @if ($user->email_verified_at)
                                    <span class="text-success">{{ __('Verified') }}</span>
                                    @else
                                    <span class="text-danger">{{ __('Unverified') }}</span>
                                    @endif
                                </td>
                                <td>{{ $user->created_at }}</td>
                                <td>{{ $user->updated_at }}</td>
                                <td>
                                    @if (auth()->user()->hasPermissionTo('Assign'))
                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary btn-circle">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 mb-4">
        <div class="mx-auto">
            {!! $users->links() !!}
        </div>
    </div>
</div>

@endsection