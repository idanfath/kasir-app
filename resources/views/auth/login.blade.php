@extends('layout')
@section('title', 'Login')
@section('content')
    <form action="{{ route('login.post') }}" method="post">
        @csrf
        <input type="email" name="email" required placeholder="email">
        <input type="password" name="password" required placeholder="password">
        <button type="submit">
            Login
        </button>
        <button type="reset">
            Reset
        </button>
    </form>
@endsection
