@extends('template.layout')

@section('navbar-opt', 'position-absolute')

@section('content')

    <!-- Cart Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <div class="col-lg-12 table-responsive mb-5">
                <table class="table table-bordered text-center mb-0">
                    <thead class="bg-secondary text-dark">
                        <tr>
                            <th>Product name</th>
                            <th>Size</th>
                            <th>Color</th>
                            <th>Quantity</th>
                            <th>Unit price</th>
                            <th>Discount</th>
                            <th>Total product</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($cart as $item)
                        <tr>
                            <td class="align-middle">{{ $item['tshirt_name'] }}</td>
                            <td class="align-middle">{{ $item['tshirt_size'] }}</td>
                            <td class="align-middle">{{ $item['tshirt_color']}}</td>
                            <td class="align-middle">{{ $item['tshirt_qty'] }}</td>
                            <td class="align-middle">{{ $item['tshirt_price'] }}</td>
                            <td class="align-middle">{{ $item['tshirt_discount']  }} $</td>
                            <td class="align-middle">{{ $item['tshirt_price_total'] }} $</td>
                            <td class="align-middle">
                                <form method="post" action="{{ route('cart.remove',$item['tshirt_id'] ."" . $item['tshirt_color_code'] . "" . $item['tshirt_size']) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-times"></i></button>
                                </form>
                            </td>
                            @php
                                $total+=$item['tshirt_price_total'];
                            @endphp
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Cart Summary</h4>
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="font-weight-bold">Total</h5>
                            <h5 class="font-weight-bold">{{ $total }}€</h5>
                        </div>
                        <a href="{{ route('checkout', $cart) }}" class="btn btn-block btn-primary my-3 py-3">Proceed To Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->
    @endsection
