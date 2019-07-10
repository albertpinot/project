@extends('layouts.app')

@section('content')
<div class="containerForm">
    <div class="contentFormLog">
        <img class="logoLogin" src="/img/logo.svg" />
        <hr/>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group row">
                <div class="col-md-6">
                <a class="linkLog" href="/register" data-pjax>Do you have not an account ? Register !</a>
                    <input class="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Email" required autofocus>
                    <br/>
                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            

            <div class="form-group row">
                <div class="col-md-6">
                    <input class="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required>

                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <div class="col-md-6 offset-md-4">
                    <div class="form-check">
                        <label class="form-check-label" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                        <input class="chekbox" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>                        
                    </div>
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-8 offset-md-4">
                    <button type="submit" class="BtLog">
                        {{ __('Login') }}
                    </button><br/>

                    @if (Route::has('password.request'))
                        <a class="linkLog" href="{{ route('password.request') }}" data-pjax>
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                </div>
            </div>
        </form>
    </div>      
</div>
@endsection
