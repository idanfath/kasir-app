<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Item;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = Transaction::with(["details"])->paginate(10);
        return view("transaction.index", compact("transactions"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $items = Item::select("id", "name", "price", "amount")->get();
        return view("transaction.create", compact("items"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $v = $request->validate([
                "item_ids" => "required|array",
                "item_ids.*" => "required|exists:items,id",
                "quantities" => "required|array",
                "quantities.*" => "required|numeric",
            ]);

            $totalprice = 0;
            $transaction = Transaction::create([
                "total_price" => 0
            ]);

            foreach ($v["item_ids"] as $index => $value) {
                $item = Item::findOrFail($value);
                $qty = $v["quantities"][$index];

                if ($qty > $item->amount) {
                    throw new \Exception("Stock tidak mencukupi $item->name, $qty, $item->amount");
                }

                // update total price
                $totalprice += $item->price * $qty;

                // update item
                $item->amount -= $qty;
                $item->save();

                // buat detail transaksi
                TransactionDetail::create([
                    "transaction_id" => $transaction->id,
                    "item_id" => $value,
                    "amount" => $v["quantities"][$index],
                    "subtotal" =>  $v["quantities"][$index] * $item->price
                ]);
            }

            // commit transaksi
            $transaction->total_price = $totalprice;
            $transaction->save();
            DB::commit();
            return redirect()->back()->with("success", "Berhasil membuat transaksi");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        $details = $transaction->details()->with('item')->paginate(10);
        return view("transaction.show", compact("transaction", "details"));
    }

    public function destroy(Transaction $transaction)
    {
        try {
            $transaction->delete();
            return redirect()->back()->with("success", "Berhasil menghapus transaksi");
        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function rollback(Transaction $transaction)
    {
        DB::beginTransaction();
        try {
            foreach ($transaction->details as $detail) {
                $item = Item::findOrFail($detail->item_id);
                $item->amount += $detail->amount;
                $item->save();
            }
            $transaction->delete();
            DB::commit();

            if (url()->previous() === route('transaction.show', $transaction->id)) {
                return redirect()->route('transaction.index')->with("success", "Berhasil rollback transaksi");
            }
            return redirect()->back()->with("success", "Berhasil rollback transaksi");
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
}
