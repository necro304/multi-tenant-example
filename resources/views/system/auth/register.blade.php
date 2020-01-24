@extends('system.layout.master')

@section('content')
    <div class="row justify-content-center align-items-center" style="height: 100vh">
        <div class="card mt-0 " style="width:600px">
            <div class="card-header text-center bg-dark text-white ">Registrarse</div>
            <div class="card-body ">
                <form method="POST" action="{{ route('system.register') }}">
                    @csrf
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" id="name" value="{{ old('name') }}" required autofocus>
                        @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="email">Correo electronico</label>
                        <input name="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" value="{{ old('email') }}" required>
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input name="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" id="password" required>
                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Repetir contraseña</label>
                        <input name="password_confirmation" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" id="password_confirmation" required>
                    </div>
                    <div class="form-group">
                        <label for="subDomain">Sub-dominio</label>
                        <input name="subDomain"  class="form-control{{ $errors->has('subDomain') ? ' is-invalid' : '' }}" id="subDomain"  required>
                        @if ($errors->has('subDomain'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('subDomain') }}</strong>
                        </span>
                        @endif
                    </div>

                    <button class="btn btn-primary btn-block mt-2" type="submit">Registrarse</button>
                </form>
            </div>

        </div>
    </div>

@endsection
