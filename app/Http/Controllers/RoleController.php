<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;

class RoleController extends Controller
{
    public function roleOverview()
    {
      
        // Récupère tous les rôles avec le nombre d'utilisateurs liés
        $roles = Role::withCount('users')->get();
        $users = User::all();
        // dd($users);
        return view('roles', compact('roles', 'users'));
    }

    public function getRoleUsers($id)
    {
        $role = Role::with('users.unit')->findOrFail($id);

        $users = $role->users->map(function ($user) {
            return [
                'id' => $user->id,
                'name' => $user->firstname . ' ' . $user->lastname,
                'unit' => $user->unit->name ?? '—',
            ];
        });

        return response()->json(['users' => $users]);
    }

}
