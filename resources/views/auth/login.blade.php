@extends('layouts.login')

@section('content')

                    <form id="login-form" action="{{ route('login') }}" method="post" aria-label="{{ __('Login') }}">
                        @csrf
                        <h2 class="login-title">Log in</h2>
                        <div class="row">

                            <div class="col-md-12">

                                <div class="form-group">
                                    <div class="input-group-icon right">
                                        <div class="input-icon"><i class="fa fa-envelope"></i></div>
                                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Ingrese el Correo Eletr&oacute;nico" required autofocus>
                                    </div>
                                </div>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                <div class="input-group-icon right">
                                    <div class="input-icon"><i class="fa fa-lock font-16"></i></div>
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Ingrese la Contrase&ntilde;a" required>
                                </div>
                            </div>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-8">
                                <div class="checkbox icheck">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-xs-4">
                                <button type="submit" class="btn btn-primary btn-block btn-flat">Login</button>
                            </div>
                            <!-- /.col -->
                        </div>



                    </form>

@endsection

@section('script')
<script type="text/javascript">
    $().ready(function() {
        // validate the comment form when it is submitted
        $("#login-form").validate();
    });
</script>
@endsection
