@extends('admin.app')

@section('head')
    <link rel="stylesheet" href="{{ asset('admin/dist/css/custom.css') }}">
@endsection

@section('main-content')
    <section class="content">
        <div class="container-fluid">
            <br>
            <div class="row d-flex justify-content-center">
                <div class="col-lg-10">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Create New Product</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="card-body">
                                <div class="form-group">
                                    @if ($errors->has('name'))
                                        <p class="alert alert-danger">{{ $errors->first('name') }}</p>
                                    @endif
                                    <label for="name">Product Name</label>
                                    <input type="text" name="name" class="form-control" id="name"
                                        placeholder="Enter product name">
                                </div>
                                <div class="form-group">
                                    @if ($errors->has('description'))
                                        <p class="alert alert-danger">{{ $errors->first('description') }}</p>
                                    @endif
                                    <label for="description">Description </label>
                                    <textarea name="description" class="form-control" id="description"
                                        placeholder="Enter description "></textarea>
                                </div>
                                <div class="form-group">
                                    @if ($errors->has('price'))
                                        <p class="alert alert-danger">{{ $errors->first('price') }}</p>
                                    @endif
                                    <label for="price">Price</label>
                                    <input type="number" name="price" class="form-control" id="price"
                                        placeholder="Enter price ">
                                </div>
                                <div class="form-group">
                                    @if ($errors->has('category'))
                                        <p class="alert alert-danger">{{ $errors->first('category') }}</p>
                                    @endif

                                    <div class="form-group">
                                        <label>Category</label>
                                        <select class="form-control select2bs4" style="width: 100%;" name="category">
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <!-- /.form-group -->

                                </div>
                                <div class="form-group">
                                    @if ($errors->has('manufact_name'))
                                        <p class="alert alert-danger">{{ $errors->first('manufact_name') }}</p>
                                    @endif
                                    <label for="manufact_name">Manufacturer Name</label>
                                    <input type="text" name="manufact_name" class="form-control" id="manufact_name"
                                        placeholder="Enter manufacturer name">
                                </div>
                                <div class="form-group">
                                    @if ($errors->has('manufact_desc'))
                                        <p class="alert alert-danger">{{ $errors->first('manufact_desc') }}</p>
                                    @endif
                                    <label for="manufact_desc">Manufacturer Description</label>
                                    <textarea name="manufact_desc" class="form-control" id="manufact_desc"
                                        placeholder="Enter About Manufacturer"></textarea>
                                </div>
                                <div class="form-group">
                                    @if ($errors->has('image'))
                                        <p class="alert alert-danger">{{ $errors->first('image') }}</p>
                                    @endif
                                    <label for="image">Product Image</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="image" name="product_image">
                                            <label class="custom-file-label" for="image">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <a href="{{ route('products.index') }}" class="btn btn-warning"
                                        style="margin-left: 15px;">Back</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('footer')
    {{-- <!-- bs-custom-file-input --> --}}
    <script src="{{ asset('admin/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    {{-- <!-- Page specific script --> --}}
    <script>
        $(function() {
            bsCustomFileInput.init();
        });

    </script>
@endsection
