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
                    <h2>Kitchen & Meat Store</h2>
                </div>
                <p class="auth-subtitle">Welcome back! Please login to your account</p>
            </div>

            <!-- Login Form -->
            <div class="auth-form">
                <form method="POST" action="{{ route('login') }}" class="login-form">
                    @csrf

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
                                   autocomplete="email" 
                                   autofocus>
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
                                   placeholder="Enter your password"
                                   required 
                                   autocomplete="current-password">
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
                    </div>

                    <!-- Remember Me -->
                    <div class="form-group">
                        <div class="custom-checkbox">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                <span class="checkmark"></span>
                                Remember Me
                            </label>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-auth">
                            <i class="fas fa-sign-in-alt me-2"></i>
                            <span>Login to Account</span>
                            <div class="btn-spinner">
                                <i class="fas fa-spinner fa-spin"></i>
                            </div>
                        </button>
                    </div>

                    <!-- Forgot Password -->
                    @if (Route::has('password.request'))
                        <div class="auth-links">
                            <a href="{{ route('password.request') }}" class="forgot-link">
                                <i class="fas fa-question-circle me-1"></i>
                                Forgot Your Password?
                            </a>
                        </div>
                    @endif
                </form>
            </div>

            <!-- Social Login -->
            <div class="social-login">
                <div class="divider">
                    <span>OR</span>
                </div>
                <div class="social-buttons">
                    <button class="btn btn-outline-primary social-btn">
                        <i class="fab fa-google me-2"></i>
                        Continue with Google
                    </button>
                    <button class="btn btn-outline-primary social-btn">
                        <i class="fab fa-facebook-f me-2"></i>
                        Continue with Facebook
                    </button>
                </div>
            </div>

            <!-- Register Link -->
            <div class="auth-footer">
                <p>Don't have an account? 
                    <a href="{{ route('register') }}" class="register-link">
                        Create Account
                        <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </p>
            </div>
        </div>

        <!-- Side Panel -->
        <div class="auth-side-panel">
            <div class="side-content">
                <h3>Join Our Fresh Food Community</h3>
                <p>Get access to exclusive deals, fresh products, and convenient ordering through WhatsApp.</p>
                
                <div class="features-list">
                    <div class="feature-item">
                        <i class="fas fa-truck"></i>
                        <span>Fast Delivery</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-shield-alt"></i>
                        <span>Quality Guaranteed</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-certificate"></i>
                        <span>Halal Certified</span>
                    </div>
                    <div class="feature-item">
                        <i class="fab fa-whatsapp"></i>
                        <span>Easy Ordering</span>
                    </div>
                </div>

                <div class="testimonials">
                    <div class="testimonial">
                        <div class="testimonial-avatar">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="testimonial-content">
                            <p>"Best online meat store! Fresh products and amazing service."</p>
                            <small>- Sarah Johnson</small>
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
    background: url('https://images.unsplash.com/photo-1603020356471-7531b712d65e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1920&q=80') center/cover;
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

#togglePassword {
    border: 2px solid var(--border-color);
    border-left: none;
    background: var(--gray-50);
}

/* Custom Checkbox */
.custom-checkbox {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.custom-checkbox input[type="checkbox"] {
    display: none;
}

.custom-checkbox .checkmark {
    width: 20px;
    height: 20px;
    border: 2px solid var(--border-color);
    border-radius: 4px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    position: relative;
}

.custom-checkbox input[type="checkbox"]:checked + .checkmark {
    background: var(--accent-color);
    border-color: var(--accent-color);
}

.custom-checkbox input[type="checkbox"]:checked + .checkmark::after {
    content: '✓';
    color: white;
    font-size: 12px;
    font-weight: bold;
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

/* Auth Links */
.auth-links {
    text-align: center;
    margin-top: 1rem;
}

.forgot-link {
    color: var(--accent-color);
    text-decoration: none;
    font-size: 0.9rem;
    transition: color 0.3s ease;
}

.forgot-link:hover {
    color: var(--accent-light);
    text-decoration: underline;
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

.register-link {
    color: var(--accent-color);
    text-decoration: none;
    font-weight: 600;
    transition: color 0.3s ease;
}

.register-link:hover {
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

.testimonials {
    background: rgba(255, 255, 255, 0.1);
    padding: 1.5rem;
    border-radius: 12px;
    backdrop-filter: blur(10px);
}

.testimonial {
    display: flex;
    gap: 1rem;
    align-items: flex-start;
}

.testimonial-avatar {
    width: 40px;
    height: 40px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.testimonial-content p {
    margin: 0 0 0.5rem 0;
    font-style: italic;
}

.testimonial-content small {
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

// Form submission loading state
document.querySelector('.login-form')?.addEventListener('submit', function() {
    const submitBtn = this.querySelector('.btn-auth');
    submitBtn.disabled = true;
    submitBtn.querySelector('.btn-spinner').style.display = 'inline-block';
    submitBtn.querySelector('span').textContent = 'Logging in...';
});
</script>
@endsection
