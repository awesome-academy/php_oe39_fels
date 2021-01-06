<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ mix('css/library.css') }}">
    <link rel="stylesheet" href="{{ mix('css/admin.css') }}">
    <title>@yield('title')</title>
</head>

<body>
    <div id="warpper" class="nav-fixed">

        @include('admin.layouts.header')

        <!-- end nav  -->
        <div id="page-body" class="d-flex">

            @include('admin.layouts.sidebar')

            <div id="wp-content">
                @yield('content')
            </div>
        </div>


    </div>

    <script src="{{ mix('js/library.js') }}"></script>
    <script src="{{ mix('js/admin.js') }}"></script>
</body>

</html>
