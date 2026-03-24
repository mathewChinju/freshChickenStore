@extends('layouts.admin')

@section('title', 'Manage Roles - Admin')
@section('page-title', 'Roles Management')

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
            <li class="breadcrumb-item active" aria-current="page">
                <i class="fas fa-user-shield me-2"></i>Roles
            </li>
        </ol> 
    </nav>
</div>

<!-- Roles List -->
<div class="content-card">
    <div class="content-card-header">
        <h5 class="content-card-title">
            <i class="fas fa-user-shield me-2"></i>Roles
            <span class="badge bg-secondary ms-2">{{ $roles->total() }} total</span>
        </h5>
        <div class="header-actions">
            @if(auth()->user()->hasPermissionTo('role-create'))
                <a href="{{ route('admin.roles.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Add Role
                </a>
            @endif
        </div>
    </div>
    <div class="content-card-body">
        @if($roles->count() > 0)
            <div class="table-responsive">
                <table class="modern-table">
                    <thead>
                        <tr>
                            <th>Role Name</th>
                            <th>Permissions</th>
                            <th>Users Count</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($roles as $role)
                            <tr>
                                <td>
                                    <div class="role-info">
                                        <div class="role-name">
                                            <i class="fas fa-{{ $role->name == 'Super Admin' ? 'crown' : ($role->name == 'Admin' ? 'user-shield' : 'user') }} me-2"></i>
                                            {{ $role->name }}
                                        </div>
                                        <div class="role-id small text-muted">ID: {{ $role->id }}</div>
                                    </div>
                                </td>
                                <td>
                                    <div class="permissions-container">
                                        @if($role->permissions->count() > 0)
                                            @foreach($role->permissions->take(3) as $permission)
                                                <span class="permission-badge">
                                                    {{ $permission->name }}
                                                </span>
                                            @endforeach
                                            @if($role->permissions->count() > 3)
                                                <span class="permission-more">
                                                    +{{ $role->permissions->count() - 3 }} more
                                                </span>
                                            @endif
                                        @else
                                            <span class="text-muted">No permissions</span>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <span class="users-count-badge">
                                        <i class="fas fa-users me-1"></i>
                                        {{ $role->users_count }} user(s)
                                    </span>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        @if(auth()->user()->hasPermissionTo('role-edit'))
                                            <a href="{{ route('admin.roles.edit', $role) }}" 
                                               class="btn btn-sm btn-outline-primary"
                                               data-tooltip="Edit Role">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        @endif
                                        @if(auth()->user()->hasPermissionTo('role-delete') && $role->name !== 'Super Admin')
                                            <button type="button" 
                                                    class="btn btn-sm btn-outline-danger" 
                                                    onclick="deleteRole({{ $role->id }}, '{{ $role->name }}')"
                                                    data-tooltip="Delete Role">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- Simple Pagination -->
            <div class="simple-pagination">
                <div class="pagination-info">
                    Showing {{ $roles->firstItem() }} to {{ $roles->lastItem() }} of {{ $roles->total() }} roles
                </div>
                <div class="pagination-links">
                    @if($roles->hasPages())
                        <!-- First Page -->
                        @if($roles->currentPage() > 1)
                            <a href="{{ $roles->url(1) }}" class="pagination-link">
                                <i class="fas fa-angle-double-left"></i>
                            </a>
                        @else
                            <span class="pagination-link disabled">
                                <i class="fas fa-angle-double-left"></i>
                            </span>
                        @endif
                        
                        <!-- Previous Page -->
                        @if($roles->currentPage() > 1)
                            <a href="{{ $roles->url($roles->currentPage() - 1) }}" class="pagination-link">
                                <i class="fas fa-angle-left"></i>
                            </a>
                        @else
                            <span class="pagination-link disabled">
                                <i class="fas fa-angle-left"></i>
                            </span>
                        @endif
                        
                        <!-- Page Numbers -->
                        @if($roles->lastPage() <= 7)
                            @for($i = 1; $i <= $roles->lastPage(); $i++)
                                <a href="{{ $roles->url($i) }}" 
                                   class="pagination-link {{ $i == $roles->currentPage() ? 'active' : '' }}">
                                    {{ $i }}
                                </a>
                            @endfor
                        @else
                            @php
                                $start = max(1, $roles->currentPage() - 2);
                                $end = min($roles->lastPage(), $roles->currentPage() + 2);
                            @endphp
                            
                            @if($start > 1)
                                <a href="{{ $roles->url(1) }}" class="pagination-link">1</a>
                                @if($start > 2)
                                    <span class="pagination-link disabled">...</span>
                                @endif
                            @endif
                            
                            @for($i = $start; $i <= $end; $i++)
                                <a href="{{ $roles->url($i) }}" 
                                   class="pagination-link {{ $i == $roles->currentPage() ? 'active' : '' }}">
                                    {{ $i }}
                                </a>
                            @endfor
                            
                            @if($end < $roles->lastPage())
                                @if($end < $roles->lastPage() - 1)
                                    <span class="pagination-link disabled">...</span>
                                @endif
                                <a href="{{ $roles->url($roles->lastPage()) }}" class="pagination-link">{{ $roles->lastPage() }}</a>
                            @endif
                        @endif
                        
                        <!-- Next Page -->
                        @if($roles->currentPage() < $roles->lastPage())
                            <a href="{{ $roles->url($roles->currentPage() + 1) }}" class="pagination-link">
                                <i class="fas fa-angle-right"></i>
                            </a>
                        @else
                            <span class="pagination-link disabled">
                                <i class="fas fa-angle-right"></i>
                            </span>
                        @endif
                        
                        <!-- Last Page -->
                        @if($roles->currentPage() < $roles->lastPage())
                            <a href="{{ $roles->url($roles->lastPage()) }}" class="pagination-link">
                                <i class="fas fa-angle-double-right"></i>
                            </a>
                        @else
                            <span class="pagination-link disabled">
                                <i class="fas fa-angle-double-right"></i>
                            </span>
                        @endif
                    @endif
                </div>
            </div>
        @else
            <div class="empty-state">
                <i class="fas fa-user-shield empty-icon"></i>
                <h6>No roles found</h6>
                <p class="text-muted">No roles have been created yet</p>
                @if(auth()->user()->hasPermissionTo('role-create'))
                    <a href="{{ route('admin.roles.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Create First Role
                    </a>
                @endif
            </div>
        @endif
    </div>
</div>

<script>
function deleteRole(roleId, roleName) {  
    Swal.fire({
        title: 'Delete Role?',
        html: "Are you sure you want to delete the role <strong>'" + roleName + "'</strong>? This action cannot be undone.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            // Create form and submit
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/admin/roles/${roleId}`;
            
            // Add CSRF token
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = csrfToken;
            form.appendChild(csrfInput);
            
            // Add DELETE method
            const methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'DELETE';
            form.appendChild(methodInput);
            
            // Submit form
            document.body.appendChild(form);
            form.submit();
        }
    });
}
</script>

@endsection
