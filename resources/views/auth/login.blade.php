@extends('layout')
@section('title', 'Masuk')
@section('content')
    <div class="container mx-auto py-16 px-4">
        <div class="
                flex justify-between items-center ">
            <h2 class="text-3xl font-semibold ">Masuk Ke Kasir App</h2>
            <button class="primary" onclick="history.back()">Kembali</button>
        </div>
        <x-separator class="my-6" />
        <div class="w-full flex justify-center">
            <form class="flex gap-2 flex-col min-lg:w-[50%] min-xl:w-[40%] w-full" action="{{ route('login.post') }}"
                method="post">
                @csrf
                <label for="email" class="font-semibold text-lg">Email <span class="text-red-500">*</span></label>
                <input type="email" name="email" id="email" required placeholder="Masukkan email kasir">
                <label for="password" class="font-semibold text-lg">Password <span class="text-red-500">*</span></label>
                <input type="password" name="password" id="password" required placeholder="Masukkan password kasir">
                <x-separator class="my-2" />
                <button type="submit" class="success">
                    Masuk
                </button>
            </form>
        </div>
    </div>
@endsection
