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
                        <h4 class="font-weight-semi-bold mb-4">Mudar nome</h4>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <input class="form-control" type="text" placeholder="João Pedro">
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <h4 class="font-weight-semi-bold mb-4">Mudar e-mail</h4>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <input class="form-control" type="text" placeholder="exemplo@email.com">
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <h4 class="font-weight-semi-bold mb-4">Mudar password</h4>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <input class="form-control" type="text" placeholder="Nova password">
                            </div>
                        </div>
                    </div>
                </form>
                <form method="POST" action="{{ route('updateCustomer', $customer) }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">                    
                        <h4 class="font-weight-semi-bold mb-4">Dados de envio</h4>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>Morada</label>
                                <input class="form-control" type="text" placeholder="Rua 123 1234-567 Leiria">
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">                    
                        <h4 class="font-weight-semi-bold mb-4">Dados de pagamento</h4>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>NIF</label>
                                <input class="form-control" type="text" placeholder="123 456 789">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Tipo de pagamento</label>
                                <input class="form-control" type="text" placeholder="VISA">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Referência de pagamento</label>
                                <input class="form-control" type="text" placeholder="132456789">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Profile End -->
    @endsection