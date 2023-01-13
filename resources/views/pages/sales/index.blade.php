@extends('layout.layout')
@section('title', 'Vendas')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <form action="{{ route('sales.index') }}" method="POST">
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
                    <!--div class="float-right">
                                <a class="btn btn-sm btn-outline-primary" href="{{ route('sales.create') }}"> <i
                                        class="fas fa-plus-circle"></i> Venda</a>
                            </div-->
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th style="width: 10px">ID</th>
                                <th>Nome do Cliente</th>
                                <th>Email do Cliente</th>
                                <th>Preço</th>
                                <th>Disconto</th>
                                <th>Preço Total</th>
                                <th>Data</th>
                                <th style="width: 40px">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->client->name }}</td>
                                    <td>{{ $item->client->email }}</td>
                                    <td>${{ $item->price_subtotal }}</td>
                                    <td>${{ $item->price_discount }}</td>
                                    <td>${{ $item->price_total }}</td>
                                    <td>{{ $item->created_at }}</td>

                                    <td>
                                        <form action="{{ route('sales.destroy', $item->id) }}" method="POST">
                                            <div class="btn-group">
                                                <a class="btn btn-sm btn-outline-primary" id="view-cart"
                                                    data-id="{{ $item->id }}">
                                                    <i class="fas fa-shopping-cart"></i>
                                                </a>
                                                <a class="btn btn-sm btn-outline-primary"   href="{{ route('clients.show', $item->client_id) }}">
                                                    <i class="fas fa-user"></i>
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

    <!-- medium modal -->
    <div class="modal fade" id="cartModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Carinho de compra</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="mediumBody">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Nome</th>
                                <th>Quantidade</th>
                                <th>Preço Unit.</th>
                                <th>Desconto Unit.</th>
                                <th>Preço Total</th>
                            </tr>
                        </thead>
                        <tbody id="cartItem">
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>
        $('table').on('click', '#view-cart', function() {
            let id = $(this).attr('data-id');
            //alert(id)
            //$('#cardDetais').modal('show')
            // AJAX request

            var url = "{{ route('getCart', [':id']) }}";
            url = url.replace(':id', id);
            $('#cartModal').modal('show')
            $('#cartItem').html(`<tr>
                <td colspan="7">
                    Carregando dados
                    <div class="spinner-border spinner-border-sm" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <div class="spinner-border spinner-border-sm" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <div class="spinner-border spinner-border-sm" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </td>
            </tr>`)
            $.ajax({
                url: url,
                dataType: 'json',
                success: function(response) {

                    $('#cartItem').html(response.html)

                }
            });
            return false;
        })
    </script>
@endsection
