<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="/css/cart.css">
</head>
<body>
    <div class="cart-page">
        <div class="navbar-auth">
            <div class="logo">
                <h3>Mesunda</h3>
            </div>
            <div class="nav-list">
                <a href="/home">Home</a>
                <a href="cart">Cart ({{$barang}})</a>
                <a href="/invoice">Transaksi</a>
                <a href="/logout">Logout</a>
                <a href="">Hi, {{$user->name}}!</a>
            </div>
        </div>
        <div class="checkout-content">
            <div class="checkout">
                <div class="form">
                    <form action="/checkout" method="POST">
                    @csrf
                        <div class="form-group">
                            <label for="alamat" class="alamat">{{ __('Alamat Pengiriman : ') }}</label>
                            <div class="input-alamat">
                                <input id="alamat" type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" value="{{ old('alamat') }}" autofocus>

                                @error('alamat')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="pos">Kode Pos : </label>
                            <div class="input-pos">
                                <input id="pos" type="text" class="form-control @error('pos') is-invalid @enderror" name="pos" value="{{ old('pos') }}" autofocus>

                                @error('pos')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="submit">
                            <button type="submit">Bayar</button>
                        </div>
                    </form>
                </div>
                <div class="prices">
                    <h2>Ringkasan Belanja</h2>
                    <strong>Subtotal : </strong>Rp {{number_format($harga,0,".",".")}} <br>
                    <strong>Total : </strong>Rp {{number_format($harga,0,".",".")}}
                </div>
            </div>
            <div class="preview">
                <h5>Total Jumlah Barang : {{$barang}}</h5>
                @foreach(Cart::content() as $row)
                @if($row->options->user_id === Auth::user()->id)
                <div class="preview-content">
                    <div class="gambar">
                        <img src="{{asset('/data_foto/' . $row->model->foto)}}" alt="" width="60px" height="80px">
                    </div>
                    <div class="details">
                        <p>Nama Barang : {{$row->name}}</p>
                        <p>Kategori Barang : {{$row->model->kategori->kategori}}</p>
                        <p>Jumlah Barang : {{$row->qty}}</p>
                    </div>
                </div>
                @endif
                @endforeach
            </div>
        </div>
    </div>
</body>
</html>