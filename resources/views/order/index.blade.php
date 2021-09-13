@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')
@section('header', 'Order')
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Orders</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Order Number</th>
                        <th>Delivery Status</th>
                        <th>Grand Total</th>
                        <th>Item Count</th>
                        <th>Payment Method</th>
                        <th>Paid</th>
                        <th>Shipping FullName</th>
                        <th>Shipping Phone</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->user->name }}</td>
                            <td>{{ $order->order_number }}</td>
                            <td>{{ strtoupper($order->orderStatus->order_status) }}</td>
                            <td>#{{ number_format($order->grand_total, 2) }}</td>
                            <td>{{ $order->item_count }}</td>
                            <td>{{ ucwords($order->paymentMethod->payment_method) }}</td>
                            <td>
                                @if ($order->is_paid)
                                    <span class="badge badge-success">Paid</span>
                                @else
                                    <span class="badge badge-warning">Not Paid</span>
                                @endif
                            </td>
                            <td>{{ $order->shipping_fullname }}</td>
                            <td>{{ $order->shipping_phone }}</td>
                            <td>
                                <div class="dropdown dropleft">
                                    <a class="btn btn-primary dropdown-toggle" href="#" role="button"
                                        id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        Actions link
                                    </a>
                                    <div class="dropdown-menu action" aria-labelledby="dropdownMenuLink">
                                        <div class="dropdown-item">
                                            <a class="btn btn-warning btn-md w-100"
                                                href="{{ route('orders.show', $order) }}" role="button">View</a>
                                        </div>
                                        <div class="dropdown-item">
                                            <a class="btn btn-info btn-md w-100"
                                                href="{{ route('orders.edit', $order) }}" role="button">Edit</a>
                                        </div>
                                        <div class="dropdown-item">
                                            <form action="{{ route('orders.destroy', $order) }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button class="btn btn-danger btn-md w-100">Delete</button>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

@include('partials.data-table-scripts')
