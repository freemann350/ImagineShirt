@extends ('layout')

@section('content')

<div class="row">
    @foreach($products as $product)
        <div class="col-xs18 col-sm6 col-md-4" style="margin-top:10px;">
            <h4>{{$product->product_name}}</h4>
        </div>
        @endforeach
</div>

@endsection