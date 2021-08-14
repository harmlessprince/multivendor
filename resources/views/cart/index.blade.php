@extends('layouts.app')

@section('contents')
    <h1>Your Cart</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Price Sum</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cartItems as $cartItem)
                <tr>
                    <td scope="row">{{ $cartItem->name }}</td>
                    <td>{{ $cartItem->price }}</td>
                    <td>
                        <form action="{{route('cart.update', $cartItem->id)}}">
                            <div class="form-group">
                                <input type="number" name="quantity" value="{{ $cartItem->quantity }}" min="0"
                                    class="form-control">
                                <button type="submit"> Save </button>
                            </div>
                        </form>
                    </td>
                    <td>
                        {{$cartItem->getPriceSum()}}
                    </td>
                    <td>
                        <a href="{{ route('cart.destroy', $cartItem->id) }}" class="btn btn-sm btn-danger">Remove</a>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
    <h3>Total Price:# {{number_format(\Cart::session(auth()->id())->getTotal(), 2)}}</h3>
@endsection