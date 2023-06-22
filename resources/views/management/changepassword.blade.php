@extends('template.layout-mgmt')
@section('main')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Edit color</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item">User</li>
            <li class="breadcrumb-item active">Password change</li>
        </ol>
        <div class="card mb-4">
            <br>
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Change my password
            </div>
            <div class="card-body">
            <form method="POST" action="{{ route('staff.password.change',$user) }}">
                @csrf
                @method('PATCH')
                <div class="row">
                    <div class="col">
                        <label>{{$user->name}}</label>
                        <input type="password" class="form-control" placeholder="Password" name="password">
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
</main>
@endsection