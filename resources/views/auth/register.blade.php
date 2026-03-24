@extends('layouts.app')

@section('content')
<div class="auth-container">
    <!-- Background Elements -->
    <div class="auth-background">
        <div class="bg-overlay"></div>
        <div class="floating-elements">
            <div class="floating-element element-1"></div>
            <div class="floating-element element-2"></div>
            <div class="floating-element element-3"></div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="auth-content">
        <div class="auth-card">
            <!-- Logo Section -->
            <div class="auth-header">
                <div class="auth-logo">
                    <i class="fas fa-store"></i>
                    <h2>Create Account</h2>
                </div>
                <p class="auth-subtitle">Join our fresh food community and start ordering today</p>
            </div>

            <!-- Register Form -->
            <div class="auth-form">
                <form method="POST" action="{{ route('register') }}" class="register-form">
                    @csrf

                    <!-- Name Field -->
                    <div class="form-group">
                        <label for="name" class="form-label">
                            <i class="fas fa-user me-2"></i>Full Name
                        </label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-user"></i>
                            </span>
                            <input id="name" type="text" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   name="name" 
                                   value="{{ old('name') }}" 
                                   placeholder="Enter your full name"
                                   required 
                                   autocomplete="name" 
                                   autofocus>
                        </div>
                        @error('name')
                            <div class="invalid-feedback">
                                <i class="fas fa-exclamation-circle me-1"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Email Field -->
                    <div class="form-group">
                        <label for="email" class="form-label">
                            <i class="fas fa-envelope me-2"></i>Email Address
                        </label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-envelope"></i>
                            </span>
                            <input id="email" type="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   name="email" 
                                   value="{{ old('email') }}" 
                                   placeholder="Enter your email address"
                                   required 
                                   autocomplete="email">
                        </div>
                        @error('email')
                            <div class="invalid-feedback">
                                <i class="fas fa-exclamation-circle me-1"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Password Field -->
                    <div class="form-group">
                        <label for="password" class="form-label">
                            <i class="fas fa-lock me-2"></i>Password
                        </label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-lock"></i>
                            </span>
                            <input id="password" type="password" 
                                   class="form-control @error('password') is-invalid @enderror" 
                                   name="password" 
                                   placeholder="Create a strong password"
                                   required 
                                   autocomplete="new-password">
                            <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                <i class="fas fa-eye" id="eyeIcon"></i>
                            </button>
                        </div>
                        @error('password')
                            <div class="invalid-feedback">
                                <i class="fas fa-exclamation-circle me-1"></i>
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="password-strength" id="passwordStrength">
                            <div class="strength-bar">
                                <div class="strength-fill"></div>
                            </div>
                            <small class="strength-text">Password strength</small>
                        </div>
                    </div>

                    <!-- Confirm Password Field -->
                    <div class="form-group">
                        <label for="password-confirm" class="form-label">
                            <i class="fas fa-lock me-2"></i>Confirm Password
                        </label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-lock"></i>
                            </span>
                            <input id="password-confirm" type="password" 
                                   class="form-control @error('password_confirmation') is-invalid @enderror" 
                                   name="password_confirmation" 
                                   placeholder="Confirm your password"
                                   required 
                                   autocomplete="new-password">
                            <button class="btn btn-outline-secondary" type="button" id="toggleConfirmPassword">
                                <i class="fas fa-eye" id="confirmEyeIcon"></i>
                            </button>
                        </div>
                        @error('password_confirmation')
                            <div class="invalid-feedback">
                                <i class="fas fa-exclamation-circle me-1"></i>
                                Passwords must match
                            </div>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-auth">
                            <i class="fas fa-user-plus me-2"></i>
                            <span>Create Account</span>
                            <div class="btn-spinner">
                                <i class="fas fa-spinner fa-spin"></i>
                            </div>
                        </button>
                    </div>

                    <!-- Benefits -->
                    <div class="auth-benefits">
                        <h4>Why join us?</h4>
                        <div class="benefits-grid">
                            <div class="benefit-item">
                                <i class="fas fa-truck"></i>
                                <span>Fast Delivery</span>
                            </div>
                            <div class="benefit-item">
                                <i class="fas fa-percentage"></i>
                                <span>Exclusive Deals</span>
                            </div>
                            <div class="benefit-item">
                                <i class="fab fa-whatsapp"></i>
                                <span>Easy Ordering</span>
                            </div>
                            <div class="benefit-item">
                                <i class="fas fa-shield-alt"></i>
                                <span>Secure Shopping</span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Social Login -->
            <div class="social-login">
                <div class="divider">
                    <span>OR SIGN UP WITH</span>
                </div>
                <div class="social-buttons">
                    <button class="btn btn-outline-primary social-btn">
                        <i class="fab fa-google me-2"></i>
                        Google
                    </button>
                    <button class="btn btn-outline-primary social-btn">
                        <i class="fab fa-facebook-f me-2"></i>
                        Facebook
                    </button>
                </div>
            </div>

            <!-- Login Link -->
            <div class="auth-footer">
                <p>Already have an account? 
                    <a href="{{ route('login') }}" class="login-link">
                        Sign In
                        <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </p>
            </div>
        </div>

        <!-- Side Panel -->
        <div class="auth-side-panel">
            <div class="side-content">
                <h3>Start Your Fresh Food Journey</h3>
                <p>Create your account to unlock exclusive features and start ordering the freshest products delivered to your doorstep.</p>
                
                <div class="features-list">
                    <div class="feature-item">
                        <i class="fas fa-box"></i>
                        <span>Track Orders</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-heart"></i>
                        <span>Save Favorites</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-bell"></i>
                        <span>Get Notifications</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-gift"></i>
                        <span>Loyalty Rewards</span>
                    </div>
                </div>

                <div class="stats-section">
                    <h4>Join 500+ Happy Customers</h4>
                    <div class="stats-grid">
                        <div class="stat-item">
                            <span class="stat-number">24/7</span>
                            <span class="stat-label">Support</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">100%</span>
                            <span class="stat-label">Fresh</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">2hr</span>
                            <span class="stat-label">Delivery</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Auth Container */
