<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('head_scripts')
</head>

<body>
    <div class="min-h-screen flex flex-col">
        @include('inc.header')
        <main class="flex-grow py-8 container">@yield('main')</main>
        @include('inc.footer')
    </div>
    @stack('body_scripts')
</body>

</html>
