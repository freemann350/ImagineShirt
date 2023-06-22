@extends('template.layout-mgmt')

@section('main')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Create user</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item">Administration</li>
            <li class="breadcrumb-item"><a href="{{route('tshirts.index')}}">Tshirts</a></li>
            <li class="breadcrumb-item active">Add new tshirt</li>
        </ol>
        <div class="card mb-4">
            <br>
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Add new tshirt
            </div>
            <div class="card-body">
            <form method="POST" action="{{route('tshirts.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col">
                        <label>Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Name" value="{{old('name')}}" name="name">
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
                            <option value="{{$category->id}}">{{$category->name}}</option>
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
                        <input type="file" class="form-control @error('tshirt_image') is-invalid @enderror"  name="tshirt_image">
                        @error('tshirt_image')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col">
                        <label>Description</label>
                        <textarea class="form-control" name="description"></textarea>
                    </div>
                </div>
                <br>
                <br>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
</main>
@endsection