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
            <div class="col-lg-8">
                <h4 class="font-weight-semi-bold mb-4">Lista de imagens pessoais</h4>
                    <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                        <img class="img-fluid w-50" style="display: block; margin-left: auto;margin-right: auto; width: 50%;" src="" alt="">
                    </div>
                    <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                        <h6 class="text-truncate mb-3"></h6>
                    </div>
                </div>
            </div>
            <div class="col-12 pb-1">
                <nav aria-label="Page navigation">
                </nav>
            </div>
        </div>
    </div>
    <!-- Upload End -->
    @endsection