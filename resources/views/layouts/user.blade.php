<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('css')
</head>
<body>
    <div class="landing">
        <div class="navbar-auth">
            <div class="logo">
                <h3>Mesunda</h3>
            </div>
            <div class="nav-list">
                <a href="">Home</a>
                <a href="">Cart</a>
                <a href="/logout">Logout</a>
                <a href="">Hi, {{$user->name}}!</a>
            </div>
        </div>
        @yield('content')
    </div>
</body>
</html>