@extends('layouts.admin')

@section('title', 'Create Permission - Admin')
@section('page-title', 'Create New Permission')

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
                <i class="fas fa-plus me-2"></i>Create
            </li>
        </ol>
    </nav>
</div>

<!-- Create Permission Form -->
<div class="content-card">
    <div class="content-card-header">
        <h5 class="content-card-title">
            <i class="fas fa-plus me-2"></i>Create New Permission
        </h5>
        <div class="header-actions">
            <a href="{{ route('admin.permissions.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-2"></i>Back to Permissions
            </a>
        </div>
    </div>
    <div class="content-card-body">
        <form method="POST" action="{{ route('admin.permissions.store') }}">
            @csrf
            
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
                                   value="{{ old('name') }}" 
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
                                       @if(in_array($role->name, old('roles', []))) checked @endif>
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

            <!-- Common Permission Templates -->
            <div class="form-section">
                <h6 class="form-section-title">Quick Templates</h6>
                
                <div class="row">
                    <div class="col-12">
                        <div class="template-buttons">
                            <button type="button" class="btn btn-outline-primary btn-sm" onclick="setPermissionTemplate('product-list')">
                                <i class="fas fa-box me-2"></i>Product List
                            </button>
                            <button type="button" class="btn btn-outline-primary btn-sm" onclick="setPermissionTemplate('product-create')">
                                <i class="fas fa-plus-circle me-2"></i>Product Create
                            </button>
                            <button type="button" class="btn btn-outline-primary btn-sm" onclick="setPermissionTemplate('product-edit')">
                                <i class="fas fa-edit me-2"></i>Product Edit
                            </button>
                            <button type="button" class="btn btn-outline-primary btn-sm" onclick="setPermissionTemplate('product-delete')">
                                <i class="fas fa-trash me-2"></i>Product Delete
                            </button>
                            <button type="button" class="btn btn-outline-primary btn-sm" onclick="setPermissionTemplate('user-list')">
                                <i class="fas fa-users me-2"></i>User List
                            </button>
                            <button type="button" class="btn btn-outline-primary btn-sm" onclick="setPermissionTemplate('user-edit')">
                                <i class="fas fa-user-edit me-2"></i>User Edit
                            </button>
                            <button type="button" class="btn btn-outline-primary btn-sm" onclick="setPermissionTemplate('order-list')">
                                <i class="fas fa-shopping-cart me-2"></i>Order List
                            </button>
                            <button type="button" class="btn btn-outline-primary btn-sm" onclick="setPermissionTemplate('order-edit')">
                                <i class="fas fa-clipboard-list me-2"></i>Order Edit
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-2"></i>Create Permission
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

.template-buttons {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
}

.template-buttons .btn {
    margin-bottom: 0.5rem;
}
</style>

<script>
function setPermissionTemplate(permissionName) {
    document.getElementById('name').value = permissionName;
}
</script>

@endsection
