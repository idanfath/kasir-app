<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Transaction;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::paginate(10);
        return view("item.index", compact("items"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("item.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $v = $request->validate([
                "name" => "required|string|max:255|unique:items,name",
                "price" => "numeric|min:0|required",
                "amount" => "numeric|min:0|required",
            ]);
            Item::create($v);
            return redirect("/")->with("success", "successfully added item");
        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        return view("item.edit", compact("item"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    {
        try {
            $v = $request->validate([
                "name" => "sometimes|required|string|max:255|unique:items,name" . $item->id,
                "price" => "numeric|min:0|sometimes|required",
                "amount" => "numeric|min:0|sometimes|required",
            ]);
            $item->update($v);
            return redirect()->route("item.index")->with("success", "successfully updated item");
        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        try {
            $item->delete();
            return redirect()->back()->with("success", "successfully deleted item");
        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
}
