@extends('layouts.app')
@section('contents')
    <section>
        <h3>Checkout</h3>
        <h4>Shipping Information</h4>
        <div class="row mt-5 mb-5">
            <div class="container">
                <div class="col-md-12">
                    <form action="{{route('order.store')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="" class="">Full Name</label>
                            <input type="text" class="form-control" name="shipping_fullname" id="shipping_fullname"
                                placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="" class="">State</label>
                            <input type="text" class="form-control" name="shipping_state" id="shipping_state" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="" class="">City</label>
                            <input type="text" class="form-control" name="shipping_city" id="shipping_city" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="" class="">Zip Code</label>
                            <input type="text" class="form-control" name="shipping_zipcode" id="shipping_zipcode"
                                placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="" class="">Full address</label>
                            <input type="text" class="form-control" name="shipping_address" id="shipping_address"
                                placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="" class="">Mobile</label>
                            <input type="text" class="form-control" name="shipping_phone" id="shipping_phone" placeholder="">
                        </div>
                        <button type="submit" class="btn btn-primary btn-sm"> Place Order</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection
