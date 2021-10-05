@extends('user.app')

@section('head')
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css">
@endsection

@section('main-content')
    <section class="hero-wrap hero-wrap-2" style="background-image: url({{ asset('images/bg_2.jpg') }});"
        data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-end justify-content-center">
                <div class="col-md-9 ftco-animate mb-5 text-center">
                    <p class="breadcrumbs mb-0"><span class="mr-2"><a href="/">Home <i
                                    class="fa fa-chevron-right"></i></a></span> <span>Checkout <i
                                class="fa fa-chevron-right"></i></span></p>
                    <h2 class="mb-0 bread">Checkout</h2>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-10 ftco-animate">
                    {{-- checkout form --}}
                    <form id="order-form" action="/order" class="billing-form" method="POST">
                        {{ csrf_field() }}
                        <h3 class="mb-4 billing-heading">Billing Details</h3>
                        <div class="row align-items-end">
                            <div class="col-md-6">
                                <div class="form-group">
                                    @if ($errors->has('fname'))
                                        <p class="alert alert-danger">{{ $errors->first('fname') }}</p>
                                    @endif
                                    <label for="firstname">Firt Name</label>
                                    <input name="fname" type="text" id="firstname" class="form-control"
                                        placeholder="Enter first name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    @if ($errors->has('lname'))
                                        <p class="alert alert-danger">{{ $errors->first('lname') }}</p>
                                    @endif
                                    <label for="lastname">Last Name</label>
                                    <input name="lname" id="lastname" type="text" class="form-control"
                                        placeholder="Enter last name">
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="country">State / Country</label>
                                    <div class="select-wrap">
                                        <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                        <select name="country" id="country" class="form-control">
                                            <option value="bangladesh">Bangladesh</option>
                                            <option value="italy">Italy</option>
                                            <option value="philippines">Philippines</option>
                                            <option value="south korea">South Korea</option>
                                            <option value="hongkong">Hongkong</option>
                                            <option value="japan">Japan</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    @if ($errors->has('street'))
                                        <p class="alert alert-danger">{{ $errors->first('street') }}</p>
                                    @endif
                                    <label for="streetaddress">Street Address</label>
                                    <input name="street" type="text" class="form-control" id="streetaddress"
                                        placeholder="House number and street name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control"
                                        placeholder="Appartment, suite, unit etc: (optional)">
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    @if ($errors->has('city'))
                                        <p class="alert alert-danger">{{ $errors->first('city') }}</p>
                                    @endif
                                    <label for="towncity">Town / City</label>
                                    <input name="city" type="text" id="towncity" class="form-control"
                                        placeholder="Enter city">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    @if ($errors->has('postcode'))
                                        <p class="alert alert-danger">{{ $errors->first('postcode') }}</p>
                                    @endif
                                    <label for="postcodezip">Postcode / ZIP *</label>
                                    <input name="postcode" type="text" class="form-control" id="postcodezip"
                                        placeholder="Enter postcode">
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    @if ($errors->has('phone'))
                                        <p class="alert alert-danger">{{ $errors->first('phone') }}</p>
                                    @endif
                                    <label for="phone">Phone</label>
                                    <input name="phone" type="text" id="phone" class="form-control"
                                        placeholder="Enter phone number">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    @if ($errors->has('email'))
                                        <p class="alert alert-danger">{{ $errors->first('email') }}</p>
                                    @endif
                                    <label for="emailaddress">Email Address</label>
                                    <input name="email" id="emailaddress" type="email" class="form-control"
                                        placeholder="Enter email">
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-12">
                                <div class="form-group mt-4">
                                    <div class="radio">
                                        <label class="mr-3"><input type="radio" name="optradio"> Create an Account? </label>
                                        <label><input type="radio" name="optradio"> Ship to different address</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form><!-- END -->

                    @php
                        $total = 0;
                    @endphp
                    @if (session()->get('cart'))
                        @foreach (session()->get('cart') as $id => $details)
                            @php
                                $total += $details['price'] * $details['quantity'];
                            @endphp
                        @endforeach
                    @endif
                    <div class="row mt-5 pt-3 d-flex">
                        <div class="col-md-6 d-flex">
                            <div class="cart-detail cart-total p-3 p-md-4">
                                <h3 class="billing-heading mb-4">Cart Total</h3>
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
                        </div>
                        <div class="col-md-6">
                            <div class="cart-detail p-3 p-md-4">
                                <h3 class="billing-heading mb-4">Payment Method</h3>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="radio">
                                            <label><input type="radio" name="optradio" class="mr-2"> Direct Bank
                                                Tranfer</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="radio">
                                            <label><input type="radio" name="optradio" class="mr-2"> Check Payment</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="radio">
                                            <label><input type="radio" name="optradio" class="mr-2"> Paypal</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="checkbox">
                                            <label><input type="checkbox" value="" class="mr-2"> I have read and accept the
                                                terms and conditions</label>
                                        </div>
                                    </div>
                                </div>
                                <p><a id="order-btn" class="btn btn-primary py-3 px-4">Place an order</a></p>
                            </div>
                        </div>
                    </div>
                </div> <!-- .col-md-8 -->
            </div>
        </div>
    </section>
@endsection

@section('footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#order-btn').click(function(e) {
                e.preventDefault();
                console.log("clicked");

                $('#order-form').submit();
            });
        });

    </script>
@endsection
