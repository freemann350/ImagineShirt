@extends('template.layout-mgmt')

@section('main')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Order history</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item">Orders</li>
            <li class="breadcrumb-item active">Order History</li>
        </ol>
        
        @include('management.orders.shared.filtros',[
            'routeName' => "orders.history",
            'filterByStatus' => old('status',$filterByStatus),
            'filterByName' => old('name',$filterByName),
            'filterByDateStart' => old('datestart',$filterByDateStart),
            'filterByDateEnd' => old('dateend',$filterByDateEnd),
            'filterByDateNIF' => old('nif',$filterByNIF)
        ])

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Order history
            </div>
            <div class="card-body">
            @if($orderHistory->count() == 0)
                <p>No available data.</p>
            @else
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Status</th>
                            <th>Name</th>
                            <th>Date</th>
                            <th>Total</th>
                            <th>NIF</th>
                            <th>Notes</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orderHistory as $history)
                        <tr>
                            <td>{{ $history->status }}</td>
                            <td>{{ $history->user->name }}</td>
                            <td>{{ $history->date }}</td>
                            <td>{{ $history->total_price }}€</td>
                            <td>{{ $history->nif }}</td>
                            <td>{{ $history->notes ?? 'N/A' }}</td>
                            <td><a href="{{route ('orders.show',$history->id)}}"><i title="View all info regarding order #{{$history->id}}" class="fa-solid fa-file-lines"></i></a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-xl-6">{{$orderHistory->withQueryString()->links()}}</div>
                </div>
            @endif
            </div>
        </div>
    </div>
</main>
@endsection