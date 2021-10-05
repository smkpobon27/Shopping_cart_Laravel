@extends('user.app')

@section('main-content')
    <section class="hero-wrap hero-wrap-2" style="background-image: url({{ asset('images/bg_2.jpg') }});"
        data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-end justify-content-center">
                <div class="col-md-9 ftco-animate mb-5 text-center">
                    <p class="breadcrumbs mb-0"><span class="mr-2"><a href="/">Home <i
                                    class="fa fa-chevron-right"></i></a></span> <span>Cart <i
                                class="fa fa-chevron-right"></i></span></p>
                    <h2 class="mb-0 bread">My Cart</h2>
                </div>
            </div>
        </div>
    </section>
    {{-- End Hero --}}

    <section class="ftco-section">
        <div class="container">
            <div class="row">
                <div class="table-wrap">
                    @if (session()->has('success'))
                        <h5 class="alert alert-success">{{ session('success') }}</h5>
                    @endif
                    <table class="table">
                        <thead class="thead-primary">
                            <tr>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>total</th>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $total = 0;
                            @endphp
                            @if (session('cart'))
                                @foreach (session('cart') as $id => $details)
                                    @php
                                        $total += $details['price'] * $details['quantity'];
                                    @endphp
                                    <tr class="alert" role="alert">
                                        <td>
                                            <label class="checkbox-wrap checkbox-primary">
                                                <input type="checkbox" checked>
                                                <span class="checkmark"></span>
                                            </label>
                                        </td>
                                        <td>
                                            <div class="img"
                                                style="background-image: url({{ asset(Storage::disk('local')->url($details['photo'])) }});">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="email">
                                                <span>{{ $details['name'] }}</span>
                                                <span>Fugiat voluptates quasi nemo, ipsa perferendis</span>
                                            </div>
                                        </td>
                                        <td>{{ $details['price'] }}</td>
                                        <td class="quantity">
                                            <div class="input-group">
                                                <input type="text" name="quantity" class="qnty form-control input-number"
                                                    value="{{ $details['quantity'] }}" min="1" max="100">
                                            </div>
                                        </td>
                                        <td>{{ $details['price'] * $details['quantity'] }}</td>
                                        <td>
                                            <button type="button" class="close update-cart" data-id={{ $id }}>
                                                <span aria-hidden="true"><i class="fa fa-refresh"></i></span>
                                            </button>
                                        </td>
                                        <td>
                                            <button type="button" class="close remove-from-cart" data-dismiss="alert"
                                                aria-label="Close" data-id="{{ $id }}">
                                                <span aria-hidden="true"><i class="fa fa-close"></i></span>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <br>
            <div class="row justify-content-end">
                <div class="col col-lg-3 ftco-animate">
                    <p class="text-center"><a href="/products" class="btn btn-primary py-3 px-4">Continue Shopping</a>
                    </p>
                </div>
            </div>
            <div class="row justify-content-end">
                <div class="col col-lg-5 col-md-6 mt-5 cart-wrap ftco-animate">
                    <div class="cart-total mb-3">
                        <h3>Cart Totals</h3>
                        <p class="d-flex">
                            <span>Subtotal</span>
                            <span>${{ $total }}</span>
                        </p>
                        <p class="d-flex">
                            <span>Delivery</span>
                            <span>$0.00</span>
                        </p>
                        <p class="d-flex">
                            <span>Discount</span>
                            <span>$0.00</span>
                        </p>
                        <hr>
                        <p class="d-flex total-price">
                            <span>Total</span>
                            <span>${{ $total }}</span>
                        </p>
                    </div>
                    <p class="text-center"><a href="/checkout" class="btn btn-primary py-3 px-4">Proceed to Checkout</a>
                    </p>
                </div>
            </div>
        </div>
        {{ csrf_field() }}
    </section>
@endsection

@section('footer')
    <script type="text/javascript">
        $(".update-cart").click(function(e) {
            e.preventDefault();
            var ele = $(this);

            $.ajax({
                url: "/update-cart",
                type: "PUT",
                data: {
                    id: ele.attr("data-id"),
                    quantity: ele.parents("tr").find(".qnty").val(),
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    window.location.reload();
                }

            });
        });

        $(document).ready(function() {
            $(".remove-from-cart").click(function(e) {
                e.preventDefault();
                var ele = $(this);

                if (confirm("Are you sure?")) {
                    $.ajax({
                        url: "/remove-from-cart",
                        type: 'post',
                        data: {
                            _method: 'delete',
                            _token: '{{ csrf_token() }}',
                            id: ele.attr("data-id")
                        },
                        success: function(response) {
                            window.location.reload();
                        }

                    });
                }
            });
        });

    </script>
@endsection
