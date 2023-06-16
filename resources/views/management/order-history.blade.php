@extends('template.layout-mgmt')

@section('main')
<main>
    <div class="container-fluid px-4">
        <div class="mt-4"></div>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Order history
            </div>
            <div class="card-body">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Status</th>
                            <th>Name</th>
                            <th>Date</th>
                            <th>Total</th>
                            <th>NIF</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orderHistory as $history)
                        <tr>
                            <td>{{$history->status}}</td>
                            <td>{{$history->user->name}}</td>
                            <td>{{$history->date}}</td>
                            <td>{{$history->total_price}}</td>
                            <td>{{$history->nif}}</td>
                            <td></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-xl-6">{{$orderHistory->withQueryString()->links()}}</div>
                    <div class="col-xl-6"><p style="text-align:right">Limit:    10  20  30</p></div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection