@extends('layouts.app')

@section('title', 'Edit Profile')
@section('page-title', 'Edit Profile')

@section('content')
<link href="{{ asset('css/admin-common.css') }}" rel="stylesheet">
<div class="container-standard">
    <div class="card-standard">
        <div class="card-header-standard">
            <div class="header-left">
                <h4 class="card-title-standard">
                    <i class="fas fa-user-edit me-2"></i>Edit Profile
                </h4>
                <p class="card-subtitle-standard">Update your personal information</p>
            </div>
            <div class="header-right">
                <a href="{{ url('/') }}" class="btn btn-secondary">
                    <i class="fas fa-home me-1"></i>Back to Home
                </a>
            </div>
        </div>
        <div class="card-body-standard">
            <form action="{{ route('profile.update') }}" method="POST">
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
                                   value="{{ old('name', auth()->user()->name) }}" 
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
                                   value="{{ old('email', auth()->user()->email) }}" 
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
                                   value="{{ old('phone', auth()->user()->phone) }}" 
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
                                   value="{{ old('address', auth()->user()->address) }}" 
                                   placeholder="Enter address">
                            @error('address')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Password Change -->
                    <div class="form-row">
                        <div class="form-group-half">
                            <label for="current_password" class="form-label-standard">
                                Current Password
                            </label>
                            <input type="password" 
                                   class="form-control-standard @error('current_password') is-invalid @enderror" 
                                   id="current_password" 
                                   name="current_password" 
                                   placeholder="Enter current password to confirm changes">
                            @error('current_password')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group-half">
                            <label for="password" class="form-label-standard">
                                New Password
                            </label>
                            <input type="password" 
                                   class="form-control-standard @error('password') is-invalid @enderror" 
                                   id="password" 
                                   name="password" 
                                   placeholder="Enter new password (leave blank to keep current)">
                            @error('password')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group-half">
                            <label for="password_confirmation" class="form-label-standard">
                                Confirm New Password
                            </label>
                            <input type="password" 
                                   class="form-control-standard @error('password_confirmation') is-invalid @enderror" 
                                   id="password_confirmation" 
                                   name="password_confirmation" 
                                   placeholder="Confirm new password">
                            @error('password_confirmation')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group-half">
                            <div class="info-box">
                                <i class="fas fa-info-circle"></i>
                                <small>
                                    Leave password fields empty if you don't want to change your password. 
                                    If you want to change password, you must enter your current password.
                                </small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Update Profile
                    </button>
                    <a href="{{ url('/') }}" class="btn btn-secondary">
                        <i class="fas fa-times me-2"></i>Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

@if(session('success'))
    <div class="success-toast">
        <i class="fas fa-check-circle"></i>
        {{ session('success') }}
    </div>
@endif
@endsection
