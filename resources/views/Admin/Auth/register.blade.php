@extends('administrator::layouts.admin')

@section('content')
    <div class="content d-flex justify-content-center align-items-center">

        <!-- Login form -->
        <form method="POST" class="login-form" action="{{ route('register') }}">
            @csrf
            <div class="card mb-0">
                <div class="card-body">

                    <div class="text-center mb-3">
                        <i class="icon-reading icon-2x text-slate-300 border-slate-300 border-3 rounded-round p-3 mb-3 mt-1"></i>
                        <h5 class="mb-0">Register to your account</h5>
                        <span class="d-block text-muted">Enter your credentials below</span>
                    </div>

                    <div class="form-group form-group-feedback form-group-feedback-left">
                        <input id="firstname" type="text"
                               class="form-control {{ $errors->has('firstname') ? ' is-invalid' : '' }}"
                               placeholder="{{ __('Firstname') }}" name="firstname" value="{{ old('firstname') }}" required autofocus>
                        <div class="form-control-feedback">
                            <i class="icon-user text-muted"></i>
                        </div>
                    </div>

                    <div class="form-group form-group-feedback form-group-feedback-left">
                        <input id="lastname" type="text"
                               class="form-control {{ $errors->has('lastname') ? ' is-invalid' : '' }}"
                               placeholder="{{ __('Lastname') }}" name="lastname" value="{{ old('lastname') }}" required>
                        <div class="form-control-feedback">
                            <i class="icon-user text-muted"></i>
                        </div>
                    </div>

                    <div class="form-group form-group-feedback form-group-feedback-left">
                        <input id="email" type="email"
                               class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"
                               placeholder="{{ __('E-Mail Address') }}" name="email" value="{{ old('email') }}" required autofocus>
                        <div class="form-control-feedback">
                            <i class="icon-user text-muted"></i>
                        </div>
                    </div>

                    <div class="form-group form-group-feedback form-group-feedback-left">
                        <input id="password" type="password"
                               class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}"
                               name="password" placeholder="{{ __('Password') }}" required>
                        <div class="form-control-feedback">
                            <i class="icon-lock2 text-muted"></i>
                        </div>
                    </div>

                    <div class="form-group form-group-feedback form-group-feedback-left">
                        <input id="password-confirm" type="password"
                               class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}"
                               name="password_confirmation" placeholder="{{ __('Confirm Password') }}" required>
                        <div class="form-control-feedback">
                            <i class="icon-lock2 text-muted"></i>
                        </div>
                    </div>

                    <div class="form-group form-group-feedback form-group-feedback-left">
                        <input id="phone" type="phone"
                               class="form-control {{ $errors->has('Phone') ? ' is-invalid' : '' }}"
                               placeholder="{{ __('Phone') }}" name="phone" value="{{ old('phone') }}">
                        <div class="form-control-feedback">
                            <i class="icon-user text-muted"></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">
                            {{ __('Register') }}<i class="icon-circle-right2 ml-2"></i>
                        </button>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <a href="{{route('login')}}">{{ __('Login') }}</a>
                        </div>
                        <div class="col-md-6 text-right">
                            <a href="{{route('password.request')}}">{{ __('Recovery') }}</a>
                        </div>

                    </div>

                </div>
            </div>
        </form>
        <!-- /login form -->

    </div>
@endsection