<div>
    <div class="container-fluid p-0 uk-background-cover" style="background-image: url(images/univ-bg.jpg);">
        <div class="row">
            <div class="col-lg-7 my-3 mx-auto">
                <div class="uk-card-default" style="background-color: hsla(43, 65%, 89%, 0.74)">
                    <div class="uk-card-header">Login</div>
                    <div class="uk-card-body">
                        <div class="row">
                            <div class="col-lg-4 mx-auto">
                                <img src="images/alveare.png" class="p-2">
                            </div>
                            <div class="col-lg-6 m-auto">
                                <form class="uk-form-stacked" method="POST" action="{{ route('login') }}">
                                    {{ csrf_field() }}

                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <label for="email" class="uk-form-label">E-Mail Address</label>
                                        <input id="email" type="email" class="uk-input" name="email" value="{{ old('email') }}" required autofocus>

                                        @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                

                                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                        <label for="password" class="uk-form-label">Password</label>
                                        <input id="password" type="password" class="uk-input" name="password" required>

                                        @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} class="uk-checkbox"> Remember Me
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="uk-button">
                                            Login
                                        </button>
                                        <a class="uk-button uk-button-text" href="{{ route('password.request') }}">
                                            Forgot Your Password?
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>