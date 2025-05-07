<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @vite('resources/css/app.css')
    @yield('style')
</head>

<body>
    <x-header />

    @if (session('info'))
        <x-notifyer :message="session('info')" type="info" />
    @endif
    @if (session('success'))
        <x-notifyer :message="session('success')" type="success" />
    @endif
    @error('*')
        <x-notifyer :message="$message" type="error" :duration="5000" />
    @enderror

    <div class="min-h-screen">
        @yield('content')
    </div>

    <x-footer />
</body>

</html>
