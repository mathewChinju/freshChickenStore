@extends('layouts.admin')

@section('title', 'Edit Role - Admin')
@section('page-title', 'Edit Role')

@section('content')
<!-- Breadcrumb -->
<div class="breadcrumb-section mb-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.dashboard') }}" class="breadcrumb-link">
                    <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                </a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('admin.roles.index') }}" class="breadcrumb-link">
                    <i class="fas fa-user-shield me-2"></i>Roles
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                <i class="fas fa-edit me-2"></i>Edit {{ $role->name }}
            </li>
        </ol>
    </nav>
</div>

<!-- Edit Role Form -->
<div class="content-card">
    <div class="content-card-header">
        <h5 class="content-card-title">
            <i class="fas fa-edit me-2"></i>Edit Role: {{ $role->name }}
        </h5>
        <div class="header-actions">
            <a href="{{ route('admin.roles.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i>Back to Roles
            </a>
        </div>
    </div>
    <div class="content-card-body">
        <form method="POST" action="{{ route('admin.roles.update', $role) }}">
            @csrf
            @method('PUT')
            
            <!-- Role Name -->
            <div class="form-section">
                <h6 class="form-section-title">Role Information</h6>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="name" class="form-label">
                                Role Name <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name', $role->name) }}" 
                                   placeholder="e.g., Content Manager"
                                   @if($role->name === 'Super Admin') readonly @endif
                                   required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            @if($role->name === 'Super Admin')
                                <div class="form-text text-warning">
                                    <i class="fas fa-lock me-1"></i>Super Admin role name cannot be changed
                                </div>
                            @else
                                <div class="form-text">Use descriptive names like 'Content Manager' or 'Sales Representative'</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Permissions -->
            <div class="form-section">
                <h6 class="form-section-title">Assign Permissions</h6>
                
                <div class="form-group mb-3">
                    <label class="form-label">Select Permissions</label>
                    
                    @if($role->name === 'Super Admin')
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            Super Admin role has all permissions by default and cannot be modified.
                        </div>
                    @else
                        <div class="permissions-grid">
                            @foreach($permissions->groupBy(function($permission) {
                                return explode('-', $permission->name)[0];
                            }) as $group => $groupPermissions)
                                <div class="permission-group">
                                    <h6 class="permission-group-title">
                                        <i class="fas fa-{{ 
                                            $group == 'dashboard' ? 'tachometer-alt' : 
                                            ($group == 'product' ? 'box' : 
                                            ($group == 'category' ? 'folder' : 
                                            ($group == 'order' ? 'shopping-cart' : 
                                            ($group == 'user' ? 'users' : 
                                            ($group == 'role' ? 'user-shield' : 'key'))))) 
                                        }} me-2"></i>
                                        {{ ucfirst($group) }}
                                    </h6>
                                    <div class="permission-items">
                                        @foreach($groupPermissions as $permission)
                                            <div class="form-check">
                                                <input class="form-check-input" 
                                                       type="checkbox" 
                                                       id="permission_{{ $permission->id }}" 
                                                       name="permissions[]" 
                                                       value="{{ $permission->id }}"
                                                       @if(in_array($permission->id, $rolePermissions)) checked @endif>
                                                <label class="form-check-label" for="permission_{{ $permission->id }}">
                                                    {{ ucfirst(str_replace('-', ' ', $permission->name)) }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                    
                    @error('permissions')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Current Status -->
            <div class="form-section">
                <h6 class="form-section-title">Current Status</h6>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="info-card">
                            <div class="info-item">
                                <span class="info-label">Users with this role:</span>
                                <span class="info-value">{{ $role->users()->count() }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Current permissions:</span>
                                <span class="info-value">{{ $role->permissions->count() }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Created at:</span>
                                <span class="info-value">{{ $role->created_at->format('M d, Y') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="form-actions">
                <button type="submit" class="btn btn-primary" @if($role->name === 'Super Admin') disabled @endif>
                    <i class="fas fa-save me-2"></i>Update Role
                </button>
                <a href="{{ route('admin.roles.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-times me-2"></i>Cancel
                </a>
            </div>
        </form>
    </div>
</div>

<style>
.permissions-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
    margin-top: 1rem;
}

.permission-group {
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    padding: 1rem;
    background: #f9fafb;
}

.permission-group-title {
    font-size: 0.875rem;
    font-weight: 600;
    color: #374151;
    margin-bottom: 0.75rem;
    padding-bottom: 0.5rem;
    border-bottom: 1px solid #e5e7eb;
}

.permission-items {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.form-check {
    margin-bottom: 0;
}

.form-check-input:checked {
    background-color: #3b82f6;
    border-color: #3b82f6;
}

.form-check-label {
    font-size: 0.875rem;
    color: #6b7280;
}

.info-card {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    padding: 1rem;
}

.info-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.5rem 0;
    border-bottom: 1px solid #e2e8f0;
}

.info-item:last-child {
    border-bottom: none;
}

.info-label {
    font-weight: 500;
    color: #64748b;
}

.info-value {
    font-weight: 600;
    color: #1e293b;
}
</style>

@endsection
