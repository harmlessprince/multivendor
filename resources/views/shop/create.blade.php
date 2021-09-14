@extends('layouts.app')

@section('contents')
    <div class="container">
        <h2>Submit Your Shop</h2>
        <form action="{{ route('shops.store') }}" method="post">

            <div class="form-group">
                <label for="name">Name of Shop</label>
                <input type="text" name="" id="name" class="form-control" placeholder="" aria-describedby="name">
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" name="description" id="description" class="form-control" placeholder="" aria-describedby="description">
            </div>
        </form>
    </div>



@endsection
