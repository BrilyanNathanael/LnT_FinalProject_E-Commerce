@extends('layouts.app')

@section('navbar')
<div class="navbar-auth">
    <div class="logo">
        <h3>Mesunda</h3>
    </div>
    <div class="nav-list">
        <a href="/home">Home</a>
        <a href="cart">Cart ({{$cart}})</a>
        <a href="/invoice">Transaksi</a>
        <a href="/logout">Logout</a>
        <a>Hi, {{$user->name}}!</a>
    </div>
</div>
@endsection