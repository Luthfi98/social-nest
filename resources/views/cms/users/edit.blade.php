@extends('layouts.cms')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="mb-0">{{ $title }}</h5>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb small mb-0">
            <li class="breadcrumb-item">
                <a href="{{ route('cms.dashboard') }}" class="text-decoration-none">
                    <i class="fas fa-home"></i> {{ __('Dashboard') }}
                </a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('cms.users.index') }}" class="text-decoration-none">
                    <i class="fas fa-users"></i> {{ __('Users') }}
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                <i class="fas fa-user-edit"></i> {{ __('Edit User') }}
            </li>
        </ol>
    </nav>
</div>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-transparent border-0 py-2">
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('cms.users.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left me-1"></i> {{ __('Back') }}
                        </a>
                    </div>
                </div>
                <div class="card-body py-3">
                    <form action="{{ route('cms.users.update', $user->id) }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                        @csrf
                        @method('PUT')
                        
                        <!-- Basic Information -->
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name" class="small">{{ __('Name') }} <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-sm @error('name') is-invalid @enderror" 
                                           id="name" name="name" value="{{ old('name', $user->name) }}" 
                                           placeholder="{{ __('Name') }}" required>
                                    @error('name')
                                        <div class="invalid-feedback small">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="username" class="small">{{ __('Username') }} <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control form-control-sm @error('username') is-invalid @enderror" 
                                           id="username" name="username" value="{{ old('username', $user->username) }}" 
                                           placeholder="{{ __('Username') }}" required>
                                    @error('username')
                                        <div class="invalid-feedback small">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Contact Information -->
                        <div class="row g-3 mt-1">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email" class="small">{{ __('Email') }} <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control form-control-sm @error('email') is-invalid @enderror" 
                                           id="email" name="email" value="{{ old('email', $user->email) }}" 
                                           placeholder="{{ __('Email') }}" required>
                                    @error('email')
                                        <div class="invalid-feedback small">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password" class="small">{{ __('Password') }}</label>
                                    <input type="password" class="form-control form-control-sm @error('password') is-invalid @enderror" 
                                           id="password" name="password" placeholder="{{ __('Leave blank to keep current password') }}">
                                    <div class="form-text small">{{ __('Leave blank to keep current password') }}</div>
                                    @error('password')
                                        <div class="invalid-feedback small">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Role and Status -->
                        <div class="row g-3 mt-1">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="role_id" class="small">{{ __('Role') }}</label>
                                    <select class="form-select form-select-sm @error('role_id') is-invalid @enderror" 
                                            id="role_id" name="role_id">
                                        <option value="">{{ __('Select Role') }}</option>
                                        @foreach($roles as $role)
                                            <option value="{{ $role->id }}" {{ old('role_id', $user->role_id) == $role->id ? 'selected' : '' }}>
                                                {{ $role->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('role_id')
                                        <div class="invalid-feedback small">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="status" class="small">{{ __('Status') }} <span class="text-danger">*</span></label>
                                    <select class="form-select form-select-sm @error('status') is-invalid @enderror" 
                                            id="status" name="status" required>
                                        <option value="active" {{ old('status', $user->status) == 'active' ? 'selected' : '' }}>
                                            {{ __('Active') }}
                                        </option>
                                        <option value="inactive" {{ old('status', $user->status) == 'inactive' ? 'selected' : '' }}>
                                            {{ __('Inactive') }}
                                        </option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback small">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Additional Information -->
                        <div class="row g-3 mt-1">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="avatar" class="form-label small">{{ __('Avatar') }}</label>
                                    @if($user->avatar)
                                        <div class="mb-2">
                                            <img src="{{ asset('public/' . $user->avatar) }}" alt="Current Avatar" class="img-thumbnail" style="max-width: 100px;">
                                        </div>
                                    @endif
                                    <input type="file" class="form-control form-control-sm @error('avatar') is-invalid @enderror" 
                                           id="avatar" name="avatar" accept="image/*">
                                    <div class="form-text small">{{ __('Recommended: 200x200px') }}</div>
                                    @error('avatar')
                                        <div class="invalid-feedback small">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="bio" class="form-label small">{{ __('Bio') }}</label>
                                    <textarea class="form-control form-control-sm @error('bio') is-invalid @enderror" 
                                              id="bio" name="bio" rows="2" 
                                              placeholder="{{ __('Enter user bio...') }}">{{ old('bio', $user->bio) }}</textarea>
                                    @error('bio')
                                        <div class="invalid-feedback small">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="row mt-3">
                            <div class="col-12">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('cms.users.index') }}" class="btn btn-light btn-sm">
                                        {{ __('Cancel') }}
                                    </a>
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        <i class="fas fa-save me-1"></i> {{ __('Update User') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@push('scripts')

@endpush
@endsection 