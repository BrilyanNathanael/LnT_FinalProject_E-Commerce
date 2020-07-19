@extends('layouts.admin')

@section('content')
    <div class="nav-left">
        <h2 style="color:white;">Admin {{Auth::user()->name}}</h2>
        <div class="kotak" style="background-color:#00d9e1;width:3em;height:.5em;border-radius:10px;margin-bottom:.5em;"></div>
        <a href="/home">Dashboard</a>
        <a href="/list">Info Barang</a>
        <a href="/pengguna">Pengguna Mesunda</a>
        <a href="/terjual">Barang Terjual</a>
        <a href="/create">Menambah Barang</a>
        <a href="/create-kategori" class="active">Menambah Kategori</a>
    </div>
    <div class="content-kategori">
        <form action="/create-kategori" method="POST">
            @csrf
            <div class="tambah-kategori">
                <h2>Menambahkan Kategori</h2>
                <div class="kotak"></div>
            </div>
            <div class="form-group">
                <label for="kategori">Kategori Barang : </label>
                <input type="text" id="kategori" name="kategori" class="form-control @error('kategori') is-invalid @enderror" value="{{ old('kategori') }}">
            </div>
            <div class="form-group" id="button">
                <button type="submit">Simpan</button>
            </div>
        </form>
    </div>
@endsection