.auth-container {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%);
    padding: 2rem 1rem;
    margin-bottom: -80px; /* Account for fixed footer */
}

/* Background Elements */
.auth-background {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    overflow: hidden;
}

.bg-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('https://images.unsplash.com/photo-1590427839957-3fbf7985bca2?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1920&q=80') center/cover;
    opacity: 0.1;
}

.floating-elements {
    position: absolute;
    width: 100%;
    height: 100%;
}

.floating-element {
    position: absolute;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.1);
    animation: float 6s ease-in-out infinite;
}

.element-1 {
    width: 80px;
    height: 80px;
    top: 20%;
    left: 10%;
    animation-delay: 0s;
}

.element-2 {
    width: 120px;
    height: 120px;
    top: 60%;
    right: 10%;
    animation-delay: 2s;
}

.element-3 {
    width: 60px;
    height: 60px;
    bottom: 20%;
    left: 50%;
    animation-delay: 4s;
}

@keyframes float {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(-20px) rotate(180deg); }
}

/* Main Content */
.auth-content {
    display: grid;
    grid-template-columns: 1fr 1fr;
    max-width: 1200px;
    width: 100%;
    background: white;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
    position: relative;
    z-index: 1;
}

/* Auth Card */
.auth-card {
    padding: 3rem;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.auth-header {
    text-align: center;
    margin-bottom: 2rem;
}

.auth-logo {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 1rem;
    margin-bottom: 1rem;
}

.auth-logo i {
    font-size: 2.5rem;
    color: var(--accent-color);
}

.auth-logo h2 {
    font-size: 1.8rem;
    font-weight: 700;
    color: var(--text-primary);
    margin: 0;
}

.auth-subtitle {
    color: var(--text-secondary);
    font-size: 1rem;
    margin: 0;
}

/* Form Styles */
.auth-form {
    margin-bottom: 2rem;
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-label {
    font-weight: 600;
    color: var(--text-primary);
    margin-bottom: 0.5rem;
    display: block;
}

.input-group {
    position: relative;
}

.input-group-text {
    background: var(--gray-50);
    border: 2px solid var(--border-color);
    border-right: none;
    color: var(--text-secondary);
}

.form-control {
    border: 2px solid var(--border-color);
    border-left: none;
    padding: 0.875rem 1rem;
    font-size: 0.95rem;
    transition: all 0.3s ease;
}

.form-control:focus {
    border-color: var(--accent-color);
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

.form-control.is-invalid {
    border-color: var(--danger-color);
}

.invalid-feedback {
    color: var(--danger-color);
    font-size: 0.875rem;
    margin-top: 0.5rem;
    display: flex;
    align-items: center;
}

#togglePassword, #toggleConfirmPassword {
    border: 2px solid var(--border-color);
    border-left: none;
    background: var(--gray-50);
}

/* Password Strength Indicator */
.password-strength {
    margin-top: 0.5rem;
}

.strength-bar {
    height: 4px;
    background: var(--gray-200);
    border-radius: 2px;
    overflow: hidden;
    margin-bottom: 0.25rem;
}

.strength-fill {
    height: 100%;
    width: 0;
    transition: all 0.3s ease;
    border-radius: 2px;
}

.strength-text {
    color: var(--text-muted);
    font-size: 0.75rem;
}

/* Submit Button */
.btn-auth {
    width: 100%;
    padding: 1rem;
    font-size: 1rem;
    font-weight: 600;
    border-radius: 10px;
    background: linear-gradient(135deg, var(--accent-color), var(--accent-light));
    border: none;
    color: white;
    position: relative;
    overflow: hidden;
    transition: all 0.3s ease;
}

.btn-auth:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(59, 130, 246, 0.3);
}

.btn-spinner {
    display: none;
}

.btn-auth:disabled .btn-spinner {
    display: inline-block;
}

/* Auth Benefits */
.auth-benefits {
    margin-top: 2rem;
    padding: 1.5rem;
    background: var(--gray-50);
    border-radius: 12px;
    border: 1px solid var(--border-color);
}

.auth-benefits h4 {
    font-size: 1rem;
    font-weight: 600;
    color: var(--text-primary);
    margin-bottom: 1rem;
    text-align: center;
}

.benefits-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
}

