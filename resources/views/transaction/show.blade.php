@extends('layout')
@section('title', 'Daftar Transaksi')
@section('content')
    <div class="container mx-auto py-16 px-4">
        <div class="
                flex justify-between items-start mb-6">
            <div>
                <h2 class="text-3xl font-semibold ">Daftar Transaksi</h2>
                <p class="text-gray-500">ID Transaksi: {{ $transaction->id }}</p>
                <p class="text-gray-500">Total Harga: {{ config('util.toRupiah')($transaction->total_price) }}</p>
                <p class="text-gray-500">Total Item: {{ $transaction->details->count() }}</p>
                <p class="text-gray-500">Tanggal Transaksi: {{ $transaction->created_at->format('d-m-Y H:i:s') }}</p>
            </div>
            <div class="flex gap-2 flex-col items-end">
                <button class="primary" onclick="history.back()">Kembali</button>
                <form action="{{ route('transaction.rollback', $transaction) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button"
                        onclick="confirm('Apakah Anda yakin ingin rollback transaksi ini? Item yang berkurang akan dikembalikan dan transaksi akan dihapus') ? this.form.submit() : ''"
                        class="danger">Rollback
                    </button>
                </form>
                <form action="{{ route('transaction.destroy', $transaction) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button"
                        onclick="confirm('Apakah Anda yakin ingin menghapus transaksi ini? Item yang berkurang tidak akan dikembalikan') ? this.form.submit() : ''"
                        class="danger">Hapus
                    </button>
                </form>
            </div>
        </div>
        <table>
            <thead>
                <tr>
                    <th>ID Detail Transaksi</th>
                    <th>ID Item</th>
                    <th>Nama Item</th>
                    <th>Harga Satuan (Saat Dibeli)</th>
                    <th>Jumlah Dibeli</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($details as $txd)
                    <tr>
                        <td>{{ $txd->id }}</td>
                        <td>{{ $txd->item->id }}</td>
                        <td>{{ $txd->item->name }}</td>
                        <td>{{ config('util.toRupiah')($txd->subtotal / $txd->amount) }}</td>
                        <td>{{ $txd->amount }}</td>
                        <td>{{ config('util.toRupiah')($txd->subtotal) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4">
            {{ $details->links('pagination::tailwind') }}
        </div>
    </div>
@endsection
