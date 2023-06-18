@extends('template.layout-mgmt')
@section('main')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Edit user</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item">Administration</li>
            <li class="breadcrumb-item">Users</li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>
        <div class="card mb-4">
            <br>
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Pending orders
            </div>
            <div class="card-body">
            <form>
                <div class="row">
                    <div class="col">
                        <label for="inputEmail4">Nome</label>
                        <input type="text" class="form-control" placeholder="First name">
                    </div>
                    <br>
                    <div class="col-md-3">
                        <label for="inputEmail4">Type</label>
                        <select class="form-control"><option>NO</option></select>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col">
                        <label for="inputEmail4">Email</label>
                        <input type="text" class="form-control" placeholder="First name">
                    </div>
                    <div class="col">
                        <label for="inputEmail4">Password</label>
                        <input type="text" class="form-control" placeholder="Last name">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-9">
                        <input class="form-check-input" type="checkbox" id="gridCheck">
                        <label class="form-check-label" for="gridCheck">
                            Active
                        </label>
                    </div>
                </div>
                <br>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
</main>
@endsection