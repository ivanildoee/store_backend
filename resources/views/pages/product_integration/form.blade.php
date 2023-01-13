@extends('layout.layout')
@section('title', 'Integração de Produtos')
@php
    //echo $data['view_is'];
    $is_disabled = $data['view_is'] == 'view' ? 'disabled' : '';
@endphp
@section('content')


    <div class="row">
        <div class="col-md-12">
            <form id="form"
                action="{{ $data['view_is'] == 'create' ? route('product_integrations.store') : ($data['view_is'] == 'update' && isset($productMapIntegration) ? route('product_integrations.update', $productMapIntegration->id) : '') }}"
                method="POST">
                @csrf
                @method($data['view_is'] == 'create' ? 'POST' : ($data['view_is'] == 'update' ? 'PUT' : ''))
                <div class="card">

                    <div class="card-header">
                        <h3 class="card-title">{{ $title }}</h3>
                        <div class="float-right">
                            <a href="{{ route('product_integrations.index') }}" type="submit"
                                class="btn btn-sm btn-outline-danger mr-2">
                                <i class="fas fa-undo-alt"></i> Voltar</a>
                            @if ($data['view_is'] != 'view')
                                <button type="submit" class="btn btn-sm btn-outline-primary">
                                    @if ($data['view_is'] == 'create')
                                        <i class="fas fa-save"></i> Registar
                                    @else
                                        <i class="fas fa-edit"></i> Editar
                                    @endif

                                </button>
                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Fornecedores <span class="text-danger">*</span></label>
                                    <select name="providers_id" class="form-control" {{ $is_disabled }}>
                                        <option value="">Selecione</option>
                                        @foreach ($providers as $item)
                                        <option value="{{$item->id}}" {{ isset($productMapIntegration) && $productMapIntegration->providers_id == $item->id ? 'selected' : '' }}>{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <label>API URL<span class="text-danger">*</span></label>
                                    <input type="url" name="api_url" class="form-control" value="{{ isset($productMapIntegration) ? $productMapIntegration->api_url : null }}" {{ $is_disabled }}>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>API Token</label>
                                    <input type="text" name="api_token" class="form-control" value="{{ isset($productMapIntegration) ? $productMapIntegration->api_token : null }}" {{ $is_disabled }}>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>API Username</label>
                                    <input type="text" name="api_username" class="form-control" value="{{ isset($productMapIntegration) ? $productMapIntegration->api_username : null }}" {{ $is_disabled }}>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>API Password</label>
                                    <input type="text" name="api_password" class="form-control" value="{{ isset($productMapIntegration) ? $productMapIntegration->api_password : null }}" {{ $is_disabled }}>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Campo Nome <span class="text-danger">*</span></label>
                                    <input type="text" name="field_name" class="form-control" value="{{ isset($productMapIntegration) ? $productMapIntegration->field_name : null }}" {{ $is_disabled }}>
                                </div>
                                <div class="form-group">
                                    <label>Campo Images</label>
                                    <input type="text" name="field_images" class="form-control" value="{{ isset($productMapIntegration) ? $productMapIntegration->field_images : null }}" {{ $is_disabled }}>
                                </div>
                                <div class="form-group">
                                    <label>Campo Desconto</label>
                                    <input type="text" name="field_discountValue" class="form-control" value="{{ isset($productMapIntegration) ? $productMapIntegration->field_discountValue : null }}" {{ $is_disabled }}>
                                </div>                             
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Campo ID <span class="text-danger">*</span></label>
                                    <input type="text" name="field_id" class="form-control" value="{{ isset($productMapIntegration) ? $productMapIntegration->field_id : null }}" {{ $is_disabled }}>
                                </div>
                                <div class="form-group">
                                    <label>Campo Categorias</label>
                                    <input type="text" name="field_category" class="form-control" value="{{ isset($productMapIntegration) ? $productMapIntegration->field_category : null }}" {{ $is_disabled }}>
                                </div>
                                <div class="form-group">
                                    <label>Campo tem Desconto?</label>
                                    <input type="text" name="field_hasDiscount" class="form-control" value="{{ isset($productMapIntegration) ? $productMapIntegration->field_hasDiscount : null }}" {{ $is_disabled }}>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Campo Preço <span class="text-danger">*</span></label>
                                    <input type="text" name="field_price" class="form-control" value="{{ isset($productMapIntegration) ? $productMapIntegration->field_price : null }}" {{ $is_disabled }}>
                                </div>
                                <div class="form-group">
                                    <label>Campo Material</label>
                                    <input type="text" name="field_material" class="form-control" value="{{ isset($productMapIntegration) ? $productMapIntegration->field_material : null }}" {{ $is_disabled }}>
                                </div>
                            </div>
                            <div class="col-md-3">                                
                                <div class="form-group">
                                    <label>Campo Descrição <span class="text-danger">*</span></label>
                                    <input type="text" name="field_description" class="form-control" value="{{ isset($productMapIntegration) ? $productMapIntegration->field_description : null }}" {{ $is_disabled }}>
                                </div>
                                <div class="form-group">
                                    <label>Campo Departamento</label>
                                    <input type="text" name="field_departaments" class="form-control" value="{{ isset($productMapIntegration) ? $productMapIntegration->field_departaments : null }}" {{ $is_disabled }}>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script src="plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="plugins/jquery-validation/additional-methods.min.js"></script>
    <script>
        $(function() {
            $.validator.setDefaults({

            });
            $('#form').validate({
                rules: {
                    providers_id: {
                        required: true,
                    },
                    field_name: {
                        required: true
                    },
                    field_description: {
                        required: true,
                    },
                    field_price: {
                        required: true
                    },
                    field_id: {
                        required: true
                    },
                    api_url: {
                        required: true,
                        url: true,
                    }
                },
                messages: {},
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>
@endsection
