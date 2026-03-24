@extends('layouts.admin')

@use(Illuminate\Support\Str)

@section('title', 'Manage Users - Admin')
@section('page-title', '')

@section('content')
<!-- Breadcrumb -->
{{-- <div class="breadcrumb-section mb-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.dashboard') }}" class="breadcrumb-link">
                    <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                <i class="fas fa-users me-2"></i>Users
            </li>
        </ol>
    </nav>
</div> --}}

<!-- Users List -->
<div class="content-card">
    <div class="content-card-header">
        <h5 class="content-card-title">
            <i class="fas fa-users me-2"></i>Users
            <span class="badge bg-secondary ms-2">{{ $users->total() }} total</span>
        </h5>
        <div class="header-actions">
            <span class="text-muted small">
                <i class="fas fa-info-circle me-1"></i>
                Only Super Admins can manage users
            </span> 
        </div>
    </div>
    <div class="content-card-body">
        @if($users->count() > 0)
            <div class="table-responsive">
                <table class="modern-table">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Roles</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>
                                    <div class="user-info">
                                        <div class="user-details">
                                            <div class="user-name">{{ $user->name }}</div>
                                            <div class="user-id small text-muted">ID: {{ $user->id }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="email-info">
                                        <div class="email-address">{{ $user->email }}</div>
                                        @if($user->email_verified_at)
                                            <div class="verified-badge small text-success">
                                                <i class="fas fa-check-circle me-1"></i>Verified
                                            </div>
                                        @else
                                            <div class="unverified-badge small text-warning">
                                                <i class="fas fa-exclamation-circle me-1"></i>Not Verified
                                            </div>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    @if($user->phone)
                                        <div class="phone-info">
                                            <i class="fas fa-phone me-1 text-muted"></i>
                                            {{ $user->phone }}
                                        </div>
                                    @else
                                        <span class="text-muted">Not provided</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="roles-container">
                                        @foreach($user->roles as $role)
                                            <span class="role-badge role-{{ Str::slug($role->name) }}">
                                                <i class="fas fa-{{ $role->name == 'Super Admin' ? 'crown' : ($role->name == 'Admin' ? 'user-shield' : 'user') }} me-1"></i>
                                                {{ $role->name }}
                                            </span>
                                        @endforeach
                                    </div>
                                </td>
                                <td>
                                    @if($user->id === auth()->id())
                                        <span class="current-user-badge">
                                            <i class="fas fa-user me-1"></i>You
                                        </span>
                                    @else
                                        <span class="status-badge status-{{ $user->is_active ? 'active' : 'inactive' }}">
                                            {{ $user->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    @endif
                                </td>
                                 @if(auth()->user()->hasRole('Super Admin'))
                                    <td>
                                        <div class="action-buttons">
                                            <a href="{{ route('admin.users.edit', $user) }}" 
                                               class="btn btn-sm btn-outline-primary"
                                               data-tooltip="Edit User">
                                                <i class="fas fa-edit"></i>
                                            </a>     
                                            @if($user->id !== auth()->id())
                                                <button type="button" 
                                                        class="btn btn-sm btn-outline-danger" 
                                                        onclick="deleteUser({{ $user->id }})"
                                                        data-tooltip="Delete User">
                                                    <i class="fas fa-trash"></i>
                                                </button> 
                                            @endif
                                        </div> 
                                    </td>
                                @endif
                                
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- Simple Pagination -->
            <div class="simple-pagination">
                <div class="pagination-info">
                    Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} users
                </div>
                <div class="pagination-links">
                    @if($users->hasPages())
                        <!-- First Page -->
                        @if($users->currentPage() > 1)
                            <a href="{{ $users->url(1) }}" class="pagination-link">
                                <i class="fas fa-angle-double-left"></i>
                            </a>
                        @else
                            <span class="pagination-link disabled">
                                <i class="fas fa-angle-double-left"></i>
                            </span>
                        @endif
                        
                        <!-- Previous Page -->
                        @if($users->currentPage() > 1)
                            <a href="{{ $users->url($users->currentPage() - 1) }}" class="pagination-link">
                                <i class="fas fa-angle-left"></i>
                            </a>
                        @else
                            <span class="pagination-link disabled">
                                <i class="fas fa-angle-left"></i>
                            </span>
                        @endif
                        
                        <!-- Page Numbers -->
                        @if($users->lastPage() <= 7)
                            @for($i = 1; $i <= $users->lastPage(); $i++)
                                <a href="{{ $users->url($i) }}" 
                                   class="pagination-link {{ $i == $users->currentPage() ? 'active' : '' }}">
                                    {{ $i }}
                                </a>
                            @endfor
                        @else
                            <!-- Show current page and surrounding pages -->
                            @php
                                $start = max(1, $users->currentPage() - 2);
                                $end = min($users->lastPage(), $users->currentPage() + 2);
                            @endphp
                            
                            @if($start > 1)
                                <a href="{{ $users->url(1) }}" class="pagination-link">1</a>
                                @if($start > 2)
                                    <span class="pagination-link disabled">...</span>
                                @endif
                            @endif
                            
                            @for($i = $start; $i <= $end; $i++)
                                <a href="{{ $users->url($i) }}" 
                                   class="pagination-link {{ $i == $users->currentPage() ? 'active' : '' }}">
                                    {{ $i }}
                                </a>
                            @endfor
                            
                            @if($end < $users->lastPage())
                                @if($end < $users->lastPage() - 1)
                                    <span class="pagination-link disabled">...</span>
                                @endif
                                <a href="{{ $users->url($users->lastPage()) }}" class="pagination-link">{{ $users->lastPage() }}</a>
                            @endif
                        @endif
                        
                        <!-- Next Page -->
                        @if($users->currentPage() < $users->lastPage())
                            <a href="{{ $users->url($users->currentPage() + 1) }}" class="pagination-link">
                                <i class="fas fa-angle-right"></i>
                            </a>
                        @else
                            <span class="pagination-link disabled">
                                <i class="fas fa-angle-right"></i>
                            </span>
                        @endif
                        
                        <!-- Last Page -->
                        @if($users->currentPage() < $users->lastPage())
                            <a href="{{ $users->url($users->lastPage()) }}" class="pagination-link">
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
                <i class="fas fa-users empty-icon"></i>
                <h6>No users found</h6>
                <p class="text-muted">No users have registered yet</p>
            </div>
        @endif
    </div>
</div>


<script>
// Test if SweetAlert is loaded
console.log('SweetAlert loaded:', typeof Swal !== 'undefined');

function deleteUser(userId) {  
    Swal.fire({
        title: 'Delete User?',
        text: "Are you sure you want to delete this user? This action cannot be undone.",
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
            form.action = `/admin/users/${userId}`;
            
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
