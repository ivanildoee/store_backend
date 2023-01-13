@extends('layout.layout')
@section('title','Integração de Produtos')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <form action="{{ route('product_integrations.index') }}" method="POST">
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
                        <a class="btn btn-sm btn-outline-primary" href="{{ route('product_integrations.create') }}"> <i
                                class="fas fa-plus-circle"></i> Integração</a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th style="width: 10px">ID</th>
                                <th>Nome</th>
                                <th>Descrição</th>
                                <th>Preço</th>
                                <th>Categoria</th>
                                <th>Material</th>
                                <th>API URL</th>
                                <th style="width: 40px">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->field_name }}</td>
                                    <td>{{ $item->field_description }}</td>
                                    <td>{{ $item->field_price }}</td>
                                    <td>{{ $item->field_category }}</td>
                                    <td>{{ $item->field_material }}</td>
                                    <td><a href="{{ $item->api_url }}" target="_blank">{{ $item->api_url }}</a> </td>

                                    <td>
                                        <form action="{{ route('product_integrations.destroy', $item->id) }}" method="POST">
                                            <div class="btn-group">
                                                <a class="btn btn-sm btn-outline-success"
                                                    href="{{ route('integrate', $item->id) }}"  target="_blank">
                                                    <i class="fas fa-external-link-alt"></i>
                                                </a>
                                                <a class="btn btn-sm btn-outline-primary"
                                                    href="{{ route('product_integrations.show', $item->id) }}">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a class="btn btn-sm btn-outline-primary"
                                                    href="{{ route('product_integrations.edit', $item->id) }}">
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