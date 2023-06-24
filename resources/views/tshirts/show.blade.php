@extends('template.layout')

@section('navbar-opt', 'position-absolute')

@section('content')
    <!-- Shop Detail Start -->
    <div class="container-fluid py-5">
        <div class="row px-xl-5">
            <div class="col-lg-4 pb-5">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner border">
                        <div class="carousel-item active">
                            <img class="w-100 h-100" src="{{ $tshirt->category != NULL ? $tshirt->fullTshirtImageUrl : route('tshirts.get.image',$tshirt->image_url) }}" alt="{{$tshirt->name}}">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                        <i class="fa fa-2x fa-angle-left text-dark"></i>
                    </a>
                    <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                        <i class="fa fa-2x fa-angle-right text-dark"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-7 pb-5">
                <h3 class="font-weight-semi-bold">{{$tshirt->name}}</h3>
                <h3 class="font-weight-semi-bold mb-4">{{$price->unit_price_catalog}}€</h3>
                <p class="mb-4">{{$tshirt->category_id == NULL ? 'Imagem privada' : $tshirt->category->name}}</p>
                <form method="POST" action="{{ route('cart.add', $tshirt) }}">
                    <p class="text-dark font-weight-medium mb-0 mr-3">Sizes:</p>
                    <div class="d-flex mb-3">
                        @csrf
                        <select class="custom-select" name="tshirt_size">
                            <option value="XS">Extra small</option>
                            <option value="S">Small</option>
                            <option value="M">Medium</option>
                            <option value="L">Large</option>
                            <option value="XL">Extra large</option>
                        </select>
                    </div>
                    <p class="text-dark font-weight-medium mb-0 mr-3">Colors:</p>
                    <div class="d-flex mb-3">
                        <select class="custom-select" name="tshirt_color">
                        @foreach ($color as $color)
                                <option value="{{ $color->code }}">{{$color->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <p class="text-dark font-weight-medium mb-0 mr-3">Quantity:</p>
                    <div class="d-flex mb-3">
                        <div class="input-group quantity mr-3" style="width: 130px;">
                            <input type="text" class="form-control bg-secondary text-center" name="quantity" value="1">
                        </div>
                        <button  type="submit" class="btn btn-primary px-3"><i class="fa fa-shopping-cart mr-1"></i> Add To Cart</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row px-xl-5">
            <div class="col">
                <div class="nav nav-tabs justify-content-center border-secondary mb-4">
                    <a class="nav-item nav-link active" data-toggle="tab" href="#tab-pane-1">Description</a>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab-pane-1">
                        <h4 class="mb-3">Product Description</h4>
                        <p> {{$tshirt->description}} </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Shop Detail End -->
    @endsection