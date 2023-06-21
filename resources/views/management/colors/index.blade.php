@extends('template.layout-mgmt')

@section('main')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Colors</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item">Administration</li>
            <li class="breadcrumb-item active">Colors</li>
        </ol>

        <a class="btn btn-success" href="{{ route('colors.create') }}"><i class="fas fa-plus"></i> &nbsp;New color</a><br><br>

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
                Color filters
            </div>
            <div class="card-body">
                <form method="GET" action="{{route ('colors.index')}}">
                    <div class="row">
                        <div class="col">
                            <label>Color name</label>
                            <input type="text" class="form-control" placeholder="Color name" name="name" value="{{old('name',$filterByName)}}">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <a href="{{ route('colors.index') }}" class="btn btn-secondary">Clear</button></a>
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
                Color list
            </div>
            <div class="card-body">

            @if($colors->count() == 0)
                <p>No available data.</p>
            @else
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($colors as $color)    
                        <tr>
                            <td>{{$color->code}}</td>
                            <td>{{$color->name}}</td>
                            <td>
                                <a href="{{route('colors.edit',$color)}}">
                                    <button style="color:blue" class="btn"> <i title="Edit {{ $color->name }}" class="fa-solid fa-pencil"></i></button>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-xl-6">
                        {{$colors->withQueryString()->links()}}
                    </div>
                </div>
            @endif
            </div>
        </div>
    </div>
</main>
@endsection