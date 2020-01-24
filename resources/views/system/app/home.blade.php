@extends('system.layout.master')

@section('content')

    <h1 class="mt-5 text-center">Clientes inquilinos</h1>

    <div class="card p-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>Subdomain</th>
                            <th>Creado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($subdomains as $s)

                            <tr>
                                <td>{{$s->id}}</td>
                                <td>{{$s->fqdn}}</td>
                                <td>{{$s->created_at}}</td>
                                <td>
                                    <a href="{{ route('system.website', ['$id' => $s->id]) }}">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>

@endsection