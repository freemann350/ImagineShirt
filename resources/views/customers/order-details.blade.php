@extends('template.layout')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Detalhes da encomenda</h1>
        <div class="card mb-4">
            <br>
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Encomenda #{{$id}}
            </div>
            <div class="card-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col">
                            <h5><u>Nome</u></h5>
                            <p class="form-control-static">{{$name}}</p>
                        </div>
                        <div class="col">
                            <h5><u>Morada</u></h5>
                            <p class="form-control-static">{{$address}}</p>
                        </div>
                        <div class="col-md-3">
                            <h5><u>NIF</u></h5>
                            <p class="form-control-static">{{$nif}}</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col">
                            <h5><u>ID de encomenda</u></h5>
                            <p class="form-control-static">{{$id}}</p>
                        </div>
                        <div class="col">
                            <h5><u>Data</u></h5>
                            <p class="form-control-static">{{$date}}</p>
                        </div>
                        <div class="col-md-3">
                            <h5><u>Estado</u></h5>
                            <p class="form-control-static">{{$status}}</p>
                        </div>
                    </div>
                    <hr>
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Produto</th>
                                <th>Tamanho</th>
                                <th>Quantidade</th>
                                <th>Preço unitário</th>
                                <th>Preço</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orderItems as $orderItem)
                            <tr>
                                <td>{{ $orderItem->tshirt->name }}</td>
                                <td>{{ $orderItem->size }}</td>
                                <td>{{ $orderItem->qty }}</td>
                                <td>{{ $orderItem->unit_price }}</td>
                                <td>{{ $orderItem->sub_total }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th>Total: {{ $total }}</th>
                        </tr>
                    </tfoot>
                    </table>
                    <button onclick="history.back()" class="btn btn-primary">Voltar atrás</button>
                    @if ($pdf != null && $status != 'pending')
                        <a href="{{ route('orders.get.pdf',$id) }}"><button class="btn btn-primary">Ver recibo</button></a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</main>      
@endsection