@extends('template.layout-mgmt')
@section('main')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">View order data</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item">Administration</li>
            <li class="breadcrumb-item">Order</li>
            <li class="breadcrumb-item active">View</li>
        </ol>
        <div class="card mb-4">
            <br>
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Order #{{$id}} data
            </div>
            <div class="card-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col">
                            <h5><u>Customer name</u></h5>
                            <p class="form-control-static">{{$name}}</p>
                        </div>
                        <div class="col">
                            <h5><u>Address</u></h5>
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
                            <h5><u>Order ID</u></h5>
                            <p class="form-control-static">{{$id}}</p>
                        </div>
                        <div class="col">
                            <h5><u>Date</u></h5>
                            <p class="form-control-static">{{$date}}</p>
                        </div>
                        <div class="col-md-3">
                            <h5><u>Status</u></h5>
                            <p class="form-control-static">{{$status}}</p>
                        </div>
                    </div>
                    <hr>
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Size</th>
                                <th>Quantity</th>
                                <th>Unit price</th>
                                <th>Price</th>
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
                        <th>Order total: {{ $total }}</th>
                        </tr>
                    </tfoot>
                    </table>
                    <button onclick="history.back()" class="btn btn-primary">Go back</button>
                    @if ($pdf != null && $status != 'pending')
                        <a href="{{ route('orders.get.pdf',$id) }}"><button class="btn btn-primary">Ver recibo</button></a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</main>      
@endsection