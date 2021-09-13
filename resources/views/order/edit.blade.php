@extends('layouts.admin')
@section('title', 'Dashboard')
@push('styles')

@endpush
@section('content')
@section('header', 'Order Detail')
<div class="row">
    <div class="col-lg-12">
        <!-- Basic Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Update Order</h6>
            </div>
            <ul class="list-group list-group-flush  ">
                <li class="list-group-item border-0">
                    <p><strong>Order Number:</strong> {{ $order->order_number }}</p>
                </li>
                <li class="list-group-item border-0">
                    <p><strong>Order Date:</strong> {{ $order->created_at }}</p>
                </li>
            </ul>
            <div class="card-body">
                <form action="{{ route('orders.update', $order) }}" method="POST">
                    @method('PATCH')
                    @csrf
                    <h4>Payment Status</h4>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label" for="inlineRadio1">
                            <input class="form-check-input" type="radio" name="is_paid" id="inlineRadio1" value="1"
                                @if ($order->is_paid)
                            checked
                            @endif>
                            Paid
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label" for="inlineRadio2">
                            <input class="form-check-input" type="radio" name="is_paid" id="inlineRadio2" value="0"
                                @if (!$order->is_paid)
                            checked
                            @endif>
                            Not Paid
                        </label>
                    </div>
                    <h4 class="mt-3">Shipping Status</h4>
                    @foreach ($order_statuses as $status)
                        <div class="form-check form-check-inline">
                            <label class="form-check-label" for="inlineCheckbox{{ $loop->index }}">
                                <input class="form-check-input" type="radio" name="order_status_id"
                                    id="inlineCheckbox{{ $loop->index }}" value="{{ $status->id }}"
                                    @if ($order->order_status_id == $status->id) checked @endif>
                                {{ ucwords($status->order_status) }}
                            </label>
                        </div>
                    @endforeach
                    <br>
                    <button class="btn btn-primary mt-3" type="submit">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')

@endpush
