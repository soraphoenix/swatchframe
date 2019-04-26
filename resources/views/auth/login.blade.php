
@extends('layouts/main')

    @section('title')
      Design Storm - Inspiration for developers
    @endsection

    @section('content')
      <div id="site-section">
        <div class="container">
          <div id="auth">
            <div class="row">
              <div class="col-md-offset-4 col-md-4">
                <div class="box">
                  <form method="POST" action="{{ route('login') }}">
                      @csrf

                      <div class="row">
                          <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                          <div class="col-md-12">
                              <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                              @if ($errors->has('email'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('email') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>

                      <div class="row">
                          <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                          <div class="col-md-12">
                              <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                              @if ($errors->has('password'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('password') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>

                      <div class="row">
                          <div class="col-md-12 offset-md-4">
                              <div class="form-check">
                                <div class="col-xs-4">
                                  <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                </div>
                                <div class="col-xs-8">
                                  <label class="form-check-label" for="remember">
                                      {{ __('Remember Me') }}
                                  </label>
                                </div>
                              </div>
                          </div>
                      </div>

                      <div class="row mb-0">
                          <div class="col-md-8 offset-md-4">
                              <button type="submit" class="btn btn-primary">
                                  {{ __('Login') }}
                              </button>

                              <a class="btn btn-link" href="{{ route('password.request') }}">
                                  {{ __('Forgot Your Password?') }}
                              </a>
                              <a class="btn btn-link" href="{{ route('register') }}">
                                  {{ __('Register a New Account') }}
                              </a>
                          </div>
                      </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    @endsection

  </body>
</html>
