@extends('template.layout-mgmt')
@section('main')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Edit tshirt</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item">Administration</li>
            <li class="breadcrumb-item"><a href="{{route('tshirts.index')}}">Tshirts</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>
        <div class="card mb-4">
            <br>
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Edit <i>{{$tshirt->name}}</i>
            </div>
            <div class="card-body">
            <form method="POST" action="{{ route('tshirts.update', $tshirt) }}" enctype="multipart/form-data">
            <input type="hidden" name="tshirt_id" value="{{ $tshirt->id }}">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col">
                        <label>Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="First name" value="{{$tshirt->name}}" name="name">
                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col">
                        <label>Category</label>
                        <select class="form-control  @error('category') is-invalid @enderror" name="category">
                            @foreach ($categories as $category)
                            <option {{{$tshirt->category_id == $category->id ? "selected" : ""}}} value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                        @error('category')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-4">
                        <label>Tshirt picture</label>
                        <br>
                        <img src="{{ $tshirt->fullTshirtImageUrl }}" class="img-thumbnail"></img>
                        <br>
                        <input type="file" class="form-control @error('tshirt_image') is-invalid @enderror"  name="tshirt_image">
                        @error('tshirt_image')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col">
                        <label>Description</label>
                        <textarea class="form-control" name="description">{{$tshirt->description}}</textarea>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> &nbsp;Save</button>
                    </div>
                    </form>

                    <div class="col-md-2">
                        <form method="POST" action="{{ route('tshirts.destroy',$tshirt) }}">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit"><i class="fas fa-xmark"></i> &nbsp;Delete tshirt</button>
                        </form>
                    </div>
                </div>
        </div>
    </div>
</main>
@endsection