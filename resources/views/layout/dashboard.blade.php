<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('PAGE_TITLE', 'C0RE :: ASGARD')</title>

    <!-- Bootstrap core CSS -->
    <link href="{{mix('css/app.css')}}" rel="stylesheet">

</head>

<body>

@include('layout.partials.topnav')

<div class="container-fluid">
    <div class="row">

        @include('layout.partials.sidenav')

        <main class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3">
            <h1>@yield('CONTENT_TITLE', 'Page need a title')</h1>

            @yield('content')
        </main>
    </div>
</div>

<script src="{{mix('js/app.js')}}"></script>

</body>
</html>
