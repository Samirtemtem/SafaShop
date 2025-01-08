@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Orders</h1>
    
    <div class="row">
        <div class="col-12">
            @foreach($orders as $order)
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-0">Order #{{ $order->order_number }}</h5>
                            <small class="text-muted">{{ $order->created_at->format('F j, Y g:i A') }}</small>
                        </div>
                        <span class="badge bg-{{ $order->status === 'pending' ? 'warning' : 'success' }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <h6>Customer Details</h6>
                                <p class="mb-1">{{ $order->customer_name }}</p>
                                <p class="mb-1">{{ $order->customer_email }}</p>
                                @if($order->customer_phone)
                                    <p class="mb-1">{{ $order->customer_phone }}</p>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <h6>Shipping Address</h6>
                                <p>{{ $order->shipping_address }}</p>
                            </div>
                        </div>
                        
                        <h6>Order Items</h6>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order->items as $item)
                                        <tr>
                                            <td>{{ $item->product->name }}</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td>€{{ number_format($item->price, 2) }}</td>
                                            <td>€{{ number_format($item->price * $item->quantity, 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3" class="text-end">Subtotal:</td>
                                        <td>€{{ number_format($order->subtotal, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="text-end">Discount:</td>
                                        <td>-€{{ number_format($order->discount, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="text-end"><strong>Total:</strong></td>
                                        <td><strong>€{{ number_format($order->total, 2) }}</strong></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
