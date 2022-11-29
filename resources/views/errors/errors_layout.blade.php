<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="assets/images/icon/favicon.ico">
    @yield('styles')
</head>

<body>
    <div class="error-area ptb--100 text-center">
        <div class="container">
            <div class="error-content">
               @yield('error-content')
            </div>
        </div>
    </div>
    @yield('scripts')
</body>

</html>