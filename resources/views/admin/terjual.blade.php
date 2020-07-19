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
    @if($jumlah == 0)
    <div class="content-listoops">
        <div class="oops">
            <h2>Oopss..</h2>
            <h2>Belum ada barang yang terjual saat ini..</a></h2>
        </div>
    </div>
    @else
    <div class="content-barang">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Nomor</th>
                    <th scope="col">Invoice</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Kode Pos</th>
                    <th scope="col">Jumlah Barang</th>
                    <th scope="col">Total Harga</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php $nomor = 1; ?>
            @foreach($groupInvoice as $invoice => $invoices)
                <?php $jumlahBarang = 0; ?>
                <?php $hargaBarang = 0; ?>
                @foreach($invoices as $i)
                    <?php $jumlahBarang = $jumlahBarang + $i->jumlah; ?>
                    <?php $hargaBarang = $hargaBarang + ($i->harga * $i->jumlah); ?>
                @endforeach
    
                @foreach($invoices as $i)
                    <tr>
                        <th>{{$nomor++}}</th>
                        <td>{{$i->order_id}}</td>
                        <td>{{$i->alamat}}</td>
                        <td>{{$i->pos}}</td>
                        <td>{{$jumlahBarang}}</td>
                        <td>Rp {{number_format($hargaBarang,0,'.','.')}}</td>
                        <td class="aksi">
                            <a href="/detail-order/{{$i->id}}">Detail</a>
                        </td>
                    </tr>
                    @break
                @endforeach
            @endforeach
            </tbody>
        </table>
    </div>
    @endif
@endsection