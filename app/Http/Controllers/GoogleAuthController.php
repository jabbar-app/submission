<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            Log::info('🔁 Mulai handleGoogleCallback');

            $googleUser = Socialite::driver('google')->user();
            Log::info('✅ Data dari Google', [
                'id' => $googleUser->getId(),
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'avatar' => $googleUser->getAvatar(),
            ]);

            $user = User::updateOrCreate(
                ['email' => $googleUser->getEmail()],
                [
                    'id' => $googleUser->getId(),
                    'name' => $googleUser->getName(),
                    'google_id' => $googleUser->getId(),
                ]
            );

            Log::info('✅ User berhasil ditemukan atau dibuat', ['user_id' => $user->id]);

            Auth::login($user);
            Log::info('✅ User berhasil login', ['user_id' => $user->id]);

            return redirect()->intended('/dashboard');
        } catch (\Exception $e) {
            Log::error('❌ Gagal login Google', ['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return redirect('/login')->with('error', 'Gagal login Google');
        }
        // try {
        //     Log::info('Menerima callback dari Google.');
        //     $googleUser = Socialite::driver('google')->user();

        //     Log::info('Detail Google User:', [
        //         'id' => $googleUser->id,
        //         'email' => $googleUser->getEmail(),
        //         'name' => $googleUser->getName(),
        //     ]);

        //     $user = User::where('google_id', $googleUser->id)->first();

        //     if (!$user) {
        //         $user = User::where('email', $googleUser->getEmail())->first();
        //         Log::info('Mencari user berdasarkan email. User ditemukan?', ['email_exists' => $user !== null]);
        //     } else {
        //         Log::info('User ditemukan berdasarkan google_id.');
        //     }

        //     if ($user) {
        //         if (empty($user->google_id)) {
        //             $user->google_id = $googleUser->id;
        //             $user->save();
        //             Log::info('Memperbarui google_id untuk user yang sudah ada.');
        //         }
        //         Auth::login($user);
        //         Log::info('User berhasil di-login (existing user). User ID: ' . Auth::id());
        //     } else {
        //         $newUser = User::create([
        //             'name' => $googleUser->getName(),
        //             'email' => $googleUser->getEmail(),
        //             'google_id' => $googleUser->id,
        //             'password' => Hash::make(Str::random(16)),
        //             'email_verified_at' => now(),
        //         ]);
        //         Auth::login($newUser);
        //         Log::info('User baru berhasil dibuat dan di-login. User ID: ' . Auth::id());
        //     }

        //     // Setelah login, periksa apakah user benar-benar terautentikasi
        //     if (Auth::check()) {
        //         Log::info('Auth::check() mengembalikan TRUE setelah login. Redirecting ke dashboard.');
        //         return redirect()->intended('/dashboard');
        //     } else {
        //         Log::error('Auth::check() mengembalikan FALSE setelah upaya login. Kembali ke halaman login.');
        //         // Tambahkan pesan error untuk ditampilkan di view
        //         return redirect('/login')->with('error', 'Login gagal setelah callback. Silakan coba lagi.');
        //     }
        // } catch (\Exception $e) {
        //     Log::error('Error saat login dengan Google: ' . $e->getMessage(), ['exception' => $e]);
        //     return redirect('/login')->with('error', 'Terjadi kesalahan saat mencoba login dengan Google. ' . $e->getMessage());
        // }
    }
}
