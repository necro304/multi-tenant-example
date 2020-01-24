@extends('system.layout.master')

@section('content')
    <h1 class="mt-3 text-center">Website {{ $hostname->fqdn }}</h1>
    <h2 class="mt-1">Base de datos: {{ $web->uuid }}</h2>
    <div class="card">
        <div class="card-header">Usuarios <i class="fas fa-users"></i></div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>E-mail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $u)
                            <tr>
                                <td>{{ $u->id }}</td>
                                <td>{{ $u->name }}</td>
                                <td>{{ $u->email }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection