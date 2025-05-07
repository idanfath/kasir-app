@extends('layout')
@section('title', 'Buat Transaksi Baru')
@section('content')
    <div class="container mx-auto py-16 px-4">
        <div class="flex justify-between items-center">
            <h2 class="text-3xl font-semibold">Buat Transaksi Baru</h2>
            <button class="primary" onclick="history.back()">Kembali</button>
        </div>
        <x-separator class="my-6" />

        <div class="w-full flex justify-center">
            <form class="flex gap-2 flex-col min-lg:w-[50%] min-xl:w-[40%] w-full" action="{{ route('transaction.store') }}"
                method="post">
                @csrf
                <div id="items-container" class="flex flex-col gap-2"></div>
                <div>Total: <span id="total">Rp.0</span></div>
                <button type="button" class="primary" onclick="addItem()">Add Item</button>
                <x-separator class="my-2" />
                <button type="submit" class="success">Simpan</button>
                <button type="reset" class="warn">Reset</button>
            </form>
        </div>
    </div>

    <script>
        // template row item
        const itemTemplate = `
            <div class="item-row flex flex-wrap gap-2">
                <button type="button" class="delete-btn danger">Hapus</button>
                <select name="item_ids[]" required class="flex-1/2 w-full p-2 border rounded-md">
                    <option value="">Select an item</option>
                    @foreach ($items as $item)
                        <option value="{{ $item->id }}"
                            data-stock="{{ $item->amount }}"
                            data-price="{{ $item->price }}">
                            {{ $item->name }} - {{ config('util.toRupiah')($item->price) }} [{{ $item->amount }}]
                        </option>
                    @endforeach
                </select>
                <input type="number" name="quantities[]" min="1" value="1" required class="flex-1 w-20 p-2 border rounded-md">
                <div class="w-full text-end">Subtotal: <span class="subtotal">Rp.0</span></div>
            </div>
        `;

        // fungsi untuk format ke rupiah
        function formatRupiah(number) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0,
                maximumFractionDigits: 2,
            }).format(number);
        }

        const container = document.getElementById('items-container');

        // hapus item
        container.addEventListener('click', function(e) {
            if (e.target.matches('.delete-btn')) {
                e.target.closest('.item-row').remove();
                calculateTotals();
            }
        });

        // kalkulasi ulang kalau ada select yang berubah
        container.addEventListener('change', calculateTotals);

        // kalkulasi subtotal dan total
        function calculateTotals() {
            const rows = document.querySelectorAll('.item-row');
            let total = 0;

            // Track selected items to prevent duplicates
            const selectedItems = Array.from(document.querySelectorAll('.item-row select'))
                .map(select => select.value)
                .filter(value => value !== "");

            rows.forEach(row => {
                const select = row.querySelector('select');
                const option = select.selectedOptions[0];
                const qtyInput = row.querySelector('input');

                if (!option?.value) return;

                // update max value
                const maxStock = option.dataset.stock;
                qtyInput.max = maxStock;
                qtyInput.value = Math.min(qtyInput.value, maxStock);

                // kalkulasi subtotal
                const subtotal = option.dataset.price * qtyInput.value;
                row.querySelector('.subtotal').textContent = formatRupiah(subtotal);
                total += subtotal;

                // disable itemnya biar ndabisa diselect di select lain
                document.querySelectorAll('.item-row select').forEach(otherSelect => {
                    otherSelect.querySelectorAll('option').forEach(opt => {
                        opt.disabled = selectedItems.includes(opt.value) && opt.value !==
                            otherSelect.value;
                    });
                });
            });

            document.getElementById('total').textContent = formatRupiah(total);
        }

        // tambah item
        function addItem() {
            container.insertAdjacentHTML('beforeend', itemTemplate);
            calculateTotals();
        }
    </script>
@endsection
