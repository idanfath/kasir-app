@extends('layout')
@section('title', 'Beranda')
@section('content')
    <div class="bg-gray-50">
        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 text-white py-20 px-4">
            <div class="container mx-auto text-center">
                <h1 class="text-5xl font-bold mb-6">Selamat Datang di Aplikasi Kasir</h1>
                <p class="text-xl mb-8">Kelola transaksi dan inventaris Anda dengan mudah dan efisien.</p>
                <a href="{{ route('transaction.create') }}"
                    class="bg-white text-indigo-700 px-8 py-4 rounded-lg shadow-lg font-semibold text-lg hover:bg-gray-100 transition duration-300 ease-in-out transform hover:scale-105">
                    Buat Transaksi Baru
                </a>
            </div>
        </div>
        <div class="container mx-auto py-16 px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div
                    class="bg-white text-center flex flex-col justify-between p-8 rounded-xl shadow-lg hover:shadow-2xl transition-shadow duration-300 ease-in-out">
                    <div>
                        <p class="text-7xl mb-4">💸</p>
                        <h3 class="text-2xl font-semibold text-gray-700 mb-3">Kelola Transaksi</h3>
                        <p class="text-gray-600 mb-6">Catat dan lacak semua transaksi penjualan dengan mudah.</p>
                    </div>
                    <a href="{{ route('transaction.index') }}"
                        class="block w-full bg-blue-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-blue-700 transition duration-300 ease-in-out">
                        Lihat Transaksi
                    </a>
                </div>
                <div
                    class="bg-white text-center flex flex-col justify-between p-8 rounded-xl shadow-lg hover:shadow-2xl transition-shadow duration-300 ease-in-out">
                    <div>
                        <p class="text-7xl mb-4">📦</p>
                        <h3 class="text-2xl font-semibold text-gray-700 mb-3">Kelola Inventaris</h3>
                        <p class="text-gray-600 mb-6">Pantau stok barang dan kelola inventaris secara efisien.</p>
                    </div>
                    <a href="{{ route('item.index') }}"
                        class="block w-full bg-purple-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-purple-700 transition duration-300 ease-in-out">
                        Lihat Inventaris
                    </a>
                </div>
                @if (Auth::check() && Auth::user()->role == 'admin')
                    <div
                        class="bg-white text-center flex flex-col justify-between p-8 rounded-xl shadow-lg hover:shadow-2xl transition-shadow duration-300 ease-in-out ">
                        <div>
                            <p class="text-7xl mb-4">⚙️</p>
                            <h3 class="text-2xl font-semibold text-gray-700 mb-3">Kelola Akun Kasir</h3>
                            <p class="text-gray-600 mb-6">Administrasi akun pengguna untuk kasir.</p>
                        </div>
                        <a href="{{ route('officer.index') }}"
                            class="block w-full bg-red-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-red-700 transition duration-300 ease-in-out">
                            Kelola Akun
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
