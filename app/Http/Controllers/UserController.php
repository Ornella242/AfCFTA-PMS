<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Notifications\SendUserPassword;
use Illuminate\Support\Facades\Notification;
use App\Models\User;
use App\Models\Role;  
use App\Models\Unit; 
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $units = Unit::all();
        $roles = Role::all();
        $users = User::with(['unit', 'role'])->get();
        return view('users', compact('users','units', 'roles'));
    }

    public function adminDashboard()
    {
        // Logique pour afficher le dashboard Admin
        return view('dashboards.admin');
    }

    public function memberDashboard()
    {
        // Logique pour afficher le dashboard Member
        return view('dashboards.member');
    }


    public function create()
    {
        $units = Unit::all();
        $roles = Role::all();
        return view('createuser', compact('units', 'roles'));
    }


    public function store(Request $request)
    {
        $user = Auth::user();
        //  dd($user);
        if ($user->role->name === 'Admin') {
            $request->validate([
                'firstname' => 'required|string|max:255',
                'lastname' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'unit_id' => 'required|exists:units,id',
                'role_id' => 'required|exists:roles,id',
            ]);
    //  dd($request->all());
            // Générer un mot de passe sécurisé
            $specialChars = ['!', '@', '#', '$', '%', '^', '&', '*'];
            $uppercase = strtoupper(Str::random(1));
            $number = rand(0, 9);
            $special = $specialChars[array_rand($specialChars)];
            $rest = Str::random(5);
            $generatedPassword = str_shuffle($rest . $uppercase . $number . $special);
            $hashedPassword = Hash::make($generatedPassword);

            // Créer l'utilisateur
            $newUser = User::create([
                'firstname' => $request->firstname,
                'lastname'  => $request->lastname,
                'email'     => $request->email,
                'password'  => $hashedPassword,
                'unit_id'   => $request->unit_id,
                'role_id'   => $request->role_id,
            ]);
            // Envoyer la notification
            $newUser->notify(new SendUserPassword($generatedPassword));
            return redirect()->route('users')->with('success', 'User successfully created and password sent by email');
        } else {
            // Si pas admin
            $request->validate([
                'firstname' => 'required|string|max:255',
                'lastname' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:8',
                'unit_id' => 'required|exists:units,id',
                'role_id' => 'required|exists:roles,id',
            ]);

            User::create([
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'unit_id' => $request->unit_id,
                'role_id' => $request->role_id,
            ]);

            return redirect()->route('users')->with('success', 'User successfully created.');
        }
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'unit_id' => 'required|exists:units,id',
            'role_id' => 'required|exists:roles,id',
        ]);

        $user->update($request->only('firstname', 'lastname', 'email', 'unit_id', 'role_id'));

        return redirect()->route('users')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users')->with('success', 'User deleted successfully.');
    }

    public function updateRole(Request $request, $id)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id',
        ]);
        $user = User::findOrFail($id);
        $user->role_id = $request->role_id;
        $user->save();
        // dd($user);

        return redirect()->route('roles.overview')->with('success', 'User role updated successfully.');
    }

    public function assignRole(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'role_id' => 'required|exists:roles,id',
        ]);
        $user = User::findOrFail($request->user_id);
        // Check if user already has a role
        if ($user->role_id) {
            return redirect()->back()->with('error', 'This user already has a role. Please edit it instead.');
        }

        // Assign the role
        $user->role_id = $request->role_id;
        $user->save();

        return redirect()->route('roles.overview')->with('success', 'Role assigned successfully.');
    }


}
