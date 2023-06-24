@extends('template.layout')

@section('navbar-opt', 'position-absolute')

@section('content')
    <!-- Shop Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <!-- Shop Product Start -->
            <div class="col-lg-12">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <form action="{{route('catalog')}}" method="GET">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search by name" name="name">
                                    <button class="input-group-append">
                                        <span class="input-group-text bg-transparent text-primary">
                                            <i class="fa fa-search"></i>
                                        </span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <@foreach ($tshirts as $tshirt)
                    <div class="col-lg-4 col-md-6  pb-1">
                        <div class="card product-item border-0 mb-4">
                            <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                <img class="img-fluid w-50" style="display: block; margin-left: auto;margin-right: auto; width: 50%;" src="{{ $tshirt->fullTshirtImageUrl }}" alt="{{$tshirt->name}}">
                            </div>
                            <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                                <h6 class="text-truncate mb-3">{{$tshirt->name}}</h6>
                                <div class="d-flex justify-content-center">
                                    <a href="{{ route('detail',$tshirt) }}">
                                    <h6><i class="fas fa-eye text-primary mr-1"></i>View detail</h6><h6 class="text-muted ml-2"></h6>
                                    </a>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-between bg-light ">
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <div class="col-12 pb-1">
                        <nav aria-label="Page navigation">
                            {{$tshirts->withQueryString()->links()}}
                        </nav>
                    </div>
                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->
    @endsection