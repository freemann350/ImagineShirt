@extends('template.layout')

@section('navbar-opt', 'position-absolute')

@section('content')
    <!-- Profile Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <div class="col-lg-8">
                <form method="POST" action="{{ route('updateUser', Auth::user()) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <h4 class="font-weight-semi-bold mb-4">Nome</h4>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <input name="name" class="form-control" type="text" placeholder="João Pedro" value="{{Auth::user()->name}}">
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <h4 class="font-weight-semi-bold mb-4">E-mail</h4>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <input name="email" class="form-control" type="text" placeholder="exemplo@email.com" value="{{Auth::user()->email}}">
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <h4 class="font-weight-semi-bold mb-4">Password</h4>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <input name="password" class="form-control" type="text" placeholder="Nova password">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <button type="submit" class="btn btn-lg btn-block btn-primary font-weight-bold my-3 py-3"><i class="fas fa-save"></i> Guardar dados</button>
                    </div>
                </form>
            </div>
            <div class="col-lg-8">
                <form method="POST" action="{{ route('updateCustomer', $customer) }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">                    
                        <h4 class="font-weight-semi-bold mb-4">Dados de envio</h4>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>Morada</label>
                                <input name="address" class="form-control" type="text" placeholder="Rua 123 1234-567 Leiria" value="{{$customer->address}}">
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">                    
                        <h4 class="font-weight-semi-bold mb-4">Dados de pagamento</h4>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>NIF</label>
                                <input name="nif" class="form-control" type="text" placeholder="123 456 789" value="{{$customer->nif}}">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Tipo de pagamento</label>
                                <input name="default_payment_type" class="form-control" type="text" placeholder="VISA" value="{{$customer->default_payment_type}}">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Referência de pagamento</label>
                                <input name="default_payment_ref" class="form-control" type="text" placeholder="123456789" value="{{$customer->default_payment_ref}}">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <button type="submit" class="btn btn-lg btn-block btn-primary font-weight-bold my-3 py-3"><i class="fas fa-save"></i> Guardar dados</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Profile End -->
    @endsection