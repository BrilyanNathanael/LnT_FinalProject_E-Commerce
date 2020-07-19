<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="/css/admin.css">
</head>
<body>
    <div class="admin-page">
        <div class="navbar-admin">
            <div class="logo">
                <h3>Mesunda</h3>
            </div>
            <div class="nav-list">
                <a href="/logout">Logout</a>
            </div>
        </div>
        <div class="admin-content">
            @yield('content')
        </div>
    </div>
</body>
</html>