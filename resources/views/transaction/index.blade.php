@extends('layout')
@section('title', 'Daftar Transaksi')
@section('content')
    @isset($transactions)
        <div class="container mx-auto py-16 px-4">
            <div class="
                flex justify-between items-center mb-6">
                <h2 class="text-3xl font-semibold ">Daftar Transaksi</h2>
                <a href="{{ route('transaction.create') }}">
                    <button class="primary">Buat Transaksi Baru</button>
                </a>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Total Harga</th>
                        <th>Total Item</th>
                        <th>List Item</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transactions as $tx)
                        <tr>
                            <td>{{ $tx->id }}</td>
                            <td>{{ config('util.toRupiah')($tx->total_price) }}</td>
                            <td>{{ $tx->details->count() }}</td>
                            <td>
                                <ul>
                                    @foreach ($tx->details->take(4) as $txd)
                                        <li>{{ $txd->item->name }} x{{ $txd->amount }}
                                            ({{ config('util.toRupiah')($txd->subtotal) }})
                                        </li>
                                    @endforeach
                                    @if ($tx->details->count() > 4)
                                        <li class="text-gray-500">and {{ $tx->details->count() - 4 }} more items...</li>
                                    @endif
                                </ul>
                            </td>
                            <td class="flex gap-2">
                                <form action="{{ route('transaction.rollback', $tx) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button"
                                        onclick="confirm('Apakah Anda yakin ingin rollback transaksi ini? Item yang berkurang akan dikembalikan dan transaksi akan dihapus') ? this.form.submit() : ''"
                                        class="danger">Rollback
                                    </button>
                                </form>
                                <a href="{{ route('transaction.show', $tx) }}">
                                    <button class="primary">
                                        Detail
                                    </button>
                                </a>
                                <form action="{{ route('transaction.destroy', $tx) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button"
                                        onclick="confirm('Apakah Anda yakin ingin menghapus transaksi ini? Item yang berkurang tidak akan dikembalikan') ? this.form.submit() : ''"
                                        class="danger">Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-4">
                {{ $transactions->links('pagination::tailwind') }}
            </div>
        </div>
    @endisset
@endsection
