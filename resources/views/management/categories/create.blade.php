@extends('template.layout-mgmt')

@section('main')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Create user</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item">Administration</li>
            <li class="breadcrumb-item"><a href="{{route('users.index')}}">Users</a></li>
            <li class="breadcrumb-item active">Add new user</li>
        </ol>
        <div class="card mb-4">
            <br>
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Add new user
            </div>
            <div class="card-body">
            <form method="POST" action="{{route('users.store')}}">
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
                    <div class="col-md-3">
                        <label>Type</label>
                        <select class="form-control  @error('user_type') is-invalid @enderror" name="user_type">
                            <option {{old('user_type') == 'A' ? "selected" : ""}} value="A">Administrator</option>
                            <option {{old('user_type') == 'E' ? "selected" : ""}} value="E">Employee</option>
                        </select>
                        @error('user_type')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col">
                        <label>Email</label>
                        <input type="email" class="form-control  @error('email') is-invalid @enderror" placeholder="Email" name="email" value="{{old('email')}}">
                        @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="col">
                        <label>Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password">
                        @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-9">
                        <input type="hidden" name="blocked" value="1">
                        <input class="form-check-input @error('blocked') is-invalid @enderror" type="checkbox" name="blocked" id="gridCheck" value="0"  {{old('blocked') == 0 ? 'checked' : ''}}> 
                        <label class="form-check-label">
                            Active
                        </label>
                        @error('blocked')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <br>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
</main>
@endsection