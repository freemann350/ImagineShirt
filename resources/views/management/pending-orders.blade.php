@extends('template.layout-mgmt')

@section('main')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Pending orders</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item">Orders</li>
            <li class="breadcrumb-item active">Pending orders</li>
        </ol>
        <div class="card mb-4">
            <br>
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Pending orders
            </div>
            <div class="card-body">
            @if($orderPending->count() == 0)
                <p>No available data.</p>
            @else
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Name</th>
                            <th>Total</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orderPending as $order)
                        <tr>
                            <td>{{$order->date}}</td>
                            <td>{{$order->user->name}}</td>
                            <td>{{$order->total_price}}</td>
                            <td>$320,800</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="col-xl-6">{{$orderPending->withQueryString()->links()}}</div>
                    <div class="col-xl-6"><p style="text-align:right">Limit:    10  20  30</p></div>
            @endif
            </div>
        </div>
    </div>
</main>
@endsection