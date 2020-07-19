@extends('layouts.admin')

@section('content')
    <div class="nav-left">
        <h2 style="color:white;">Admin {{Auth::user()->name}}</h2>
        <div class="kotak" style="background-color:#00d9e1;width:3em;height:.5em;border-radius:10px;margin-bottom:.5em;"></div>
        <a href="/home">Dashboard</a>
        <a href="/list" class="active">Info Barang</a>
        <a href="/pengguna">Pengguna Mesunda</a>
        <a href="/terjual">Barang Terjual</a>
        <a href="/create">Menambah Barang</a>
        <a href="/create-kategori">Menambah Kategori</a>
    </div>
    @if($i == null)
    <div class="content-listoops">
        <div class="oops">
            <h2>Oopss..</h2>
            <h2>Anda belum <a href="/create">menambahkan barang.</a></h2>
        </div>
    </div>
    @else
    <div class="content-barang">
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Foto</th>
                <th scope="col">Kategori Barang</th>
                <th scope="col">Nama Barang</th>
                <th scope="col">Jumlah Barang</th>
                <th scope="col">Harga Barang</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($barang as $b)
                <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td>
                        <img src="{{asset('/data_foto/' . $b->foto)}}" alt="" width="50px" height="60px">
                    </td>
                    <td>{{$b->kategori->kategori}}</td>
                    <td>{{$b->nama}}</td>
                    <td>{{$b->jumlah}}</td>
                    <td>Rp {{$b->harga}},00</td>
                    <td>
                        <a href="/edit/{{$b->id}}">Edit</a>
                        <form action="/delete/{{$b->id}}" method="POST">
                            @method('delete')
                            @csrf
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
    @endif
@endsection