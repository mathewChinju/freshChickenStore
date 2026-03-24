@extends('layouts.admin')

@section('title', 'Edit User - Admin')
@section('page-title', 'Edit User')

@section('content')
<div class="container-standard">
    <div class="card-standard">
        <div class="card-header-standard">
            <div class="header-left">
                <h4 class="card-title-standard">
                    <i class="fas fa-user-edit me-2"></i>Edit User
                </h4>
                <p class="card-subtitle-standard">Update user account information: {{ $user->name }}</p>
            </div>
            <div class="header-right">
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i>Back to Users
                </a>
            </div>
        </div>
        <div class="card-body-standard">
            <form action="{{ route('admin.users.update', $user) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="form-grid">
                    <!-- Name and Email -->
                    <div class="form-row">
                        <div class="form-group-half">
                            <label for="name" class="form-label-standard">
                                Full Name <span class="required">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control-standard @error('name') is-invalid @enderror" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name', $user->name) }}" 
                                   placeholder="Enter full name"
                                   required>
                            @error('name')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group-half">
                            <label for="email" class="form-label-standard">
                                Email Address <span class="required">*</span>
                            </label>
                            <input type="email" 
                                   class="form-control-standard @error('email') is-invalid @enderror" 
                                   id="email" 
                                   name="email" 
                                   value="{{ old('email', $user->email) }}" 
                                   placeholder="Enter email address"
                                   required>
                            @error('email')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Phone and Address -->
                    <div class="form-row">
                        <div class="form-group-half">
                            <label for="phone" class="form-label-standard">
                                Phone Number
                            </label>
                            <input type="tel" 
                                   class="form-control-standard @error('phone') is-invalid @enderror" 
                                   id="phone" 
                                   name="phone" 
                                   value="{{ old('phone', $user->phone) }}" 
                                   placeholder="Enter phone number">
                            @error('phone')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group-half">
                            <label for="address" class="form-label-standard">
                                Address
                            </label>
                            <input type="text" 
                                   class="form-control-standard @error('address') is-invalid @enderror" 
                                   id="address" 
                                   name="address" 
                                   value="{{ old('address', $user->address) }}" 
                                   placeholder="Enter address">
                            @error('address')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Roles Selection -->
                    <div class="form-group-full">
                        <label class="form-label-standard">
                            User Roles <span class="required">*</span>
                        </label>
                        @if(auth()->user()->hasRole('Super Admin') && $user->id === auth()->id() && $user->hasRole('Super Admin'))
                            <div class="alert-warning-standard mb-2">
                                <div class="alert-icon">
                                    <i class="fas fa-shield-alt"></i>
                                </div>
                                <div class="alert-content">
                                    <strong>Security Notice:</strong> You cannot modify your own Super Admin role to maintain system security. Contact another Super Admin if you need role changes.
                                </div>
                            </div>
                        @endif
                        <div class="roles-grid mt-2">
                            @foreach($roles as $role)
                                <div class="form-check-standard mb-2">
                                    <input type="checkbox" 
                                           class="form-check-input-standard @error('roles') is-invalid @enderror @if(auth()->user()->hasRole('Super Admin') && $user->id === auth()->id() && $role->name === 'Super Admin') disabled-checkbox @endif" 
                                           id="role_{{ $role->id }}" 
                                           name="roles[]" 
                                           value="{{ $role->name }}"
                                           {{ $user->hasRole($role->name) ? 'checked' : '' }}
                                           @if(auth()->user()->hasRole('Super Admin') && $user->id === auth()->id() && $role->name === 'Super Admin')
                                               disabled
                                           @endif>
                                    <label class="form-check-label-standard @if(auth()->user()->hasRole('Super Admin') && $user->id === auth()->id() && $role->name === 'Super Admin') disabled-label @endif" for="role_{{ $role->id }}">
                                        <strong>{{ $role->name }}</strong>
                                        @if($role->name == 'Super Admin')
                                            <span class="text-muted ms-1">- Full system access</span>
                                        @elseif($role->name == 'Admin')
                                            <span class="text-muted ms-1">- Product & Order management</span>
                                        @else
                                            <span class="text-muted ms-1">- Basic access</span>
                                        @endif
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        @error('roles')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="alert-info-standard mt-3">
                        <div class="alert-icon">
                            <i class="fas fa-info-circle"></i>
                        </div>
                        <div class="alert-content">
                            <strong>Role Permissions Guide:</strong>
                            <ul class="mb-0 ps-3 mt-1">
                                <li><strong>Super Admin:</strong> Full system access including user management</li>
                                <li><strong>Admin:</strong> Product and order management</li>
                                <li><strong>User:</strong> View dashboard and basic information</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Update User
                    </button>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times me-2"></i>Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

<style>
.disabled-checkbox {
    opacity: 0.6;
    cursor: not-allowed;
    background-color: var(--gray-100);
}

.disabled-label {
    opacity: 0.6;
    cursor: not-allowed;
    color: var(--text-muted);
}

.disabled-label strong {
    color: var(--text-muted);
}
</style>


