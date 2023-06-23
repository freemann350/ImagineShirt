@extends('template.layout-mgmt')

@section('main')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Statistics</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item">Administration</a></li>
            <li class="breadcrumb-item active">Statistics</li>
        </ol>
        <div class="row">
            <div class="col-xl-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-area me-1"></i>
                        Sale evolution per month (Last 12 mo.)
                    </div>
                    <div class="card-body"><canvas id="saleEvol" width="100%" height="40"></canvas></div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-area me-1"></i>
                        Total sales per category (Last 12 mo.)
                    </div>
                    <div class="card-body"><canvas id="salesPerCat" width="100%" height="40"></canvas></div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-bar me-1"></i>
                        Today's sales
                    </div>
                    <div class="card-body">
                        @if($todaySales->count() == 0)
                        <p>No available data.</p>
                        @else
                        <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Status</th>
                            <th>Name</th>
                            <th>Total</th>
                            <th>NIF</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($todaySales as $sales)
                        <tr>
                            <td>{{$sales->status}}</td>
                            <td>{{$sales->name}}</td>
                            <td>{{$sales->total_price}}</td>
                            <td>{{$sales->nif}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                        <th></th>
                        <th></th>
                        <th>Day total: {{$totalToday[0]->total}}</th>
                        <th></th>
                        </tr>
                    </tfoot>
                </table>
                <div class="col-xl-6">{{$todaySales->withQueryString()->links()}}</div>
                @endif
                </div>
                </div>
            </div>

        </div>
    </div>
</main>

<script src="{{ url('js/chart.js') }}"></script>

<script>

    //LINE CHART FOR SALES EVOLUTION IN LAST 12 MONTHS
    const saleEvol = document.getElementById('saleEvol');

    new Chart(saleEvol, {
    type: 'line',
    data: {
        labels: [
            @foreach ($salesEvo as $evolmnt)
                '{{$evolmnt->mnt}}',
            @endforeach    
        ],
        datasets: [{
        label: 'Number of sales',
        fill: true,
        backgroundColor: 'lightgreen',
        pointBorderWidth: 3,
        pointHitRadius: 50,
        data: [
            @foreach ($salesEvo as $evol)
                {{$evol->cnt}},
            @endforeach      
        ],
        borderWidth: 1
        }]
    },
    options: {
        plugins: {
            legend: {
                display: false
            }
        },
        responsive: true,
        color:['green'],
        borderColor: ['green'],
        scales: {
            y: {
                beginAtZero: false
            }
        }
    }
    });

    //BAR CHART FOR SALES EVOLUTION IN LAST 12 MONTHS
    const salesPerCat = document.getElementById('salesPerCat');

    new Chart(salesPerCat, {
        type: 'bar',
        data: {
            labels: [
                @foreach ($salesPerCat as $salesCat)
                    '{{$salesCat->name}}',
                @endforeach    
            ],
            datasets: [{
            label: 'Total sold',
            data: [
                @foreach ($salesPerCat as $salesCat)
                    {{$salesCat->qty}},
                @endforeach      
            ],
            hoverOffset: 4
            }]
        },
        options: {
            plugins: {
            legend: {
                display: false
            }
        }
        }
    });
</script>
@endsection