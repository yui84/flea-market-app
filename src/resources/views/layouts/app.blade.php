<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>フリマアプリ</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('css')
</head>

<body>
    <div class="app">
        <header class="header">
            <img class="header-logo" src="{{ asset('/images/header-logo.png') }}" alt="COACHTECH">
            @yield('link')
        </header>
        <main class="main-content">
            @yield('content')
        </main>
    </div>
</body>

</html>