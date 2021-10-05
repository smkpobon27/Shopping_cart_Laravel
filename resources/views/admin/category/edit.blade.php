@extends('admin.app')

@section('head')
    <link rel="stylesheet" href="{{ asset('admin/dist/css/custom.css') }}">
@endsection

@section('main-content')
    <section class="content">
        <div class="container-fluid">
            <br>
            <div class="row">
                <div class="col-lg-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Edit Category</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('categories.update', $category->id) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <div class="card-body">
                                <div class="form-group">
                                    @if ($errors->has('name'))
                                        <p class="alert alert-danger">{{ $errors->first('name') }}</p>
                                    @endif
                                    <label for="category">Category Name</label>
                                    <input type="text" name="name" class="form-control" id="category"
                                        placeholder="Enter category name" value={{ $category->name }}>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <a href="{{ route('categories.index') }}" class="btn btn-warning"
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
