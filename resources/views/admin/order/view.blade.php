@extends('admin.app')

@section('main-content')

    <div class="row pt-2 pb-5">
        @if ($singleOrder->shipment_status == 0 && $singleOrder->cancel_status == 0)
            <div class="offset-10 col-lg-1">
                <a href="/admin/order/shipped/{{ $singleOrder->id }}" class="btn btn-success">Shipped</a>
            </div>
        @endif
        @if ($singleOrder->shipment_status == 1 && $singleOrder->cancel_status == 0)
            <div class="offset-9 col-lg-2 text-center">
                <p style="background-color: green;color:white;padding: 8px;border-radius:20px;">Product Shipped</p>
            </div>
        @endif

        @if ($singleOrder->cancel_status == 0 && $singleOrder->shipment_status == 0)
            <div class="col-lg-1">
                <a href="/admin/order/cancelled/{{ $singleOrder->id }}" class="btn btn-danger">Cancel</a>
            </div>
        @endif
        @if ($singleOrder->cancel_status == 1 && $singleOrder->shipment_status == 0)
            <div class="offset-10 col-lg-2 text-center">
                <p style="background-color: rgb(173, 17, 17);color:white;padding: 8px;border-radius:20px;">Order Cancelled
                </p>
            </div>
        @endif

    </div>
    <div class="row">
        <div class="col-lg-6">
            <h3 class="text-center">Order Details</h3>
            <table class="table">
                <thead class="thead-primary">
                    <tr>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $total = 0;
                    @endphp
                    @foreach ($singleOrder->order_products as $order)
                        @php
                            $total += $order->total_price;
                        @endphp
                        <tr class="alert" role="alert">
                            <td>
                                <label class="checkbox-wrap checkbox-primary">
                                    <input type="checkbox" checked>
                                    <span class="checkmark"></span>
                                </label>
                            </td>
                            <td>
                                <img src="{{ asset(Storage::disk('local')->url($order->product->image)) }}" width="50"
                                    height="50" />
                            </td>
                            <td>{{ $order->product->name }}</td>
                            <td>{{ $order->quantity }}</td>
                            <td>{{ $order->total_price }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="offset-1 col-lg-5">
            <h3 class="text-center">Address Details</h3>
            <table>
                <tbody>
                    <tr>
                        <th>Firstname :</th>
                        <td>&nbsp;</td>
                        <td>{{ $singleOrder->address->fname }}</td>
                    </tr>
                    <tr>
                        <th>Lastname :</th>
                        <td>&nbsp;</td>
                        <td>{{ $singleOrder->address->lname }}</td>
                    </tr>
                    <tr>
                        <th>Country :</th>
                        <td>&nbsp;</td>
                        <td>{{ $singleOrder->address->country }}</td>
                    </tr>
                    <tr>
                        <th>Street :</th>
                        <td>&nbsp;</td>
                        <td>{{ $singleOrder->address->street }}</td>
                    </tr>
                    <tr>
                        <th>City :</th>
                        <td>&nbsp;</td>
                        <td>{{ $singleOrder->address->city }}</td>
                    </tr>
                    <tr>
                        <th>Post code :</th>
                        <td>&nbsp;</td>
                        <td>{{ $singleOrder->address->postcode }}</td>
                    </tr>
                    <tr>
                        <th>Phone :</th>
                        <td>&nbsp;</td>
                        <td>{{ $singleOrder->address->phone }}</td>
                    </tr>
                    <tr>
                        <th>Email :</th>
                        <td>&nbsp;</td>
                        <td>{{ $singleOrder->address->email }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-9 mt-5">
            <table>
                <tbody>
                    <tr>
                        <th style="color:rgb(35, 148, 35);">Order Date :</th>
                        <td>{{ date_format($singleOrder->created_at, 'd-M-Y') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-lg-3  mt-5 mb-5">
            <table class="table table-striped">
                <tbody>
                    <tr>
                        <th>Subtotal :</th>
                        <td>&nbsp;</td>
                        <td>${{ $total }}</td>
                    </tr>
                    <tr>
                        <th>Delivery :</th>
                        <td>&nbsp;</td>
                        <td>$0.00</td>
                    </tr>
                    <tr>
                        <th>Total Bill :</th>
                        <td>&nbsp;</td>
                        <td>${{ $total }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
