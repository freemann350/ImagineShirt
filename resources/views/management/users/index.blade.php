@extends('template.layout-mgmt')

@section('main')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Users</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item">Administration</li>
            <li class="breadcrumb-item active">Users</li>
        </ol>

        <a class="btn btn-success" href="{{ route('users.create') }}"><i class="fas fa-plus"></i> &nbsp;New user</a><br><br>

        @if (session('alert-msg'))
        <div class="col">
            <div class="card bg-{{session('alert-type')}} text-white mb-4 ">
                <div class="card-body">{!! session('alert-msg') !!}</div>
            </div>
        </div> 
        @endif
        
        <div class="card mb-4">
            <br>
            <div class="card-header">
                <i class="fas fa-filter me-1"></i>
                User filters
            </div>
            <div class="card-body">
                <form method="GET" action="{{route ('users.index')}}">
                    <div class="row">
                        <div class="col">
                            <label>User name</label>
                            <input type="text" class="form-control" placeholder="User name" name="name" value="{{old('name',$filterByName)}}">
                        </div>
                        <div class="col">
                            <label>Email</label>
                            <input type="email" class="form-control" placeholder="Email" name="email" value="{{old('email',$filterByEmail)}}">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-4">
                            <label>User type</label>
                            <select class="form-control" name="user_type">
                                <option selected hidden value="">Select an user type</option>
                                <option {{old('user_type',$filterByUserType) == 'A' ? 'selected' : ""}} value="A">Administrator</option>
                                <option {{old('user_type',$filterByUserType) == 'E' ? 'selected' : ""}} value="E">Employee</option>
                                <option {{old('user_type',$filterByUserType) == 'C' ? 'selected' : ""}} value="C">Customer</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>Blocked status</label>
                            <select class="form-control" name="blocked">
                                <option selected hidden value="">Select a blocked status</option>
                                <option {{old('blocked',$filterByBlocked) == '0' ? 'selected' : ""}} value="0">Unblocked</option>
                                <option {{old('blocked',$filterByBlocked) == '1' ? 'selected' : ""}} value="1">Blocked</option>
                            </select>
                        </div>
                        <br>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <a href="{{ route('users.index') }}" class="btn btn-secondary">Clear</button></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <br>

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
                            <td>
                                @if ($user->user_type == 'A')
                                Administrator
                                @elseif ($user->user_type == 'E')
                                Employee
                                @else
                                Customer
                                @endif
                            </td>
                            <td>{{$user->blocked == 0 ? "Unblocked" : "Blocked"}}</td>
                            <td>
                                @if ($user->user_type != "C") 
                                <a href="{{route('users.edit',$user->id)}}">
                                    <button style="color:blue" class="btn"> <i title="Edit {{ $user->name }} data" class="fa-solid fa-pencil"></i></button>
                                </a>
                                @endif
                                @if($user->blocked == 0 )
                                    <form action="{{ route('users.blocked.change', $user) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="blocked" value="1">
                                        <button style="color:gold" title="Block {{ $user->name }}" type="submit" class="btn"><i class="fa-solid fa-lock"></i></button>
                                    </form>
                                @else
                                    <form action="{{ route('users.blocked.change', $user) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="blocked" value="0">
                                        <button style="color:darkgreen" title="Unblock {{ $user->name }}" type="submit" class="btn"><i class="fa-solid fa-lock-open"></i></button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-xl-6">
                        {{$users->withQueryString()->links()}}
                    </div>
                </div>
            @endif
            </div>
        </div>
    </div>
</main>
@endsection