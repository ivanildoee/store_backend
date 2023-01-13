@extends('layout.layout')
@section('title', 'Fornecedores')
@php
    //echo $data['view_is'];
    $is_disabled = $data['view_is'] == 'view' ? 'disabled' : '';
@endphp
@section('content')


    <div class="row">
        <div class="col-md-12">
            <form id="form"
                action="{{ $data['view_is'] == 'create' ? route('providers.store') : ($data['view_is'] == 'update' && isset($provider) ? route('providers.update', $provider->id) : '') }}"
                method="POST">
                @csrf
                @method($data['view_is'] == 'create' ? 'POST' : ($data['view_is'] == 'update' ? 'PUT' : ''))
                <div class="card">

                    <div class="card-header">
                        <h3 class="card-title">{{ $title }}</h3>
                        <div class="float-right">
                            <a href="{{ route('providers.index') }}" type="submit"
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
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label>Nome <span class="text-danger">*</span></label>
                                            <input type="text" name="name" class="form-control"
                                                value="{{ isset($provider) ? $provider->name : null }}" {{ $is_disabled }}>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Tipo <span class="text-danger">*</span></label>
                                            <select name="type" class="form-control" {{ $is_disabled }}>
                                                <option value="">Selecione</option>
                                                <option value="external"
                                                    {{ isset($provider) && $provider->type == 'external' ? 'selected' : '' }}>
                                                    Externo</option>
                                                <option value="internal"
                                                    {{ isset($provider) && $provider->type == 'internal' ? 'selected' : '' }}>
                                                    Interno</option>
                                                <option value="own"
                                                    {{ isset($provider) && $provider->type == 'own' ? 'selected' : '' }}>
                                                    Proprio</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Cidade</label>
                                            <input type="text" name="city" class="form-control"
                                                value="{{ isset($provider) ? $provider->city : null }}"
                                                {{ $is_disabled }}>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Estado</label>
                                            <input type="text" name="state" class="form-control"
                                                value="{{ isset($provider) ? $provider->state : null }}"
                                                {{ $is_disabled }}>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email address</label>
                                    <input type="email" name="email" class="form-control"
                                        value="{{ isset($provider) ? $provider->email : null }}" {{ $is_disabled }}>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>País</label>
                                            <input type="text" name="country" class="form-control"
                                                value="{{ isset($provider) ? $provider->country : null }}"
                                                {{ $is_disabled }}>
                                        </div>
                                        <div class="form-group">
                                            <label>Codigo Postal</label>
                                            <input type="text" name="postcode" class="form-control"
                                                value="{{ isset($provider) ? $provider->postcode : null }}"
                                                {{ $is_disabled }}>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Endereço</label>
                                            <input type="text" name="address" class="form-control"
                                                value="{{ isset($provider) ? $provider->address : null }}"
                                                {{ $is_disabled }}>
                                        </div>
                                        <div class="form-group">
                                            <label>Numero de Telefone</label>
                                            <input type="text" name="phone_number" class="form-control"
                                                value="{{ isset($provider) ? $provider->phone_number : null }}"
                                                {{ $is_disabled }}>
                                        </div>
                                    </div>
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
                    type: {
                        required: true,
                    },
                    name: {
                        required: true
                    },

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
