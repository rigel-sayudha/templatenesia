<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            $request->session()->regenerate();
            return response()->json([
                'ok' => true,
                'message' => 'Login berhasil.',
                'user' => Auth::user()
            ]);
        }

        return response()->json([
            'ok' => false,
            'message' => 'Email atau kata sandi yang Anda masukkan salah.'
        ], 401);
    }
    public function register(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6',
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            Auth::login($user);
            $request->session()->regenerate();

            return response()->json([
                'ok' => true,
                'message' => 'Pendaftaran berhasil. Selamat datang!',
                'user' => $user
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'ok' => false,
                'message' => 'Proses validasi gagal.',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'ok' => false,
                'message' => 'Terjadi kesalahan sistem saat mendaftar.'
            ], 500);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json([
            'ok' => true,
            'message' => 'Logout berhasil.'
        ]);
    }

    public function redirectToProvider($provider)
    {
        if (!in_array($provider, ['google', 'facebook'])) {
            return redirect('/')->with('error', 'Provider otentikasi tidak didukung.');
        }
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        if (!in_array($provider, ['google', 'facebook'])) {
            return redirect('/')->with('error', 'Provider otentikasi tidak didukung.');
        }

        try {
            $socialUser = Socialite::driver($provider)->user();
        } catch (\Exception $e) {
            return redirect('/')->with('error', 'Gagal memverifikasi akun ' . ucfirst($provider) . '. Harap coba lagi.');
        }

        $user = User::where('email', $socialUser->getEmail())
                    ->orWhere($provider . '_id', $socialUser->getId())
                    ->first();

        if ($user) {
            if (empty($user->{$provider . '_id'})) {
                $user->{$provider . '_id'} = $socialUser->getId();
            }
            if (empty($user->avatar)) {
                $user->avatar = $socialUser->getAvatar();
            }
            $user->save();
        } else {
            $user = User::create([
                'name' => $socialUser->getName() ?? $socialUser->getNickname(),
                'email' => $socialUser->getEmail(),
                'password' => Hash::make(Str::random(16)),
                $provider . '_id' => $socialUser->getId(),
                'avatar' => $socialUser->getAvatar(),
            ]);
        }

        Auth::login($user, true);

        return redirect()->intended('/');
    }
}
