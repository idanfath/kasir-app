<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class OfficerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $officers = User::where('role', 'officer')->paginate(10);
        return view('officer.index', compact('officers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('officer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $v = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:6|confirmed',
            ]);

            User::create($v);
            return redirect()->route('officer.index')->with('success', 'Sukses menambah officer');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    // public function show(string $id)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $officer)
    {
        return view('officer.edit', compact('officer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $officer)
    {
        try {
            $v = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $officer->id,
                'password' => 'nullable|string|min:6|confirmed',
            ]);

            if (!$request->filled('password')) {
                unset($v['password']);
            }

            $officer->update($v);
            return redirect()->route('officer.index')->with('success', 'Sukses mengupdate data officer');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $officer)
    {
        try {
            $officer->delete();
            return redirect()->back()->with('success', 'Sukses menghapus officer');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
}