.benefit-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.875rem;
    color: var(--text-secondary);
}

.benefit-item i {
    color: var(--accent-color);
    font-size: 1rem;
}

/* Social Login */
.social-login {
    margin: 2rem 0;
}

.divider {
    text-align: center;
    position: relative;
    margin: 1.5rem 0;
}

.divider::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 0;
    right: 0;
    height: 1px;
    background: var(--border-color);
}

.divider span {
    background: white;
    padding: 0 1rem;
    color: var(--text-secondary);
    font-size: 0.875rem;
}

.social-buttons {
    display: flex;
    gap: 1rem;
}

.social-btn {
    flex: 1;
    padding: 0.75rem;
    border-radius: 8px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.social-btn:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
}

/* Auth Footer */
.auth-footer {
    text-align: center;
    margin-top: 2rem;
    padding-top: 2rem;
    border-top: 1px solid var(--border-color);
}

.auth-footer p {
    color: var(--text-secondary);
    margin: 0;
}

.login-link {
    color: var(--accent-color);
    text-decoration: none;
    font-weight: 600;
    transition: color 0.3s ease;
}

.login-link:hover {
    color: var(--accent-light);
    text-decoration: underline;
}

/* Side Panel */
.auth-side-panel {
    background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
    padding: 3rem;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
}

.side-content h3 {
    font-size: 1.5rem;
    font-weight: 700;
    margin-bottom: 1rem;
}

.side-content p {
    margin-bottom: 2rem;
    opacity: 0.9;
    line-height: 1.6;
}

.features-list {
    margin-bottom: 2rem;
}

.feature-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1rem;
    padding: 0.75rem;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 8px;
    backdrop-filter: blur(10px);
}

