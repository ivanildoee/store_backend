@extends('layout.layout')
@section('title', 'Clientes')
@php
    //echo $data['view_is'];
    $is_disabled = $data['view_is'] == 'view' ? 'disabled' : '';
@endphp
@section('content')


    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <form id="form"
                    action="{{ $data['view_is'] == 'create' ? route('clients.store') : ($data['view_is'] == 'update' && isset($client) ? route('clients.update', $client->id) : '') }}"
                    method="POST">
                    @csrf
                    @method($data['view_is'] == 'create' ? 'POST' : ($data['view_is'] == 'update' ? 'PUT' : ''))
                    <div class="card-header">
                        <h3 class="card-title">{{ $title }}</h3>
                        <div class="float-right">
                            <a href="{{ route('clients.index') }}" type="submit" class="btn btn-sm btn-outline-danger mr-2">
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
                                <div class="form-group">
                                    <label>Nome Completo <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control"
                                        value="{{ isset($client) ? $client->name : null }}" {{ $is_disabled }}>
                                </div>
                                <div class="form-group">
                                    <label>País <span class="text-danger">*</span></label>
                                    <input type="text" name="country" class="form-control"
                                        value="{{ isset($client) ? $client->country : null }}" {{ $is_disabled }}>
                                </div>


                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Cidade <span class="text-danger">*</span></label>
                                            <input type="text" name="city" class="form-control"
                                                value="{{ isset($client) ? $client->city : null }}" {{ $is_disabled }}>
                                        </div>
                                        <div class="form-group">
                                            <label>Codigo Postal <span class="text-danger">*</span></label>
                                            <input type="text" name="postcode" class="form-control"
                                                value="{{ isset($client) ? $client->postcode : null }}"
                                                {{ $is_disabled }}>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Estado <span class="text-danger">*</span></label>
                                            <input type="text" name="state" class="form-control"
                                                value="{{ isset($client) ? $client->state : null }}" {{ $is_disabled }}>
                                        </div>
                                        <div class="form-group">
                                            <label>Numero de Telefone <span class="text-danger">*</span></label>
                                            <input type="text" name="phone_number" class="form-control"
                                                value="{{ isset($client) ? $client->phone_number : null }}"
                                                {{ $is_disabled }}>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email address</label>
                                    <input type="email" name="email" class="form-control"
                                        value="{{ isset($client) ? $client->email : null }}" {{ $is_disabled }}>
                                </div>
                                
                                <div class="form-group">
                                    <label>Endereço <span class="text-danger">*</span></label>
                                    <input type="text" name="address" class="form-control"
                                        value="{{ isset($client) ? $client->address : null }}" {{ $is_disabled }}>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
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
                    email: {
                        required: true,
                        email: true,
                    },
                    name: {
                        required: true
                    },
                    address: {
                        required: true
                    },
                    country: {
                        required: true
                    },
                    city: {
                        required: true
                    },
                    state: {
                        required: true
                    },
                    phone_number: {
                        required: true
                    },
                    postcode: {
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
