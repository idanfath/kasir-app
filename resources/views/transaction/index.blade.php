@extends('layout')
@section('title', 'All Transactions')
@section('content')
    @isset($transactions)
        <table>
            <thead>
                <tr>
                    <th>id transaksi</th>
                    <th>total</th>
                    <th>items amount</th>
                    <th>item list</th>
                    <th>actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $tx)
                    <tr>
                        <td>{{ $tx->id }}</td>
                        <td>{{ $tx->total_price }}</td>
                        <td>{{ $tx->details->count() }}</td>
                        <td>
                            <ul>
                                @foreach ($tx->details as $txd)
                                    <li>{{ $txd->item->name }} x{{ $txd->amount }} ({{ $txd->subtotal }})</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>
                            <form action="{{ route('transaction.destroy', $tx) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="button"
                                    onclick="confirm('Yakin ingin menghapus? stock item tidak akan berubah, kamu perlu menambahkan ulang!') ? this.form.submit() : ''">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $transactions->links('pagination::tailwind') }}
    @endisset
@endsection
