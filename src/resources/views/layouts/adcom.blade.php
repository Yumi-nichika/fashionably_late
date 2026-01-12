<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/common.css') }}" />
    @yield('css')
</head>

<body>
    <header class="header">
        <div class="adminHeader__inner">
            <p class="adminHeader__title">FashionablyLate</p>
            <div class="adminHeader__button">@yield('button')</div>
        </div>
    </header>
    <main>
        @yield('main')
    </main>
</body>

</html>