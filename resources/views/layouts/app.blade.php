<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Perusahaan Mesunda</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <div class="landing">
        @yield('navbar')
        <div class="content-landing">
            <div class="content">
                <h2>Dapatkan <span>Barang</span> Impianmu Bersama</h2>
                <h2>Perusahaan <span>Mesunda</span></h2>
                <div class="kotak"></div>
            </div>
            <img src="/image/shopping-01.png" alt="" width="500px" height="400px">
        </div>
        <div class="content-cards">
            @foreach($barang as $b)
            <a href="/show/{{$b->id}}">
                <div class="cards">
                    <img src="{{asset('/data_foto/' . $b->foto)}}" alt="" width="250px" height="200px">
                    <div class="contents">
                        <h4>{{$b->nama}}</h4>
                        <div class="kotak"></div>
                        <h6>Rp {{number_format($b->harga,0,".",".")}}</h6>
                        <p>Tersedia {{$b->jumlah}}</p>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
        <div class="footer">
            <div class="footer-content">
                <div class="footer-left">
                    <h2>Perusahaan Mesunda</h2>
                    <p>Copyright &copy <strong>Brilyan Nathanael Rumahorbo 2020</strong></p>
                </div>
                <div class="footer-right">
                    <h2>Web Programming</h2>
                    <h2>Learning and Training</h2>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

