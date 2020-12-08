@extends('layouts.auth.default')
@section('content')
    <div class="card-body login-card-body">
        <div class="card-body login-card-body">
            <p class="login-box-msg">{{__('auth.login_title')}}</p>

            <form action="{{ url('/login') }}" method="post">
                {!! csrf_field() !!}

                <div class="input-group mb-3">
                    <input value="{{ old('email') }}" type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" placeholder="{{ __('auth.email') }}" aria-label="{{ __('auth.email') }}">
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                    </div>
                    @if ($errors->has('email'))
                        <div class="invalid-feedback">
                            {{ $errors->first('email') }}
                        </div>
                    @endif
                </div>

                <div class="input-group mb-3">
                    <input value="{{ old('password') }}" type="password" class="form-control  {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="{{__('auth.password')}}" aria-label="{{__('auth.password')}}">
                    <div class="input-group-append">
                        <span class="input-group-text"><i class="fa fa-lock"></i></span>
                    </div>
                    @if ($errors->has('password'))
                        <div class="invalid-feedback">
                            {{ $errors->first('password') }}
                        </div>
                    @endif
                </div>

                <div class="row mb-2">
                    <div class="col-8">
                        <div class="checkbox icheck">
                            <label> <input type="checkbox" name="remember"> {{__('auth.remember_me')}}
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">{{__('auth.login')}}</button>
                    </div>
                    <!-- /.col -->
                </div>
@if(env('APP_DEMO',false))
                <div class="row mb-2">
                    <div class="col-12 callout callout-success">
                        <h6 class="text-bold">Admin</h6>
                        <p><small>User: admin@demo.com | Password: 123456</small></p>
                    </div>
                    <!-- /.col -->
                </div>
                <div class="row mb-2">
                    <div class="col-12 callout callout-warning">
                        <h6 class="text-bold">Manager</h6>
                        <p><small>User: manager@demo.com | Password: 123456</small></p>
                    </div>
                    <!-- /.col -->
                </div>
                <div class="row mb-2">
                    <div class="col-12 callout callout-danger">
                        <h6 class="text-bold">Client</h6>
                        <p><small>User: client@demo.com | Password: 123456</small></p>
                    </div>
                    <!-- /.col -->
                </div>
@endif

            </form>

            @if(setting('enable_facebook',false) || setting('enable_google',false) || setting('enable_twitter',false))
                <div class="social-auth-links text-center mb-3">
                    <p style="text-transform: uppercase">- {{__('lang.or')}} -</p>
                    @if(setting('enable_facebook',false))
                        <a href="{{url('login/facebook')}}" class="btn btn-block btn-facebook">
                            <i class="fa fa-facebook mr-2"></i> {{__('auth.login_facebook')}}
                        </a>
                    @endif
                    @if(setting('enable_google',false))
                        <a href="{{url('login/google')}}" class="btn btn-block btn-google"> <i class="fa fa-google-plus mr-2"></i> {{__('auth.login_google')}}
                        </a>
                    @endif
                    @if(setting('enable_twitter',false))
                        <a href="{{url('login/twitter')}}" class="btn btn-block btn-twitter"> <i class="fa fa-twitter mr-2"></i> {{__('auth.login_twitter')}}
                        </a>
                    @endif
                </div>
                <!-- /.social-auth-links -->
            @endif

            <p class="mb-1 text-center">
                <a href="{{ url('/password/reset') }}">{{__('auth.forgot_password')}}</a>
            </p>
            <p class="mb-0 text-center">
                <a href="{{ url('/register') }}" class="text-center">{{__('auth.register_new_member')}}</a>
            </p>
        </div>
    </div>
@endsection


