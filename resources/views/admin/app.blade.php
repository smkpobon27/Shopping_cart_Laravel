<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.layouts.head')
</head>

<body>

    @include('admin.layouts.header')

    <div class="content-wrapper">
        @section('main-content')
        @show
    </div>

    @include('admin.layouts.footer')
</body>

</html>
