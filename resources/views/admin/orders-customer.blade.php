@extends('layouts.admin')

@section('content')
    <div class="nav-left">
        <h2 style="color:white;">Admin {{Auth::user()->name}}</h2>
        <div class="kotak" style="background-color:#00d9e1;width:3em;height:.5em;border-radius:10px;margin-bottom:.5em;"></div>
        <a href="/home">Dashboard</a>
        <a href="/list">Info Barang</a>
        <a href="/pengguna">Pengguna Mesunda</a>
        <a href="/terjual" class="active">Barang Terjual</a>
        <a href="/create">Menambah Barang</a>
        <a href="/create-kategori">Menambah Kategori</a>
    </div>
    <div class="transaksi-content">
            <div class="transaksi-all">
                <h3>{{$order->order_id}}</h3>
                <hr>
                <div class="transaksi-list">
                    <div class="transaksi-left">
                        <p>Nama : {{$customer->name}}</p>
                        <p>Email : {{$customer->email}}</p>
                        <p>Nomor Telepon : {{$customer->no_hp}}</p>
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
                    <a href="/terjual">Kembali</a>
                </div>
            </div>
        </div>
@endsection