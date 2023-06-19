<div class="card mb-4">
    <br>
    <div class="card-header">
        <i class="fas fa-filter me-1"></i>
        Order Filters
    </div>
    <div class="card-body">
        <form method="GET" action="{{route ($routeName)}}">
            <div class="row">
                <div class="col">
                    <label>Status</label>
                    <select class="form-control  @error('status') is-invalid @enderror" name="status">
                        <option selected hidden value="">Select an order state</option>
                        <option {{$filterByStatus == "pending" ? 'selected' : ''}} value="pending">Pending</option>
                        <option {{$filterByStatus == "paid" ? 'selected' : '' }} value="paid">Paid</option>
                        <option {{$filterByStatus == "closed" ? 'selected' : '' }} value="closed">Closed</option>
                        <option {{$filterByStatus == "canceled" ? 'selected' : '' }} value="canceled">Canceled</option>
                    </select>
                </div>
                <div class="col">
                    <label>Customer name</label>
                    <input type="text" class="form-control" placeholder="Customer name" name="name" value="{{$filterByName}}">
                </div>
                <div class="col">
                    <label>NIF</label>
                    <input type="text" class="form-control" placeholder="Customer name" name="nif" value="{{$filterByNIF}}">
                </div>
            </div>
            <br>

            <div class="row">
                <div class="col-md-4">
                    <label>Start date</label>
                    <input type="text" class="form-control" placeholder="Y-m-d" name="startDate" value="{{$filterByDateStart}}">
                </div>
                <div class="col-md-4">
                    <label>End Date</label>
                    <input type="text" class="form-control" placeholder="Y-m-d" name="endDate" value="{{$filterByDateEnd}}">
                </div>
                <br>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{ route($routeName) }}" class="btn btn-secondary">Clear</button></a>
                </div>
            </div>
        </form>
    </div>
</div>