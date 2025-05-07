@extends('layout')
@section('title', 'List Items')
@section('content')
    @isset($items)
        <div class="container mx-auto py-16 px-4">
            <div class="
                flex justify-between items-center mb-6">
                <h2 class="text-3xl font-semibold ">Daftar Item</h2>
                <a href="{{ route('item.create') }}">
                    <button class="primary">Tambahkan Item Baru</button>
                </a>
            </div>
            <table class="pretty ">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ config('util.toRupiah')($item->price) }}</td>
                            <td>{{ $item->amount }}</td>
                            <td class="flex gap-2">
                                <form action="{{ route('item.destroy', $item) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button"
                                        onclick="confirm('Apakah Anda yakin ingin menghapus akun ini?') ? this.form.submit() : ''"
                                        class="danger">Hapus</button>
                                </form>
                                <button class="warn">
                                    <a href="{{ route('item.edit', $item) }}" class="edit">Edit
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-4">
                {{ $items->links('pagination::tailwind') }}
            </div>
        </div>
    @endisset
@endsection
