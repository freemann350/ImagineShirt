<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>

<body>
    <div class="form-group" style="padding:20px">
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
    </div>
</body>
</html>