@extends('layouts.admin')
@section('title', 'Dashboard')
@push('styles')

@endpush
@section('content')
@section('header', 'Order Detail')
<div class="row">
    <div class="col-lg-12">
        <!-- Order Details -->
        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <a href="#orderDetails" class="d-block card-header py-3" data-toggle="collapse" role="button"
                aria-expanded="true" aria-controls="orderDetails">
                <h6 class="m-0 font-weight-bold text-primary">Order Details</h6>

            </a>

            <!-- Card Content - Collapse -->
            <div class="collapse show" id="orderDetails">
                <div class="card-body">
                    <ul class="list-group list-group-flush  ">
                        <li class="list-group-item border-0">
                            <p><strong>Order Number:</strong> {{ $order->order_number }}</p>
                        </li>
                        <li class="list-group-item border-0">
                            <p><strong>Order Date:</strong> {{ $order->created_at }}</p>
                        </li>
                        <li class="list-group-item border-0">
                            <p><strong>Paid:</strong> <span
                                    class="badge badge-{{ $order->is_paid ? 'success' : 'warning' }} text-uppercase h1">
                                    {{ $order->is_paid ? 'Paid' : 'Not Paid' }}
                                </span></p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
    <div class="col-lg-12">
        <!-- Shipping Information -->
        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <a href="#shippingInformation" class="d-block card-header py-3" data-toggle="collapse" role="button"
                aria-expanded="true" aria-controls="shippingInformation">
                <h6 class="m-0 font-weight-bold text-primary">Shipping Information</h6>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse show" id="shippingInformation">
                <div class="card-body">
                    <ul class="list-group list-group-flush  ">
                        <li class="list-group-item border-0">
                            <p><strong>Shipping Status: </strong>
                                <span class="badge badge-info text-uppercase">
                                    {{ $order->orderStatus->order_status }}
                                </span>
                            </p>
                        </li>
                        <li class="list-group-item border-0">
                            <p><strong>Shipping Fullname:</strong> {{ $order->shipping_fullname }}</p>
                        </li>
                        <li class="list-group-item border-0">
                            <p><strong>Shipping City:</strong> {{ $order->shipping_city }}</p>
                        </li>
                        <li class="list-group-item border-0">
                            <p><strong>Shipping State:</strong> {{ $order->shipping_state }}</p>
                        </li>
                        <li class="list-group-item border-0">
                            <p><strong>Shipping Zip Code:</strong> {{ $order->shipping_zipcode }}</p>
                        </li>
                        <li class="list-group-item border-0">
                            <p><strong>Shipping Phone:</strong> {{ $order->shipping_phone }}</p>
                        </li>
                        <li class="list-group-item border-0">
                            <p><strong>Shipping Address:</strong> {{ $order->shipping_address }}</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    </div>

    <div class="col-lg-12">
        <!-- Products Information -->
        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <a href="#productsInfo" class="d-block card-header py-3" data-toggle="collapse" role="button"
                aria-expanded="true" aria-controls="productsInfo">
                <h6 class="m-0 font-weight-bold text-primary">Product(s) Information</h6>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse show" id="productsInfo">
                <div class="card-body">
                    <table class="table table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Product</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Status</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Each</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->items as $item)
                                <tr>
                                    <th scope="row">{{ ++$loop->index }}</th>
                                    <td>
                                        <img src="{{ asset('images/shoe.jpg') }}" alt="" srcset=""
                                            class="img-thumbnail" style="width: 150px; height: 150px;">
                                    </td>
                                    <td>
                                        {{ $item->name }}
                                    </td>
                                    <td>{{ $order->orderStatus->order_status }}</td>
                                    <td>{{ $item->pivot->quantity }}</td>
                                    <td>#{{ number_format($item->pivot->price, 2) }}</td>
                                    <td>#{{ number_format($item->pivot->quantity * $item->pivot->price, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="text-right">
                        <ul class="list-group list-group-flush  ">
                            <li class="list-group-item border-0">
                                <p><strong>Order Subtotal:</strong> #{{ number_format($order->grand_total, 2) }}</p>
                            </li>
                            <li class="list-group-item border-0">
                                <p><strong>Tax:</strong> #0.00</p>
                            </li>
                            <li class="list-group-item border-0">
                                <p><strong>Shipping:</strong> #0.00</p>
                            </li>
                            <li class="list-group-item border-0">
                                <p><strong>Order Total:</strong> <span
                                        class="text-danger text-bold">#{{ number_format($order->grand_total, 2) }}</span>
                                </p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="col-lg-12">
        <!-- Shipping Information -->
        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <a href="#billingInformation" class="d-block card-header py-3" data-toggle="collapse" role="button"
                aria-expanded="true" aria-controls="billingInformation">
                <h6 class="m-0 font-weight-bold text-primary">Billing Information</h6>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse show" id="billingInformation">
                <div class="card-body">
                    <ul class="list-group list-group-flush  ">
                        <li class="list-group-item border-0">
                            <p><strong>Billing Fullname:</strong> {{ $order->billing_fullname }}</p>
                        </li>
                        <li class="list-group-item border-0">
                            <p><strong>Billing Method:</strong> <span class="badge badge-info">
                                    {{ ucwords($order->paymentMethod->payment_method) }} </span></p>
                        </li>
                        <li class="list-group-item border-0">
                            <p><strong>Billing Phone:</strong> {{ $order->billing_phone }}</p>
                        </li>
                        <li class="list-group-item border-0">
                            <p><strong>Billing Address:</strong> {{ $order->billing_address }}</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    </div>

</div>

@endsection

@push('scripts')

@endpush
