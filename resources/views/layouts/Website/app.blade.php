<!doctype html>
<html lang="en">

<head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="{{ asset('Website/css/style.css') }}">

</head>

<body>

    <section class="ftco-section">

        @include('layouts.Website.nav')

        @yield('content')


    </section>

    <script src="{{ asset('Website/js/jquery.min.js') }}"></script>
    <script src="{{ asset('Website/js/popper.js') }}"></script>
    <script src="{{ asset('Website/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('Website/js/main.js') }}"></script>


</body>

</html>
