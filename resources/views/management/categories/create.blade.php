@extends('template.layout-mgmt')

@section('main')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Create user</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item">Administration</li>
            <li class="breadcrumb-item"><a href="{{route('categories.index')}}">Categories</a></li>
            <li class="breadcrumb-item active">Add new category</li>
        </ol>
        <div class="card mb-4">
            <br>
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Add new category
            </div>
            <div class="card-body">
            <form method="POST" action="{{route('categories.store')}}">
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
                    <br>
                </div>
                <br>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
</main>
@endsection