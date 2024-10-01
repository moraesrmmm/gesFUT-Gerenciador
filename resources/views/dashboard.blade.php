
@extends('layout.sidebar')

@section('title', 'Dashboard')

@section('content')

    <h1 class="text-dark text-center">Bem-vindo, {{ auth()->user()->user_nome }}!</h1>

@endsection