@extends('administrator::layouts.admin')

@section('content')
    <div class="content d-flex justify-content-center align-items-center">


        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="card mb-0">
                <div class="card-body">
                    <div class="text-center mb-3">
                        <i class="icon-reading icon-2x text-slate-300 border-slate-300 border-3 rounded-round p-3 mb-3 mt-1"></i>
                        <h5 class="mb-0">Register to your account</h5>
                        <span class="d-block text-muted">Enter your credentials below</span>
                    </div>

                    <div class="form-group form-group-feedback form-group-feedback-left">
                        <input id="email" type="email"
                               class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                               value="{{ old('email') }}" required>
                        <div class="form-control-feedback">
                            <i class="icon-user text-muted"></i>
                        </div>
                    </div>


                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">
                            {{ __('Send Password Reset Link') }}<i class="icon-circle-right2 ml-2"></i>
                        </button>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <a href="{{route('register')}}">{{ __('Register') }}</a>
                        </div>
                        <div class="col-md-6  text-right">
                            <a href="{{route('login')}}">{{ __('Login') }}</a>
                        </div>
                    </div>

                </div>
            </div>
        </form>
    </div>
@endsection
