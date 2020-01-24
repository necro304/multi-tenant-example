@extends('system.layout.master')

@section('content')

    <h1 class="mt-5 text-center">Sistema de demostración</h1>

    <div class="text-center mt-5">
        <img class="text-center img-responsive" src="https://laraveldaily.com/wp-content/uploads/2019/02/simple-laravel-multi-tenancy.png" alt="sistem"><br>


        <a href="{{ route('formRegister.system') }}" class="btn btn-primary mt-3">Comenzar</a>
    </div>


@endsection