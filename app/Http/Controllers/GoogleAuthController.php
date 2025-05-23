<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class GoogleAuthController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            // Cari user berdasarkan google_id atau email
            $user = User::where('google_id', $googleUser->id)->first();

            if (!$user) {
                // Jika tidak ada user dengan google_id tersebut, coba cari berdasarkan email
                $user = User::where('email', $googleUser->getEmail())->first();
            }

            if ($user) {
                // Update google_id jika user sudah ada tapi belum terhubung dengan Google ID ini
                if (empty($user->google_id)) {
                    $user->google_id = $googleUser->id;
                    $user->save();
                }
                Auth::login($user); // Login user yang sudah ada
            } else {
                // Buat user baru jika belum ada
                $newUser = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->id,
                    'password' => Hash::make(Str::random(16)), // Buat password acak yang aman
                    'email_verified_at' => now(), // Anggap email sudah diverifikasi oleh Google
                ]);
                Auth::login($newUser); // Login user baru
            }

            return redirect()->intended('/dashboard'); // Arahkan ke dashboard atau halaman tujuan
        } catch (\Exception $e) {
            // Tangani error, misalnya, redirect kembali ke halaman login dengan pesan error
            return redirect('/login')->with('error', 'Gagal login dengan Google: ' . $e->getMessage());
        }
    }
}
