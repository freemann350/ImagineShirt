@extends('template.layout-mgmt')
@section('main')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Edit category</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item">Administration</li>
            <li class="breadcrumb-item active">Prices</li>
        </ol>

        @if (session('alert-msg'))
        <div class="col">
            <div class="card bg-{{session('alert-type')}} text-white mb-4 ">
                <div class="card-body">{!! session('alert-msg') !!}</div>
            </div>
        </div> 
        @endif

        <div class="card mb-4">
            <br>
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Edit <i>prices</i>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('prices.update', $price) }}">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col">
                            <label>Unit price of images on catalog</label>
                            <input type="text" class="form-control @error('unit_price_catalog') is-invalid @enderror" placeholder="Price on catalog" name="unit_price_catalog" value="{{$price->unit_price_catalog}}">
                            @error('unit_price_catalog')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col">
                            <label>Unit price of self images</label>
                            <input type="text" class="form-control @error('unit_price_own') is-invalid @enderror" placeholder="Price of self images" name="unit_price_own" value="{{$price->unit_price_own}}">
                            @error('unit_price_own')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col">
                            <label>Discount of images on catalog (€)</label>
                            <input type="text" class="form-control @error('unit_price_catalog_discount') is-invalid @enderror" placeholder="Discount on catalog by €" name="unit_price_catalog_discount" value="{{$price->unit_price_catalog_discount}}">
                            @error('unit_price_catalog_discount')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col">
                            <label>Discount of self images (€)</label>
                            <input type="text" class="form-control @error('unit_price_own_discount') is-invalid @enderror" placeholder="Discount of self images by €" name="unit_price_own_discount" value="{{$price->unit_price_own_discount}}">
                            @error('unit_price_own_discount')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col">
                            <label>Quantity required for discount</label>
                            <input type="text" class="form-control @error('qty_discount') is-invalid @enderror" placeholder="Quantity" name="qty_discount" value="{{$price->qty_discount}}">
                            @error('qty_discount')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> &nbsp;Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection