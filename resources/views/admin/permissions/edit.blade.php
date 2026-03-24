@extends('layouts.admin')

@section('title', 'Edit Permission - Admin')
@section('page-title', 'Edit Permission')

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
                <a href="{{ route('admin.permissions.index') }}" class="breadcrumb-link">
                    <i class="fas fa-key me-2"></i>Permissions
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                <i class="fas fa-edit me-2"></i>Edit {{ $permission->name }}
            </li>
        </ol>
    </nav>
</div>

<!-- Edit Permission Form -->
<div class="content-card">
    <div class="content-card-header">
        <h5 class="content-card-title">
            <i class="fas fa-edit me-2"></i>Edit Permission: {{ $permission->name }}
        </h5>
        <div class="header-actions">
            <a href="{{ route('admin.permissions.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i>Back to Permissions
            </a>
        </div>
    </div>
    <div class="content-card-body">
        <form method="POST" action="{{ route('admin.permissions.update', $permission) }}">
            @csrf
            @method('PUT')
            
            <!-- Permission Name -->
            <div class="form-section">
                <h6 class="form-section-title">Permission Information</h6>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="name" class="form-label">
                                Permission Name <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name', $permission->name) }}" 
                                   placeholder="e.g., product-create"
                                   required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Use hyphen-separated format like 'product-create', 'user-edit', 'order-delete'</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Roles -->
            <div class="form-section">
                <h6 class="form-section-title">Assign to Roles</h6>
                
                <div class="form-group mb-3">
                    <label class="form-label">Select Roles</label>
                    <div class="roles-grid">
                        @foreach($roles as $role)
                            <div class="form-check">
                                <input class="form-check-input" 
                                       type="checkbox" 
                                       id="role_{{ $role->id }}" 
                                       name="roles[]" 
                                       value="{{ $role->name }}"
                                       @if(in_array($role->name, $permissionRoles)) checked @endif>
                                <label class="form-check-label" for="role_{{ $role->id }}">
                                    <i class="fas fa-{{ $role->name == 'Super Admin' ? 'crown' : ($role->name == 'Admin' ? 'user-shield' : 'user') }} me-2"></i>
                                    {{ $role->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                    @error('roles')
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
                                <span class="info-label">Permission Group:</span>
                                <span class="info-value">{{ ucfirst(explode('-', $permission->name)[0]) }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Assigned to roles:</span>
                                <span class="info-value">{{ $permission->roles->count() }}</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Created at:</span>
                                <span class="info-value">{{ $permission->created_at->format('M d, Y') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-2"></i>Update Permission
                </button>
                <a href="{{ route('admin.permissions.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-times me-2"></i>Cancel
                </a>
            </div>
        </form>
    </div>
</div>

<style>
.roles-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1rem;
    margin-top: 1rem;
}

.form-check {
    padding: 0.75rem;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    background: #f9fafb;
    transition: all 0.2s;
}

.form-check:hover {
    border-color: #3b82f6;
    background: #eff6ff;
}

.form-check-input:checked {
    background-color: #3b82f6;
    border-color: #3b82f6;
}

.form-check-label {
    font-size: 0.875rem;
    color: #374151;
    font-weight: 500;
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
