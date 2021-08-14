@extends('layouts.app')
@section('contents')
    <div class="container mt-5">
        <h1>Products</h1>
        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-4 mb-3">
                    <div class="card-group">
                        <div class="card">
                            <img class="card-img-top" data-src="{{ $product->cover_img }}" alt="Product Image"
                                src="{{ $product->cover_img }}">
                            <div class="card-body">
                                <h4 class="card-title">{{ $product->name }}</h4>
                                <p class="card-text">{{ $product->description }}</p>
                            </div>
                            <div class="card-body">
                                <a href="{{route('add.cart', $product->id)}}" class="card-link">Add To Cart</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection
