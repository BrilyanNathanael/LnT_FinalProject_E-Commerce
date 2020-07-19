<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="/css/show.css">
</head>
<body>
    <div class="show-page">
        <div class="navbar-auth">
            <div class="logo">
                <h3>Mesunda</h3>
            </div>
            <div class="nav-list">
                <a href="/home">Home</a>
                <a href="cart">Cart ({{$cart}})</a>
                <a href="/invoice">Transaksi</a>
                <a href="/logout">Logout</a>
                <a>Hi, {{$user->name}}!</a>
            </div>
        </div>
        <div class="show-content">
            <img src="{{asset('/data_foto/' . $barang->foto)}}" alt="" width="300px" height="350px">
            <div class="show">
                <div class="show-gambar">
                    <h2>{{$barang->nama}}</h2>
                    <div class="kotak"></div>
                </div>
                <div class="content-list">
                    <div class="content">
                        <h4>Harga</h4>
                        <h4>Rp {{number_format($barang->harga,0,".",".")}}</h4>
                    </div>
                    <div class="content">
                        <h4>Kategori</h4>
                        <h4>{{$barang->kategori->kategori}}</h4>
                    </div>
                    <div class="content">
                        <h4>Jumlah Tersedia</h4>
                        <h4>{{$barang->jumlah}}</h4>
                    </div>
                </div>
                <div class="form">
                    <a href="/home">Kembali</a>
                    <form action="{{ url('/cart') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $barang->id }}">
                        <input type="hidden" name="name" value="{{ $barang->nama }}">
                        <input type="hidden" name="price" value="{{ $barang->harga }}">
                        <input type="submit" value="Tambah Ke Keranjang">
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>