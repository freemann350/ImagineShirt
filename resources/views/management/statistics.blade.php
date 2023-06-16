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
                        Sale evolution per month
                    </div>
                    <div class="card-body"><canvas id="saleEvol" width="100%" height="40"></canvas></div>
                </div>
            </div>
            <div class="col-xl-3"></div>
            <div class="col-xl-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-bar me-1"></i>
                        Sales per category (Last 12 mo.)
                    </div>
                    <div class="card-body"><canvas id="salesPerCat" width="100%" height="40"></canvas></div>
                </div>
            </div>
            <div class="col-xl-3"></div>

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
        label: 'Sales average',
        data: [
            @foreach ($salesEvo as $evol)
                {{$evol->cnt}},
            @endforeach      
        ],
        borderWidth: 1
        }]
    },
    options: {
        backgroundColor:['darkgreen'],
        color:['green'],
        borderColor: ['green'],
        scales: {
        y: {
            beginAtZero: false
        }
        }
    }
    });

    //LINE CHART FOR SALES EVOLUTION IN LAST 12 MONTHS
    const salesPerCat = document.getElementById('salesPerCat');

    new Chart(salesPerCat, {
        type: 'doughnut',
        data: {
        labels: [
            @foreach ($salesPerCat as $salesCat)
                '{{$salesCat->name}}',
            @endforeach    
        ],
        datasets: [{
        label: 'Sales average',
        data: [
            @foreach ($salesPerCat as $salesCat)
                {{$salesCat->qty}},
            @endforeach      
        ],
        hoverOffset: 4
        }]
    },
    options: {
    }
});
</script>
@endsection