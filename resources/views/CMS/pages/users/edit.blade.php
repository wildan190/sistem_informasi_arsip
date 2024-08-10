@extends('cms.layouts.app')
@section('content')

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
        <a href="{{ route('users.index') }}" class="btn btn-primary btn-icon-split">
            <span class="icon text-white-50">
                <i class="fas fa-arrow-left"></i>
            </span>
            <span class="text">{{ __('Back') }}</span>
        </a>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 mb-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">{{ __('Edit User') }}</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ $user->name }}" required>
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ $user->email }}" required>
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="roles">Roles</label>
                        @foreach($roles as $role)
                            <div class="form-check">
                                @php
                                    $checked = false;
                                    if($user->roles){
                                        foreach($user->roles as $userRole){
                                            if($userRole->id == $role->id){
                                                $checked = true;
                                                break;
                                            }
                                        }
                                    }
                                @endphp
                                <input class="form-check-input" type="checkbox" name="roles[]" id="role-{{ $role->id }}" value="{{ $role->id }}" {{ ($checked) ? 'checked' : '' }} onchange="checkRole(this)">
                                <label class="form-check-label" for="role-{{ $role->id }}">
                                    {{ $role->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                    <script>
                        function checkRole(checkbox) {
                            if($("input[name='roles[]']:checked").length > 1 && checkbox.checked) {
                                alert("Hanya bisa pilih salah satu");
                                checkbox.checked = false;
                            }
                        }
                    </script>
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                        <a href="{{ route('users.index') }}" class="btn btn-danger">{{ __('Cancel') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection