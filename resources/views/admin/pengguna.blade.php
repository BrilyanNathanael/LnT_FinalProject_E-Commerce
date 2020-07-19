@extends('layouts.admin')

@section('content')
    <div class="nav-left">
        <h2 style="color:white;">Admin {{Auth::user()->name}}</h2>
        <div class="kotak" style="background-color:#00d9e1;width:3em;height:.5em;border-radius:10px;margin-bottom:.5em;"></div>
        <a href="/home">Dashboard</a>
        <a href="/list">Info Barang</a>
        <a href="/pengguna" class="active">Pengguna Mesunda</a>
        <a href="/terjual">Barang Terjual</a>
        <a href="/create">Menambah Barang</a>
        <a href="/create-kategori">Menambah Kategori</a>
    </div>
    <div class="content-pengguna">
        @if($i == null)
        <div class="content-listoops">
            <div class="oops">
                <h2>Oopss..</h2>
                <h2>Tidak ada pengguna Mesunda yang mendaftar saat ini..</h2>
            </div>
        </div>
        @else
        <table class="table table-striped">
            <thead>
                <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Pengguna</th>
                <th scope="col">Email</th>
                <th scope="col">No. HP</th>
                </tr>
            </thead>
            <tbody>
                <?php $pengguna = 0; ?>
                @foreach($users as $user)
                @if($user->id_admin == 0)
                <?php $pengguna++; ?>
                <tr>
                    <th scope="row">{{$pengguna}}</th>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->no_hp}}</td>
                </tr>
                @endif
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
@endsection