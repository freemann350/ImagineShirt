@extends('template.layout-mgmt')
@section('main')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Edit category</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item">Administration</li>
            <li class="breadcrumb-item"><a href="{{route('categories.index')}}">Category</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>
        <div class="card mb-4">
            <br>
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Edit <i>{{$category->name}}</i>
            </div>
            <div class="card-body">
            <form method="POST" action="{{ route('categories.update', ['category' => $category]) }}">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col">
                        <input type="hidden" name="category_id" value="{{ $category->id }}">
                        <label>Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="First name" value="{{$category->name}}" name="name">
                        @error('name')
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
                    </form>

                    <div class="col-md-2">
                        <form method="POST" action="{{ route('categories.destroy',$category) }}">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit"><i class="fas fa-xmark"></i> &nbsp;Delete category</button>
                        </form>
                    </div>
                </div>
        </div>
    </div>
</main>
@endsection