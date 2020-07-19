<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Transaksi</title>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="/css/transaksi.css">
</head>
<body>
    <div class="transaksi">
        <div class="navbar-auth">
            <div class="logo">
                <h3>Mesunda</h3>
            </div>
            <div class="nav-list">
                <a href="/home">Home</a>
                <a href="cart">Cart ({{$barang}})</a>
                <a href="/invoice">Transaksi</a>
                <a href="/logout">Logout</a>
                <a>Hi, {{$user->name}}!</a>
            </div>
        </div>
        <div class="transaksi-content">
            <div class="transaksi-all">
                <h3>{{$order->order_id}}</h3>
                <hr>
                <div class="transaksi-list">
                    <div class="transaksi-left">
                        <p>Nama : {{$user->name}}</p>
                        <p>Email : {{$user->email}}</p>
                        <p>Nomor Telepon : {{$user->no_hp}}</p>
                    </div>
                    <div class="transaksi-right">
                        <p>Alamat : {{$order->alamat}}</p>
                        <p>Kode Pos : {{$order->pos}}</p>
                        <p>Jumlah Barang : {{$jumlahBarang}}</p>
                    </div>
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Kategori Barang</th>
                            <th scope="col">Nama Barang</th>
                            <th scope="col">Jumlah Barang</th>
                            <th scope="col">Harga Barang</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $o)
                        <tr>
                            <th scope="row">{{$loop->iteration}}</th>
                            <td>{{$o->kategori}}</td>
                            <td>{{$o->nama_barang}}</td>
                            <td>{{$o->jumlah}}</td>
                            <td>Rp {{number_format($o->harga,0,'.','.')}}</td>
                        </tr>
                        @endforeach
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><strong>Total</strong></td>
                            <td>Rp {{number_format($totalHarga,0,'.','.')}}</td>
                        </tr>
                    </tbody>
                </table>
                <div class="transaksi-aksi">
                    <a href="/invoice">Kembali</a>
                    <form action="/reimburse/{{$order->id}}" method="POST">
                        @method('delete')
                        @csrf
                        <button type="submit">Reimburse</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>