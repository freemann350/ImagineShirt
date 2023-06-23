@extends('template.layout')

@section('navbar-opt', 'position-absolute')

@section('content')
    <!-- Upload Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <div class="col-lg-8">
                <form method="POST" action="" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="mb-4">
                            <h4 class="font-weight-semi-bold mb-4">Carregue aqui a sua imagem</h4>
                            <img src="" class="">
                            <br>
                            <input type="file" class=""  name="photo">
                            @error('photo')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <button type="submit" class="btn btn-lg btn-block btn-primary font-weight-bold my-3 py-3"><i class="fas fa-save"></i> Save</button>
                    </div>
                </form>
            </div>
            <div class="col-lg-12">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <form action="{{route('upload', Auth::user())}}" method="GET">
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
                    <@foreach ($privateTshirts as $tshirt)
                    <div class="col-lg-4 col-md-6  pb-1">
                        <div class="card product-item border-0 mb-4">
                            <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                <img class="img-fluid w-50" style="display: block; margin-left: auto;margin-right: auto; width: 50%;" src="{{ route('tshirts.get.image',$tshirt->image_url) }}" alt="{{$tshirt->name}}">
                            </div>
                            <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                                <h6 class="text-truncate mb-3">{{$tshirt->name}}</h6>
                                <div class="d-flex justify-content-center">
                                    <h6>$123.00</h6><h6 class="text-muted ml-2"><del>$123.00</del></h6>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-between bg-light border">
                                <a href="/tshirts/detail/{{$tshirt->id}}" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                                <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <div class="col-12 pb-1">
                        <nav aria-label="Page navigation">
                            {{$privateTshirts->withQueryString()->links()}}
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Upload End -->
    @endsection