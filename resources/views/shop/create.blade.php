@extends('layouts.app')

@section('contents')
    <div class="container">
        <h2>Submit Your Shop</h2>
        <form action="{{ route('shops.store') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="name">Name of Shop</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="" aria-describedby="name" value="{{old('name')}}">
                @error('name')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" rows="5" class="form-control">{{old('description')}}</textarea>
                @error('description')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>



@endsection
