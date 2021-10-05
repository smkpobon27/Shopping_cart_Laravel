@extends('user.app')
@section('head')
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="css/custom.css">
@endsection

@section('main-content')
    <section class="hero-wrap hero-wrap-2" style="background-image: url('images/bg_2.jpg');"
        data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-end justify-content-center">
                <div class="col-md-9 ftco-animate mb-5 text-center">
                    <p class="breadcrumbs mb-0"><span class="mr-2"><a href="/">Home <i
                                    class="fa fa-chevron-right"></i></a></span> <span>Products <i
                                class="fa fa-chevron-right"></i></span></p>
                    <h2 class="mb-0 bread">Products</h2>
                </div>
            </div>
        </div>
    </section>
    <section class="ftco-section">
        <div class="container">
            @if (session()->has('success'))
                <h5 class="alert alert-success">{{ session('success') }}</h5>
            @endif
            <div class="row">
                <div class="col-md-9">
                    <div class="row mb-4">
                        <div class="col-md-12 d-flex justify-content-between align-items-center">
                            <h4 class="product-select">Select Types of Products</h4>
                            <select name="category[]" class="selectpicker" multiple>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        {{-- start single product --}}
                        @foreach ($products as $product)
                            <div class="col-md-4 d-flex">
                                <div class="product ftco-animate">
                                    <div class="img d-flex align-items-center justify-content-center"
                                        style="background-image: url({{ asset(Storage::disk('local')->url($product->image)) }});">
                                        <div class="desc">
                                            <p class="meta-prod d-flex">
                                                <a href="/product/add-to-cart/{{ $product->id }}"
                                                    class="d-flex align-items-center justify-content-center"><span
                                                        class="flaticon-shopping-bag"></span></a>
                                                <a href="#" class="d-flex align-items-center justify-content-center"><span
                                                        class="flaticon-heart"></span></a>
                                                <a href="/product/single/{{ $product->id }}"
                                                    class="d-flex align-items-center justify-content-center"><span
                                                        class="flaticon-visibility"></span></a>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="text text-center">
                                        {{-- <span class="sale">Sale</span> --}}
                                        <span class="category">{{ $product->category->name }}</span>
                                        <h2>{{ $product->name }}</h2>
                                        <span class="price">${{ $product->price }}.00</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        {{-- end single product --}}
                    </div>
                    {{-- End row --}}
                    <div class="row mt-5">
                        <div class="col text-center">
                            <div class="block-27 d-flex justify-content-center">
                                {{ $products->links() }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="sidebar-box ftco-animate">
                        <div class="categories">
                            <h3>Product Types</h3>
                            <ul class="p-0">
                                @foreach ($categories as $category)
                                    <li><a href="#">{{ $category->name }} <span class="fa fa-chevron-right"></span></a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="sidebar-box ftco-animate">
                        <h3>Recent Blog</h3>
                        <div class="block-21 mb-4 d-flex">
                            <a class="blog-img mr-4" style="background-image: url(images/image_1.jpg);"></a>
                            <div class="text">
                                <h3 class="heading"><a href="#">Even the all-powerful Pointing has no control about the
                                        blind texts</a></h3>
                                <div class="meta">
                                    <div><a href="#"><span class="fa fa-calendar"></span> Apr. 18, 2020</a></div>
                                    <div><a href="#"><span class="fa fa-comment"></span> 19</a></div>
                                </div>
                            </div>
                        </div>
                        <div class="block-21 mb-4 d-flex">
                            <a class="blog-img mr-4" style="background-image: url(images/image_2.jpg);"></a>
                            <div class="text">
                                <h3 class="heading"><a href="#">Even the all-powerful Pointing has no control about the
                                        blind texts</a></h3>
                                <div class="meta">
                                    <div><a href="#"><span class="fa fa-calendar"></span> Apr. 18, 2020</a></div>
                                    <div><a href="#"><span class="fa fa-comment"></span> 19</a></div>
                                </div>
                            </div>
                        </div>
                        <div class="block-21 mb-4 d-flex">
                            <a class="blog-img mr-4" style="background-image: url(images/image_3.jpg);"></a>
                            <div class="text">
                                <h3 class="heading"><a href="#">Even the all-powerful Pointing has no control about the
                                        blind texts</a></h3>
                                <div class="meta">
                                    <div><a href="#"><span class="fa fa-calendar"></span> Apr. 18, 2020</a></div>
                                    <div><a href="#"><span class="fa fa-comment"></span> 19</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
@endsection
