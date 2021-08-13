@extends('layouts.app')
@section('contents')
    <div class="container mt-5">
        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-6 mb-3">
                    <div class="card-group">
                        <div class="card">
                            <img class="card-img-top" data-src="{{$product->cover_img}}" alt="Product Image">
                            <div class="card-body">
                                <h4 class="card-title">{{$product->name}}</h4>
                                <p class="card-text">{{$product->description}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection
