<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ __('Login') }} – {{ config('app.name', 'Laravel') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .auth-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>
<body>
    <div class="auth-wrapper">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-5">
                    <div class="card shadow-sm">
                        <div class="card-header bg-white fw-semibold">{{ __('Login') }}</div>
                        <div class="card-body p-4">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="mb-3">
                                    <label for="email" class="form-label">{{ __('Email Address') }}</label>
                                    <input id="email" type="email"
                                           class="form-control @error('email') is-invalid @enderror"
                                           name="email" value="{{ old('email') }}"
                                           required autocomplete="email" autofocus>
                                    @error('email')
                                        <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">{{ __('Password') }}</label>
                                    <input id="password" type="password"
                                           class="form-control @error('password') is-invalid @enderror"
                                           name="password" required autocomplete="current-password">
                                    @error('password')
                                        <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="remember">{{ __('Remember Me') }}</label>
                                    </div>
                                </div>

                                <div class="d-flex align-items-center justify-content-between">
                                    <button type="submit" class="btn btn-primary px-4">{{ __('Login') }}</button>
                                    {{-- @if (Route::has('password.request'))
                                        <a class="btn btn-link text-decoration-none" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif --}}
                                </div>

                                @if (Route::has('register'))
                                    <hr>
                                    <p class="text-center text-muted mb-0 small">
                                        Don't have an account?
                                        <a href="{{ route('register') }}">Register</a>
                                    </p>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
