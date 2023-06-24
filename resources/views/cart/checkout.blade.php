@extends('template.layout')

@section('navbar-opt', 'position-absolute')

@section('content')
    <!-- Checkout Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <div class="col-lg-8">
            <form method="POST" action="{{ route('updateCustomerCheckout', $customer) }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">                    
                        <h4 class="font-weight-semi-bold mb-4">Dados de envio</h4>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>Morada</label>
                                <input name="address" class="form-control @error('email') is-invalid @enderror" type="text" placeholder="Rua 123 1234-567 Leiria" value="{{$customer->address}}">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>NIF</label>
                                <input name="nif" class="form-control @error('nif') is-invalid @enderror" type="text" placeholder="123 456 789" value="{{$customer->nif}}">
                                @error('nif')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Tipo de pagamento</label>
                                <input name="default_payment_type" class="form-control @error('default_payment_type') is-invalid @enderror" type="text" placeholder="VISA" value="{{$customer->default_payment_type}}">
                                @error('default_payment_type')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Referência de pagamento</label>
                                <input name="default_payment_ref" class="form-control @error('default_payment_ref') is-invalid @enderror" type="text" placeholder="123456789" value="{{$customer->default_payment_ref}}">
                                @error('default_payment_ref')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="card-footer border-secondary bg-transparent">
                                <button type="submit" class="btn btn-lg btn-block btn-primary font-weight-bold my-3 py-3"><i class="fas fa-save"></i> Guardar dados</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-4">
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Resumo</h4>
                    </div>
                    <div class="card-body">
                        <h5 class="font-weight-medium mb-3">Produtos</h5>
                        @foreach ($cart as $item)
                            <label>{{ $item['tshirt_name'] }} (x{{ $item['tshirt_qty'] }})</label>
                            </tr>
                        @endforeach
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <div class="d-flex justify-content-between mt-2" style="margin-left: 0.6rem">
                            <h5 class="font-weight-bold">Total</h5>
                            <h5 class="font-weight-bold">{{ $total }}€</h5>
                        </div>
                        <form method="post" action="{{ route('cart.store', $cart) }}">
                            @csrf
                            <button class="btn btn-lg btn-block btn-primary font-weight-bold my-3 py-3" style="margin-left: 0.6rem">Place Order</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Checkout End -->
    @endsection