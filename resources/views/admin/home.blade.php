@extends('layouts.admin')

@section('content')
    <div class="nav-left">
        <h2 style="color:white;">Admin {{Auth::user()->name}}</h2>
        <div class="kotak" style="background-color:#00d9e1;width:3em;height:.5em;border-radius:10px;margin-bottom:.5em;"></div>
        <a href="/home" class="active">Dashboard</a>
        <a href="/list">Info Barang</a>
        <a href="/pengguna">Pengguna Mesunda</a>
        <a href="/terjual">Barang Terjual</a>
        <a href="/create">Menambah Barang</a>
        <a href="/create-kategori">Menambah Kategori</a>
    </div>
    <div class="content">
        <div class="welcoming">
            <h2>Selamat Datang, Admin {{$user->name}} !</h2>
            <div class="ajakan">
                <p>Apakah ada hal yang ingin diperbaharui?</p>
                <div class="baru">
                    <a href="/create">
                        <div class="barang">
                            Barang
                        </div> 
                    </a>
                    <a href="/create-kategori">
                        <div class="kategori">
                            Kategori
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="keterangan">
            <div class="list">
                <div class="list-info">
                    <?php $count = 0; ?>
                    @foreach($users as $u)
                        @if($u->id_admin == 0)
                        <?php $count++; ?>
                        @endif
                    @endforeach
                    <h2><?php echo $count; ?></h2>
                    <h4>Pengguna Mesunda</h4>
                </div>
                <img src="/image/user.png" alt="" width="40px" height="40px">
            </div>
            <div class="list">
                <img src="/image/cart-admin.png" alt="" width="40px" height="40px">
                <div class="list-info">
                    <?php $count = 0; ?>
                    @foreach($barang as $b)
                        <?php $count++; ?>
                    @endforeach
                    <h2><?php echo $count; ?></h2>
                    <h4>Jenis Barang</h4>
                </div>
            </div>
            <div class="list">
                <div class="list-info">
                    <?php $count = 0; ?>
                    @foreach($order as $o)
                    <?php $count++; ?>
                    @endforeach
                    <h2><?php echo $count; ?></h2>
                    <h4>Barang Terjual</h4>
                </div>
                <img src="/image/sale.png" alt="" width="40px" height="40px">
            </div>
            <div class="list">
                <img src="/image/wallet.png" alt="" width="40px" height="40px">
                <div class="list-info">
                    <?php $countHarga = 0; ?>
                    @foreach($order as $o)
                    <?php $countHarga += ($o->harga * $o->jumlah); ?>
                    @endforeach
                    <h2>Rp {{number_format($countHarga,0,".",".")}}</h2>
                    <h4>Pendapatan</h4>
                </div>
            </div>
        </div>
    </div>
@endsection