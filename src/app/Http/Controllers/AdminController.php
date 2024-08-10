<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function createRepresentative()
    {
        return view('admin.representative.create');
    }

    public function storeRepresentative(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        $user->assignRole('store_representative');

        return redirect()->route('admin.representative.list')->with('message','店舗代表者が作成されました');
    }

    public function listRepresentatives()
    {
        $representatives = User::role('store_representative')->get();

        return view('admin.representative.list',compact('representatives'));
    }

    public function destroyRepresentative($id)
    {
        $representative = User::findOrFail($id);
        $representative->delete();

        return redirect()->route('admin.representative.list')->with('message','店舗代表者が削除されました');
    }

}
