<x-guest-layout>
    <div class="login-page-wrapper">
        <div class="login-container shadow-sm border">
            {{-- Dynamic Logo --}}
            <div class="login-logo text-center mb-4" style="text-align: center;">
                @if (!empty($siteSettings['site_logo']))
                    <img src="{{ asset($siteSettings['site_logo']) }}" alt="{{ $siteSettings['site_name'] ?? 'Logo' }}">
                @else
                    <h3 class="mb-0 text-primary">{{ $siteSettings['site_name'] ?? 'Login' }}</h3>
                @endif
            </div>

            <div class="login-header text-center">
                <h3 class="fw-bold mb-1">Welcome Back</h3>
                <p class="text-muted mb-4">Please enter your details to sign in.</p>
            </div>

            <x-validation-errors class="mb-4" />

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group-login mb-3">
                    <label for="email" class="form-label fw-semibold">Email Address</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus class="form-control-login" placeholder="name@example.com">
                </div>

                <div class="form-group-login mb-3">
                    <label for="password" class="form-label fw-semibold">Password</label>
                    <input id="password" type="password" name="password" required class="form-control-login" placeholder="••••••••">
                </div>

                <div class="checkbox-group mb-4">
                    <label class="d-flex align-items-center">
                        <input type="checkbox" name="remember" id="remember_me" class="me-2">
                        <span>Remember me</span>
                    </label>
                </div>

                <button type="submit" class="btn submit-btn w-100 py-2 fw-bold">Log in</button>
            </form>
        </div>
    </div>
</x-guest-layout>

<style>
    .login-page-wrapper {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f8f9fa;
        padding: 20px;
    }

    .login-container {
        background: #fff;
        padding: 40px;
        border-radius: 12px;
        width: 100%;
        max-width: 420px;
    }

    .login-logo img {
        max-height: 70px;
        width: auto;
    }

    .form-control-login {
        width: 100%;
        padding: 12px;
        border: 1px solid #ced4da;
        border-radius: 6px;
    }

    .form-control-login:focus {
        border-color: #00acc1;
        box-shadow: 0 0 0 0.25rem rgba(0, 172, 193, 0.25);
    }

    .btn-primary {
        background-color: #00acc1 !important;
        border-color: #00acc1 !important;
        transition: 0.3s;
    }

    .btn-primary:hover {
        background-color: #008c9e !important;
    }

    .login-header {
        margin-bottom: 30px;
        /* Better spacing after header */
        text-align: center;
    }

    .login-header h3 {
        font-size: 24px;
        margin-bottom: 8px;
        color: #222;
    }

    .login-header p {
        color: #888;
        font-size: 14px;
        margin-bottom: 0;
    }

    .form-group-login {
        margin-bottom: 20px;
        margin-right: 30px;
        /* More breathing room between inputs */
    }

    .form-group-login label {
        display: block;
        margin-bottom: 8px;
        font-size: 14px;
        font-weight: 500;
        color: #555;
    }

    .form-group-login input {
        width: 100%;
        padding: 14px 16px;
        /* Optimized input padding */
        border: 1px solid #e1e1e1;
        border-radius: 8px;
        outline: none;
        transition: all 0.3s ease;
    }

    .form-group-login input:focus {
        border-color: #00acc1;
        box-shadow: 0 0 0 3px rgba(0, 172, 193, 0.1);
    }

    .checkbox-group {
        margin-bottom: 25px;
        font-size: 14px;
        color: #666;
    }

    .submit-btn {
        width: 100%;
        padding: 14px;
        background: #00acc1;
        color: #fff;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        font-size: 16px;
        cursor: pointer;
        transition: background 0.3s;
    }

    .submit-btn:hover {
        background: #008c9e;
    }
</style>
