@extends('layout')
@section('title', 'New Transaction')

@section('content')
    <form action="{{ route('transaction.store') }}" method="post">
        @csrf

        <div id="items-container">
        </div>

        <div>
            Total: Rp.<span id="total">0</span>
        </div>

        <button type="button" onclick="addNewItem()">Add Item</button>
        <button type="submit">Save Transaction</button>
    </form>
    <script>
        const itemTemplate = `
            <div class="item-row">
                <select name="item_ids[]" required>
                    <option value="">Select an item</option>
                    @foreach ($items as $item)
                        <option value="{{ $item->id }}"
                            data-stock="{{ $item->amount }}"
                            data-price="{{ $item->price }}">
                            {{ $item->name }} - Rp{{ $item->price }} [{{ $item->amount }}]
                        </option>
                    @endforeach
                </select>
                <input type="number" name="quantities[]" min="1" value="1" required>
                <span class="subtotal">Rp.0</span>
                <button type="button" class="delete-btn">×</button>
            </div>
        `;

        const container = document.getElementById('items-container');
        container.addEventListener('click', e =>
            e.target.matches('.delete-btn') &&
            e.target.closest('.item-row').remove() &&
            updateTotals());
        container.addEventListener('change', updateTotals);

        function updateTotals() {
            document.getElementById('total').textContent = [...document.querySelectorAll('.item-row')].reduce((total,
                row) => {
                const option = row.querySelector('select').selectedOptions[0];
                if (!option?.value) return total;

                const qty = row.querySelector('input');
                qty.max = option.dataset.stock;
                qty.value = Math.min(qty.value, qty.max);

                const subtotal = option.dataset.price * qty.value;
                row.querySelector('.subtotal').textContent = `Rp.${subtotal}`;
                return total + subtotal;
            }, 0);
        }

        window.addNewItem = () => (container.insertAdjacentHTML('beforeend', itemTemplate), updateTotals());
    </script>
@endsection
