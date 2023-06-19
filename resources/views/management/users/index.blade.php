@extends('template.layout-mgmt')

@section('main')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Users</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item">Administration</li>
            <li class="breadcrumb-item active">Users</li>
        </ol>
        <div class="card mb-4">
            <br>
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                User list
            </div>
            <div class="card-body">
            @if($users->count() == 0)
                <p>No available data.</p>
            @else
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Type</th>
                            <th>State</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)    
                        <tr>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->user_type}}</td>
                            <td>{{$user->blocked == 0 ? "Active" : "Inactive"}}</td>
                            <td><a href="{{route('users.edit',$user->id)}}"><i title="Edit {{ $user->name }} data" class="fa-solid fa-pencil"></i></a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-xl-6">{{$users->withQueryString()->links()}}</div>
                </div>
            @endif
            </div>
        </div>
    </div>
</main>
@endsection