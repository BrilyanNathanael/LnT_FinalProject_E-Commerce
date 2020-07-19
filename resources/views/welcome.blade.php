@extends('layouts.app')

@section('navbar')
<div class="navbar">
    <div class="logo">
        <h3>Mesunda</h3>
    </div>
    <div class="nav-list">
        <a href="{{route('login')}}">Masuk</a>
        <span><a href="{{route('register')}}">Daftar</a></span>
    </div>
</div>
@endsection