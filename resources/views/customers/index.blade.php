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
                    <input name="user_id" class="form-control" type="hidden" value="{{Auth::user()->id}}">
                    <div class="mb-4">
                        <h4 class="font-weight-semi-bold mb-4">Dados pessoais</h4>
                        <div class="col-md-4">
                            <label>Imagem de perfil</label>
                            <br>
                            <img src="{{$user->photo_url != NULL ? $user->profilePhoto : asset('storage/default.jpg')}}" class="rounded-circle img-thumbnail">
                            <br>
                            <div class="row">
                                <input type="file" class="form-control @error('photo') is-invalid @enderror"  name="photo">
                                <br>
                                @error('photo')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>Nome</label>
                                <input name="name" class="form-control @error('name') is-invalid @enderror" type="text" placeholder="João Pedro" value="{{Auth::user()->name}}">
                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>E-mail</label>
                                <input name="email" class="form-control @error('email') is-invalid @enderror" type="text" placeholder="exemplo@email.com" value="{{Auth::user()->email}}">
                                @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>Password</label>
                                <input name="password" class="form-control" type="password" placeholder="Nova password">
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
                                <input name="address" class="form-control @error('email') is-invalid @enderror" type="text" placeholder="Rua 123 1234-567 Leiria" value="{{$customer->address}}">
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">                    
                        <h4 class="font-weight-semi-bold mb-4">Dados de pagamento</h4>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>NIF</label>
                                <input name="nif" class="form-control @error('nif') is-invalid @enderror" type="text" placeholder="123 456 789" value="{{$customer->nif}}">
                                @error('nif')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
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