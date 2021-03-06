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
    <div class="content-editBarang">
        <div class="form-edit">
            <form action="/update/{{$barang->id}}" method="POST" enctype="multipart/form-data">
            @method('patch')
            @csrf
                <div class="edit-barang">
                    <h2>Edit Barang</h2>
                    <div class="kotak"></div>
                </div>
                <div class="form-group" style="display:flex;flex-direction:column;">
                    <label for="foto">Foto : </label>
                    <img src="/data_foto/{{$barang->foto}}" alt="" width="150px" height="150px">
                    <input type="file" id="foto" name="foto">
                </div>
                <div class="form-group">
                    <label for="nama">Nama Barang  : </label>
                    <input type="text" id="nama" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{$barang->nama}}">
                    @error('nama')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="jumlah">Jumlah Barang  : </label>
                    <input type="text" id="jumlah" name="jumlah" class="form-control @error('jumlah') is-invalid @enderror" value="{{$barang->jumlah}}">
                    @error('jumlah')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="harga">Harga Barang  : </label>
                    <div class="harga" style="display:flex;flex-direction:row;">
                        <h3 style="margin-right:.8em;">Rp.</h3>
                        <input type="text" id="harga" name="harga" class="form-control @error('harga') is-invalid @enderror" value="{{$barang->harga}}">
                    </div>
                    @error('harga')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="kategori">Kategori Barang : </label>
                    <select name="kategori" id="kategori" class="form-control @error('kategori') is-invalid @enderror">
                        @foreach($kategori as $k)
                        <option value="{{$k->id}}" {{$k->id == $barang->kategori_id ? 'selected' : ''}}>{{$k->kategori}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="button">
                    <button type="submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection

    