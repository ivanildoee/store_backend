@extends('layout.layout')
@section('title','Fornecedores')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <form action="{{ route('providers.index') }}" method="POST">
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
                        <a class="btn btn-sm btn-outline-primary" href="{{ route('providers.create') }}"> <i
                                class="fas fa-plus-circle"></i> Fornecedor</a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th style="width: 10px">ID</th>
                                <th>Nome</th>
                                <th>Tipo</th>
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
                                    <td>{{ $item->type }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->phone_number }}</td>
                                    <td>{{ $item->country }}</td>
                                    <td>{{ $item->city }}</td>
                                    <td>{{ $item->address }}</td>

                                    <td>
                                        <form action="{{ route('providers.destroy', $item->id) }}" method="POST">
                                            <div class="btn-group">
                                                <a class="btn btn-sm btn-outline-primary"
                                                    href="{{ route('providers.show', $item->id) }}">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a class="btn btn-sm btn-outline-primary"
                                                    href="{{ route('providers.edit', $item->id) }}">
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
                                <td colspan="9">Sem dados registrado</td>
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