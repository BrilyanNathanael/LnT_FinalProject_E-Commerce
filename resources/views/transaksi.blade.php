<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi</title>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="/css/transaksi.css">
</head>
<body>
    <div class="transaksi-page">
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
        <div class="transaksi-orders">
            @if($transaksi == 0)
            <div class="oops">
                <h2>Ooops..</h2>
                <h2>Tidak ada histori transaksi anda saat ini..</h2>
            </div>
            @else
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Nomor</th>
                        <th scope="col">Invoice</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Kode Pos</th>
                        <th scope="col">Jumlah Barang</th>
                        <th scope="col">Total Harga</th>
                        <th scope="col" style="display:flex;justify-content:center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php $nomor = 1; ?>
                @foreach($groupInvoice as $invoice => $invoices)
                    <?php $jumlahBarang = 0; ?>
                    <?php $hargaBarang = 0; ?>
                    @foreach($invoices as $i)
                        @if($i->user_id == $user->id)
                            <?php $jumlahBarang = $jumlahBarang + $i->jumlah; ?>
                            <?php $hargaBarang = $hargaBarang + ($i->harga * $i->jumlah); ?>
                        @endif
                    @endforeach
    
                    @foreach($invoices as $i)
                        @if($i->user_id == $user->id)
                            <tr>
                                <th>{{$nomor++}}</th>
                                <td>{{$i->order_id}}</td>
                                <td>{{$i->alamat}}</td>
                                <td>{{$i->pos}}</td>
                                <td>{{$jumlahBarang}}</td>
                                <td>{{$hargaBarang}}</td>
                                <td class="aksi">
                                    <a href="/detail-order/{{$i->id}}">Detail</a>
                                    <form action="/reimburse/{{$i->id}}" method="POST">
                                        @method('delete')
                                        @csrf
                                        <button type="submit">Reimburse</button>
                                    </form>
                                </td>
                            </tr>
                        @endif
                        @break
                    @endforeach
                @endforeach
                </tbody>
            </table>
            @endif
        </div>
    </div>
    
</body>
</html>