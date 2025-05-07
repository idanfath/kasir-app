@extends('layout')
@section('title', 'Tambahkan Item Baru')
@section('content')
    <div class="container mx-auto py-16 px-4">
        <div class="
                flex justify-between items-center ">
            <h2 class="text-3xl font-semibold ">Tambahkan Item Baru</h2>
            <button class="primary" onclick="history.back()">Kembali</button>
        </div>
        <x-separator class="my-6" />
        <div class="w-full flex justify-center">
            <form class="flex gap-2 flex-col min-lg:w-[50%] min-xl:w-[40%] w-full" action="{{ route('item.store') }}"
                method="post">
                @csrf
                <label for="name" class="font-semibold text-lg">Nama <span class="text-red-500">*</span>
                </label>
                <input type="text" name="name" id="name" required placeholder="Masukkan nama item">
                <label for="price" class="font-semibold text-lg">Harga <span class="text-red-500">*</span></label>
                <input type="number" name="price" id="price" required placeholder="Masukkan harga item">
                <label for="amount" class="font-semibold text-lg">Stok <span class="text-red-500">*</span></label>
                <input type="number" name="amount" id="amount" required placeholder="Masukkan jumlah stok item">
                <x-separator class="my-2" />
                <button type="submit" class="success">
                    Simpan
                </button>
                <button type="reset" class="warn">
                    Reset
                </button>
            </form>
        </div>
    </div>
@endsection
