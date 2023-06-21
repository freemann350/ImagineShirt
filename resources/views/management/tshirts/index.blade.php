@extends('template.layout-mgmt')

@section('main')
<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Tshirts</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item">Administration</li>
            <li class="breadcrumb-item active">tshirts</li>
        </ol>

        <a class="btn btn-success" href="{{ route('tshirts.create') }}"><i class="fas fa-plus"></i> &nbsp;New tshirt</a><br><br>

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
                Tshirt filters
            </div>
            <div class="card-body">
                <form method="GET" action="{{route ('tshirts.index')}}">
                    <div class="row">
                        <div class="col">
                            <label>Tshirt name</label>
                            <input type="text" class="form-control" placeholder="Tshirt name" name="name" value="{{old('name',$filterByName)}}">
                        </div>
                        <div class="col">
                            <label>Category</label>
                            <input type="text" class="form-control" placeholder="Category name" name="category" value="{{old('category',$filterByCategory)}}">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <a href="{{ route('tshirts.index') }}" class="btn btn-secondary">Clear</button></a>
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
                Tshirt list
            </div>
            <div class="card-body">

            @if($tshirts->count() == 0)
                <p>No available data.</p>
            @else
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tshirts as $tshirt)    
                        <tr>
                            <td><img src="{{$tshirt->category_id != NULL ? $tshirt->fullTshirtImageUrl :  route('tshirts.get.image',$tshirt->image_url) }}" style="weight: 50px; height:50px"></img></td>
                            <td>{{$tshirt->name}}</td>
                            <td>{{$tshirt->category_id == NULL ? 'Imagem própria' : $tshirt->category->name}}</td>
                            <td>
                                @if ($tshirt->category_id != NULL)
                                    <a href="{{route('tshirts.edit',$tshirt->id)}}">
                                        <button style="color:blue" class="btn"> <i title="Edit {{ $tshirt->name }}" class="fa-solid fa-pencil"></i></button>
                                    </a>
                                @else 
                                    N/A
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-xl-6">
                        {{$tshirts->withQueryString()->links()}}
                    </div>
                </div>
            @endif
            </div>
        </div>
    </div>
</main>
@endsection