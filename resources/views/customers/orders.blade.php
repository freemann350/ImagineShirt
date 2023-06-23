@extends('template.layout')

@section('navbar-opt', 'position-absolute')

@section('content')
    <!-- Order Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <div class="mb-4">
                    <h4 class="font-weight-semi-bold mb-4">Lista de encomendas</h4>
                    <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Total</th>
                            <th>Notes</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->status }}</td>
                            <td>{{ $order->date }}</td>
                            <td>{{ $order->total_price }}€</td>
                            <td>{{ $order->notes ?? 'N/A' }}</td>
                            <td><a href="{{route ('orders.show',$order->id)}}"><i title="View all info regarding order #{{$order->id}}" class="fa-solid fa-file-lines"></i></a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-xl-6">{{$orders->withQueryString()->links()}}</div>
                </div>
            </div>
        </div>
    </div>
    <!-- Order End -->
    @endsection