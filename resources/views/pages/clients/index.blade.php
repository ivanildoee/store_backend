@extends('layout.layout')
@section('title', 'Clientes')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <form action="{{ route('clients.index') }}" method="POST">
                            @csrf
                            @method('GET')
                            <div class="input-group input-group-sm" style="width: 400px;">
                                <input type="text" name="search" class="form-control float-right" placeholder="Procurar">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>

                            </div>
                        </form>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-sm btn-outline-primary" href="{{ route('clients.create') }}"> <i
                                class="fas fa-plus-circle"></i> Cliente</a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th style="width: 10px">ID</th>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Telefone</th>
                                <th>País</th>
                                <th>Cidade</th>
                                <th>Endereço</th>
                                <th style="width: 40px">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->phone_number }}</td>
                                    <td>{{ $item->country }}</td>
                                    <td>{{ $item->city }}</td>
                                    <td>{{ $item->address }}</td>

                                    <td>
                                        <form action="{{ route('clients.destroy', $item->id) }}" method="POST">
                                            <div class="btn-group">
                                                <a class="btn btn-sm btn-outline-primary"
                                                    href="{{ route('clients.show', $item->id) }}">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a class="btn btn-sm btn-outline-primary"
                                                    href="{{ route('clients.edit', $item->id) }}">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button class="btn btn-sm btn-outline-danger" href="">
                                                    @csrf
                                                    @method('DELETE')
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                            @if (!count($data))
                            <tr>
                                <td colspan="8">Sem dados registrado</td>
                            @endif

                        </tbody>
                    </table>
                </div>

                <!-- /.card-body -->
                <div class="card-footer clearfix">
                    {!! $data->links('layout.pagination') !!}
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection
