@extends('template.layout-mgmt')

@section('main')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Pending orders</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item">Orders</li>
            <li class="breadcrumb-item active">Pending orders</li>
        </ol>

        @include('management.orders.shared.filtros',[
            'routeName' => "orders.pending",
            'filterByStatus' => old('status',$filterByStatus),
            'filterByName' => old('name',$filterByName),
            'filterByDateStart' => old('datestart',$filterByDateStart),
            'filterByDateEnd' => old('dateend',$filterByDateEnd),
            'filterByDateNIF' => old('nif',$filterByNIF)
        ])

        @if (session('alert-msg'))
        <div class="col">
            <div class="card bg-{{session('alert-type')}} text-white mb-4 ">
                <div class="card-body">{!! session('alert-msg') !!}</div>
            </div>
        </div> 
        @endif
        
        <div class="card mb-4">
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
                            <td>{{$order->total_price}}€</td>
                            <td>
                                @if ($order->status == 'pending' )
                                    <form action="{{ route('orders.status.change', $order) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="paid">
                                        <button style="color:blue"  title="Set status as paid" type="submit" class="btn"><i class="fa-solid fa-money-bill-wave"></i></button>
                                    </form>
                                @else
                                    <form action="{{ route('orders.status.change', $order) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="closed">
                                        <button style="color:blue"  title="Set status as  closed" type="submit" class="btn"><i class="fa-solid fa-check"></i></button>
                                    </form>
                                @endif
                                <a class="btn" style="color:blue" href="{{route ('orders.show',$order->id)}}"><i title="View all info regarding order #{{$order->id}}" class="fa-solid fa-file-lines"></i></a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="col-xl-6">{{$orderPending->withQueryString()->links()}}</div>
            @endif
            </div>
        </div>
    </div>
</main>
@endsection