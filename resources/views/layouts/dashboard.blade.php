<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{config('app.name')}} :: @yield('PAGE_TITLE', '')</title>

    <!-- Bootstrap core CSS -->
    <link href="{{mix('css/app.css')}}" rel="stylesheet">
    @stack('css')

</head>

<body>

@include('layouts.partials.topnav')

<div class="container-fluid">
    <div class="row">

        @include('layouts.partials.sidenav')

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">

            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
                <h1 class="h2">@yield('CONTENT_TITLE', 'Page needs a title')</h1>

                @yield('button-bar')
            </div>

            @include('layouts.partials.notifications')

            @yield('content')
        </main>
    </div>
</div>

<script src="{{mix('js/manifest.js')}}"></script>
<script src="{{mix('js/vendor.js')}}"></script>
<script src="{{mix('js/app.js')}}"></script>

@stack('js')

</body>
</html>
