@extends('system.layout.master')

@section('content')
    <div class="row justify-content-center align-items-center" style="height: 100vh">
        <div class="card" style="width: 600px">
            <div class="card-header text-center">Ingresar (solo administadores)</div>
            <div class="card-body p-2">
                <form method="post" action="{{route('system.login')}}">
                    @csrf
                    <div class="form-group">
                        <label for="email">Correo electronico</label>
                        <input name="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" value="{{ old('email') }}">
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input name="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" id="password">
                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                        @endif
                    </div>

                    <button class="btn btn-primary btn-block" type="submit">Ingresar</button>
                </form>
            </div>

        </div>
    </div>

@endsection
