@extends('layouts.admin')

@use(Illuminate\Support\Str)

@section('title', 'Manage Permissions - Admin')
@section('page-title', 'Permissions Management')

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
                <i class="fas fa-key me-2"></i>Permissions
            </li>
        </ol>
    </nav>
</div>

<!-- Permissions List -->
<div class="content-card">
    <div class="content-card-header">
        <h5 class="content-card-title">
            <i class="fas fa-key me-2"></i>Permissions
            <span class="badge bg-secondary ms-2">{{ $permissions->total() }} total</span>
        </h5>
        <div class="header-actions">
            @if(auth()->user()->hasPermissionTo('permission-create'))
                <a href="{{ route('admin.permissions.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Add Permission
                </a>
            @endif
        </div>
    </div>
    <div class="content-card-body">
        @if($permissions->count() > 0)
            <div class="table-responsive">
                <table class="modern-table">
                    <thead>
                        <tr>
                            <th>Permission Name</th>
                            <th>Group</th>
                            <th>Assigned Roles</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($permissions as $permission)
                            <tr>
                                <td>
                                    <div class="permission-info">
                                        <div class="permission-name">
                                            @php
                                                $group = explode('-', $permission->name)[0];
                                                
                                                switch($group) {
                                                    case 'dashboard':
                                                        $icon = 'tachometer-alt';
                                                        break;
                                                    case 'product':
                                                        $icon = 'box';
                                                        break;
                                                    case 'category':
                                                        $icon = 'folder';
                                                        break;
                                                    case 'order':
                                                        $icon = 'shopping-cart';
                                                        break;
                                                    case 'user':
                                                        $icon = 'users';
                                                        break;
                                                    case 'role':
                                                        $icon = 'user-shield';
                                                        break;
                                                    default:
                                                        $icon = 'key';
                                                        break;
                                                }
                                            @endphp
                                            <i class="fas fa-{{ $icon }} me-2"></i>
                                            {{ ucfirst(str_replace('-', ' ', $permission->name)) }}
                                        </div>
                                        <div class="permission-id small text-muted">ID: {{ $permission->id }}</div>
                                    </div>
                                </td>
                                <td>
                                    <span class="group-badge">
                                        {{ ucfirst(explode('-', $permission->name)[0]) }}
                                    </span>
                                </td>
                                <td>
                                    <div class="roles-container">
                                        @if($permission->roles->count() > 0)
                                            @foreach($permission->roles as $role)
                                                <span class="role-badge role-{{ Str::slug($role->name) }}">
                                                    <i class="fas fa-{{ $role->name == 'Super Admin' ? 'crown' : ($role->name == 'Admin' ? 'user-shield' : 'user') }} me-1"></i>
                                                    {{ $role->name }}
                                                </span>
                                            @endforeach
                                        @else
                                            <span class="text-muted">No roles assigned</span>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        @if(auth()->user()->hasPermissionTo('permission-edit'))
                                            <a href="{{ route('admin.permissions.edit', $permission) }}" 
                                               class="btn btn-sm btn-outline-primary"
                                               data-tooltip="Edit Permission">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        @endif
 
                                        @if(auth()->user()->hasPermissionTo('permission-delete')  )
                                        {{-- && $permission->roles->count() == 0) --}}
                                            <button type="button" 
                                                    class="btn btn-sm btn-outline-danger" 
                                                    onclick="deletePermission({{ $permission->id }}, '{{ $permission->name }}')"
                                                    data-tooltip="Delete Permission">
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
                    Showing {{ $permissions->firstItem() }} to {{ $permissions->lastItem() }} of {{ $permissions->total() }} permissions
                </div>
                <div class="pagination-links">
                    @if($permissions->hasPages())
                        <!-- First Page -->
                        @if($permissions->currentPage() > 1)
                            <a href="{{ $permissions->url(1) }}" class="pagination-link">
                                <i class="fas fa-angle-double-left"></i>
                            </a>
                        @else
                            <span class="pagination-link disabled">
                                <i class="fas fa-angle-double-left"></i>
                            </span>
                        @endif
                        
                        <!-- Previous Page -->
                        @if($permissions->currentPage() > 1)
                            <a href="{{ $permissions->url($permissions->currentPage() - 1) }}" class="pagination-link">
                                <i class="fas fa-angle-left"></i>
                            </a>
                        @else
                            <span class="pagination-link disabled">
                                <i class="fas fa-angle-left"></i>
                            </span>
                        @endif
                        
                        <!-- Page Numbers -->
                        @if($permissions->lastPage() <= 7)
                            @for($i = 1; $i <= $permissions->lastPage(); $i++)
                                <a href="{{ $permissions->url($i) }}" 
                                   class="pagination-link {{ $i == $permissions->currentPage() ? 'active' : '' }}">
                                    {{ $i }}
                                </a>
                            @endfor
                        @else
                            @php
                                $start = max(1, $permissions->currentPage() - 2);
                                $end = min($permissions->lastPage(), $permissions->currentPage() + 2);
                            @endphp
                            
                            @if($start > 1)
                                <a href="{{ $permissions->url(1) }}" class="pagination-link">1</a>
                                @if($start > 2)
                                    <span class="pagination-link disabled">...</span>
                                @endif
                            @endif
                            
                            @for($i = $start; $i <= $end; $i++)
                                <a href="{{ $permissions->url($i) }}" 
                                   class="pagination-link {{ $i == $permissions->currentPage() ? 'active' : '' }}">
                                    {{ $i }}
                                </a>
                            @endfor
                            
                            @if($end < $permissions->lastPage())
                                @if($end < $permissions->lastPage() - 1)
                                    <span class="pagination-link disabled">...</span>
                                @endif
                                <a href="{{ $permissions->url($permissions->lastPage()) }}" class="pagination-link">{{ $permissions->lastPage() }}</a>
                            @endif
                        @endif
                        
                        <!-- Next Page -->
                        @if($permissions->currentPage() < $permissions->lastPage())
                            <a href="{{ $permissions->url($permissions->currentPage() + 1) }}" class="pagination-link">
                                <i class="fas fa-angle-right"></i>
                            </a>
                        @else
                            <span class="pagination-link disabled">
                                <i class="fas fa-angle-right"></i>
                            </span>
                        @endif
                        
                        <!-- Last Page -->
                        @if($permissions->currentPage() < $permissions->lastPage())
                            <a href="{{ $permissions->url($permissions->lastPage()) }}" class="pagination-link">
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
                <i class="fas fa-key empty-icon"></i>
                <h6>No permissions found</h6>
                <p class="text-muted">No permissions have been created yet</p>
                @if(auth()->user()->hasPermissionTo('permission-create'))
                    <a href="{{ route('admin.permissions.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Create First Permission
                    </a>
                @endif
            </div>
        @endif
    </div>
</div>

<script>
function deletePermission(permissionId, permissionName) {  
    Swal.fire({
        title: 'Delete Permission?',
        html: "Are you sure you want to delete the permission <strong>'" + permissionName + "'</strong>? This action cannot be undone.",
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
            form.action = `/admin/permissions/${permissionId}`;
            
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
