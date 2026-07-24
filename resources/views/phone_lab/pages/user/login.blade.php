@extends('phone_lab.layouts.app')

@section('title', 'Sign In / Register')

@section('content')
    <main>
        {{-- Breadcrumb Section (කලින් තිබූ පරිදිම) --}}
        <div class="breadcrumb_section">
            <div class="container">
                <ul class="breadcrumb_nav ul_li">
                    <li><a href="{{ route('phone_lab.index') }}">Home</a></li>
                    <li>Register</li>
                </ul>
            </div>
        </div>

        <section class="register_section section_space">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-7">

                        {{-- 💡 Success / Error Messages Alert --}}
                        @if (session('success'))
                            <div class="alert alert-success border-0 shadow-sm mb-4"
                                style="color: green; background-color: #e8f5e9; padding: 15px;">
                                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger border-0 shadow-sm mb-4"
                                style="color: red; background-color: #ffebee; padding: 15px;">
                                <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                            </div>
                        @endif

                        {{-- Tab Navigation --}}
                        <ul class="nav register_tabnav ul_li_center" role="tablist" id="authTabs">
                            <li role="presentation">
                                <button
                                    class="nav-link {{ !session('errors') || !old('_form_type') || old('_form_type') == 'login' ? 'active' : '' }}"
                                    data-bs-toggle="tab" data-bs-target="#signin_tab" type="button" role="tab">
                                    Sign In
                                </button>
                            </li>
                            <li role="presentation">
                                <button class="nav-link {{ old('_form_type') == 'register' ? 'active' : '' }}"
                                    data-bs-toggle="tab" data-bs-target="#signup_tab" type="button" role="tab">
                                    Register
                                </button>
                            </li>
                        </ul>

                        <div class="register_wrap tab-content mt-4">

                            {{-- 1. SIGN IN TAB PANEL --}}
                            <div class="tab-pane fade {{ !session('errors') || !old('_form_type') || old('_form_type') == 'login' ? 'show active' : '' }}"
                                id="signin_tab" role="tabpanel">
                                <form action="{{ route('user.login.submit') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="_form_type" value="login">

                                    <div class="form_item_wrap">
                                        <h3 class="input_title">Email Address*</h3>
                                        <div class="form_item">
                                            <label for="username_input"><i class="fas fa-user"></i></label>
                                            <input id="username_input" type="text" name="username"
                                                placeholder="example@email.com"
                                                value="{{ old('_form_type') == 'login' ? old('username') : '' }}" required>
                                        </div>
                                        @if ($errors->has('username') && old('_form_type') == 'login')
                                            <span class="text-danger d-block mt-1"
                                                style="font-size: 12px; color: red;">{{ $errors->first('username') }}</span>
                                        @endif
                                    </div>

                                    <div class="form_item_wrap">
                                        <h3 class="input_title">Password*</h3>
                                        <div class="form_item">
                                            <label for="password_input"><i class="fas fa-lock"></i></label>
                                            <input id="password_input" type="password" name="password"
                                                placeholder="Password" required>
                                        </div>
                                    </div>

                                    <div class="forget_pass_wrap align-items-center justify-content-between d-flex mb-4">
                                        <div class="checkbox_item m-0">
                                            <input id="remember_checkbox" type="checkbox" name="remember_user">
                                            <label for="remember_checkbox">Remember Me</label>
                                        </div>
                                        <div class="forget_pass">
                                            <a href="#!">Forget Password?</a>
                                        </div>
                                    </div>

                                    <div class="text-start">
                                        <button type="submit" class="btn btn_secondary w-100">Sign In Now</button>

                                        <div class="or-divider d-flex align-items-center my-3">
                                            <div class="flex-grow-1 border-bottom border-secondary-subtle"></div>
                                            <span class="px-3 text-muted fw-semibold text-uppercase"
                                                style="font-size: 12px; letter-spacing: 1px;">OR</span>
                                            <div class="flex-grow-1 border-bottom border-secondary-subtle"></div>
                                        </div>

                                        <a href="{{ route('auth.google') }}" class="btn btn-google" role="button"
                                            style="text-decoration: none; display: flex; align-items: center; justify-content: center;">
                                            <img class="g-icon" src="/assets/images/google.png" alt="Google"
                                                style="width: 20px; margin-right: 10px;">
                                            Login with Google
                                        </a>
                                    </div>
                                </form>
                            </div>

                            {{-- 2. SIGN UP / REGISTER TAB PANEL --}}
                            <div class="tab-pane fade {{ old('_form_type') == 'register' ? 'show active' : '' }}"
                                id="signup_tab" role="tabpanel">
                                <form action="{{ route('user.register.submit') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="_form_type" value="register">

                                    <div class="form_item_wrap">
                                        <h3 class="input_title">User Name*</h3>
                                        <div class="form_item">
                                            <label for="username_input2"><i class="fas fa-user"></i></label>
                                            <input id="username_input2" type="text" name="username"
                                                placeholder="Full Name"
                                                value="{{ old('_form_type') == 'register' ? old('username') : '' }}"
                                                required>
                                        </div>
                                        @if ($errors->has('username') && old('_form_type') == 'register')
                                            <span class="text-danger d-block mt-1"
                                                style="font-size: 12px; color: red;">{{ $errors->first('username') }}</span>
                                        @endif
                                    </div>

                                    <div class="form_item_wrap">
                                        <h3 class="input_title">Email*</h3>
                                        <div class="form_item">
                                            <label for="email_input"><i class="fas fa-envelope"></i></label>
                                            <input id="email_input" type="email" name="email"
                                                placeholder="Email Address" value="{{ old('email') }}" required>
                                        </div>
                                        @if ($errors->has('email'))
                                            <span class="text-danger d-block mt-1"
                                                style="font-size: 12px; color: red;">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>

                                    <div class="form_item_wrap">
                                        <h3 class="input_title">Mobile*</h3>
                                        <div class="form_item">
                                            <label for="mobile_input"><i class="fas fa-mobile"></i></label>
                                            <input id="mobile_input"
       type="tel"
       name="mobile"
       placeholder="07XXXXXXXX"
       value="{{ old('mobile') }}"
       pattern="[0-9]{10}"
       maxlength="15"
       minlength="10"
       oninput="this.value=this.value.replace(/[^0-9]/g,'').slice(0,15)"
       required>
                                        </div>
                                        @if ($errors->has('mobile'))
                                            <span class="text-danger d-block mt-1"
                                                style="font-size: 12px; color: red;">{{ $errors->first('mobile') }}</span>
                                        @endif
                                    </div>

                                    <div class="form_item_wrap">
                                        <h3 class="input_title">Password*</h3>
                                        <div class="form_item">
                                            <label for="password_input2"><i class="fas fa-lock"></i></label>
                                            <input id="password_input2" type="password" name="password"
                                                placeholder="Minimum 6 characters" required>
                                        </div>
                                        @if ($errors->has('password') && old('_form_type') == 'register')
                                            <span class="text-danger d-block mt-1"
                                                style="font-size: 12px; color: red;">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>

                                    <div class="text-start">
                                        <button type="submit" class="btn btn_secondary w-100">Register Now</button>

                                        <div class="or-divider d-flex align-items-center my-3">
                                            <div class="flex-grow-1 border-bottom border-secondary-subtle"></div>
                                            <span class="px-3 text-muted fw-semibold text-uppercase"
                                                style="font-size: 12px; letter-spacing: 1px;">OR</span>
                                            <div class="flex-grow-1 border-bottom border-secondary-subtle"></div>
                                        </div>

                                        <a href="{{ route('auth.google') }}" class="btn btn-google" role="button"
                                            style="text-decoration: none; display: flex; align-items: center; justify-content: center;">
                                            <img class="g-icon" src="/assets/images/google.png" alt="Google"
                                                style="width: 20px; margin-right: 10px;">
                                            Login with Google
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </main>

    <style>
        .btn-google {
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            gap: 10px !important;
            background: #00000006 !important;
            color: #000000 !important;
            border: 1px solid #0000001a !important;
        }

        .btn-google:hover {
            background: #00000009 !important;
            color: #000000 !important;
            transform: translateY(-1px) !important;
        }
    </style>

    {{-- 💡 Bootstrap Tab Validation Persistence Handler Script --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var triggerEl = document.querySelector('#authTabs button.active');
            if (triggerEl) {
                var tab = new bootstrap.Tab(triggerEl);
                tab.show();
            }
        });
    </script>
@endsection
