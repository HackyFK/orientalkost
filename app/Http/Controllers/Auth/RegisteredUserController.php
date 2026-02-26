<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
public function store(Request $request): RedirectResponse
{
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
        'tipe_identitas' => ['required', 'in:nik,nisn,nim,paspor'],
        'nomor_identitas' => ['required', 'string', 'unique:users,nomor_identitas'],
        'phone' => ['required', 'string', 'max:15'],
        'alamat' => ['required', 'string', 'max:255'],
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
    ]);

    // VALIDASI BERDASARKAN TIPE
    $rulesByType = [
        'nik' => ['digits:16'],
        'nisn' => ['digits:10'],
        'nim' => ['max:20'],
        'paspor' => ['regex:/^[A-Za-z0-9]+$/', 'max:20'],
    ];

    $request->validate([
        'nomor_identitas' => $rulesByType[$request->tipe_identitas]
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'tipe_identitas' => $request->tipe_identitas,
        'nomor_identitas' => $request->nomor_identitas,
        'phone' => $request->phone,
        'alamat' => $request->alamat,
        'password' => Hash::make($request->password),
    ]);

    event(new Registered($user));
    Auth::login($user);

    return redirect('/');
}
}
