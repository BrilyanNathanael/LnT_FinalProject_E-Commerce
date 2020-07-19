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
        <div class="cart-content">
        @if($i == 0)
            <div class="cart-oops">
                <img src="/image/add-to-cart.png" alt="" width="400px" height="300px">
                <div class="text-oops">
                    <h2>Ooops..</h2>
                    <h2>Sepertinya keranjang belanjamu kosong..</h2>
                </div>
            </div>
        @else
            <table class="table table-striped">
                <thead>
                    <h3>Daftar Keranjang</h3>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Gambar</th>
                        <th scope="col">Nama Barang</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach(Cart::content() as $item) 
                    @if($item->options->user_id == Auth::user()->id)
                    <tr>
                        <th scope="row">{{$loop->iteration}}</th>
                        <td>
                            <img src="{{asset('/data_foto/' . $item->model->foto)}}" alt="" width="50px" height="60px">
                        </td>
                        <td>{{$item->name}}</td>
                        <td style="display:flex;flex-direction:column;">
                            @if($item->qty > $item->model->jumlah)
                            <input type="number" min="1" max="{{$item->model->jumlah}}" class="quantity" data-id="{{$item->rowId}}" value="{{$item->qty}}" style="width:3em;">
                            <span style="display:flex;flex-direction:column;">
                                <strong style="color:red;font-size:9px;">Jumlah barang yang tersedia {{$item->model->jumlah}},</strong>
                                <strong style="color:red;font-size:9px;">Harap kurangi jumlah barang</strong>
                            </span>
                            @else
                            <input type="number" min="1" max="{{$item->model->jumlah}}" class="quantity" data-id="{{$item->rowId}}" value="{{$item->qty}}" style="width:3em;">
                            @endif
                        </td>
                        <td>Rp {{number_format($item->price * $item->qty,0,".",".")}}</td>
                        <td>
                            <form action="{{ url('cart', [$item->rowId]) }}" method="POST" class="side-by-side">
                                @csrf
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="submit" class="btn btn-danger btn-sm" value="Hapus">
                            </form>
                        </td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
            <div class="total-cart">
                <img src="/image/add-to-cart.png" alt="" width="400px" height="300px">
                <div class="total">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Total Pembayaran</th>
                                <th scope="col">Jumlah Barang</th>
                            </tr>
                        </thead>
                        <tbody>
                            <h3>Ringkasan Belanja</h3>
                            <tr>
                                <th scope="row">Rp {{number_format($harga,0,".",".")}}</th>
                                <td>{{$barang}}</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="kembali">
                                        <a href="/home">Kembali</a>
                                    </div>
                                </td>
                                <td>
                                    <div class="checkout">
                                        <a href="/checkout">Checkout</a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            @endif
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script>
        (function(){

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.quantity').on('change', function() {
                var id = $(this).attr('data-id')
                $.ajax({
                    type: "PATCH",
                    url: '{{ url("/cart") }}' + '/' + id,
                    data: {
                        'quantity': this.value,
                    },
                    success: function(data) {
                        window.location.href = '{{ url('/cart') }}';
                    }
                });

            });

        })();

    </script>
</body>
</html>