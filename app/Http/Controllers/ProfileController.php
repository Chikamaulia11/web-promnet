<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Hash; 

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('pages.profile.index', compact('user'));
    }
    public function update(Request $request)
    {
    $user = Auth::user();

    $request->validate([
        'name'     => 'required|string|max:255',
        'password' => 'nullable|confirmed', 
        'photo'    => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $user->name = $request->name;

    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    }

    if ($request->hasFile('photo')) {
        $fileName = time() . '.' . $request->photo->extension();
        $request->photo->move(public_path('assets/img'), $fileName);
        $user->photo = $fileName;
    }

    $user->save();

    return back()->with('success', 'Profil berhasil diperbarui!');
}
}
