<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Unit;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function create()
    {
        $units = Unit::all();
        // dd($units); // Debugging line to check units
        return view('auth.register', compact('units'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'unit_id' => 'required|exists:units,id',
        ]);
         // Debugging line to check request data
        User::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'unit_id' => $request->unit_id,
            'role_id' => 4, // Par défaut, un rôle "Utilisateur", à adapter
        ]);

        return redirect()->route('login')->with('success', 'Account successfully created. You can now log in.');
    }

}