.feature-item i {
    font-size: 1.2rem;
}

/* Stats Section */
.stats-section {
    background: rgba(255, 255, 255, 0.1);
    padding: 1.5rem;
    border-radius: 12px;
    backdrop-filter: blur(10px);
}

.stats-section h4 {
    font-size: 1rem;
    margin-bottom: 1rem;
    opacity: 0.9;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1rem;
    text-align: center;
}

.stat-item {
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
}

.stat-number {
    font-size: 1.25rem;
    font-weight: 700;
}

.stat-label {
    font-size: 0.75rem;
    opacity: 0.8;
}

/* Responsive Design */
@media (max-width: 992px) {
    .auth-content {
        grid-template-columns: 1fr;
        max-width: 500px;
    }
    
    .auth-side-panel {
        display: none;
    }
    
    .auth-card {
        padding: 2rem;
    }
    
    .social-buttons {
        flex-direction: column;
    }
    
    .benefits-grid {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 576px) {
    .auth-container {
        padding: 1rem;
        margin-bottom: -80px;
    }
    
    .auth-card {
        padding: 1.5rem;
    }
    
    .auth-logo h2 {
        font-size: 1.5rem;
    }
    
    .floating-element {
        display: none;
    }
    
    .auth-benefits {
        padding: 1rem;
    }
}

/* Fixed Footer Adjustment */
body {
    padding-bottom: 80px; /* Account for fixed footer */
}

.footer {
    position: fixed;
    bottom: 0;
    left: 0;
    right: 0;
    z-index: 1000;
}
</style>

<script>
// Toggle password visibility
document.getElementById('togglePassword')?.addEventListener('click', function() {
    const passwordInput = document.getElementById('password');
    const eyeIcon = document.getElementById('eyeIcon');
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        eyeIcon.classList.remove('fa-eye');
        eyeIcon.classList.add('fa-eye-slash');
    } else {
        passwordInput.type = 'password';
        eyeIcon.classList.remove('fa-eye-slash');
        eyeIcon.classList.add('fa-eye');
    }
});

document.getElementById('toggleConfirmPassword')?.addEventListener('click', function() {
    const confirmPasswordInput = document.getElementById('password-confirm');
    const confirmEyeIcon = document.getElementById('confirmEyeIcon');
    
    if (confirmPasswordInput.type === 'password') {
        confirmPasswordInput.type = 'text';
        confirmEyeIcon.classList.remove('fa-eye');
        confirmEyeIcon.classList.add('fa-eye-slash');
    } else {
        confirmPasswordInput.type = 'password';
        confirmEyeIcon.classList.remove('fa-eye-slash');
        confirmEyeIcon.classList.add('fa-eye');
    }
});

// Password strength checker
document.getElementById('password')?.addEventListener('input', function() {
    const password = this.value;
    const strengthFill = document.querySelector('.strength-fill');
    const strengthText = document.querySelector('.strength-text');
    
    let strength = 0;
    
    if (password.length >= 8) strength++;
    if (password.match(/[a-z]+/)) strength++;
    if (password.match(/[A-Z]+/)) strength++;
    if (password.match(/[0-9]+/)) strength++;
    if (password.match(/[$@#&!]+/)) strength++;
    
    const strengthPercentage = (strength / 5) * 100;
    strengthFill.style.width = strengthPercentage + '%';
    
    if (strength <= 2) {
        strengthFill.style.background = '#ef4444';
        strengthText.textContent = 'Weak password';
    } else if (strength <= 3) {
        strengthFill.style.background = '#f59e0b';
        strengthText.textContent = 'Medium password';
    } else {
        strengthFill.style.background = '#10b981';
        strengthText.textContent = 'Strong password';
    }
});

// Form submission loading state
document.querySelector('.register-form')?.addEventListener('submit', function() {
    const submitBtn = this.querySelector('.btn-auth');
    submitBtn.disabled = true;
    submitBtn.querySelector('.btn-spinner').style.display = 'inline-block';
    submitBtn.querySelector('span').textContent = 'Creating account...';
});
</script>
@endsection
