<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Psikolog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;

class ForgotPasswordController extends Controller
{
    public function showForm()
    {
        return view('forgot-password');
    }

    public function sendEmail(Request $request){
        $request->validate([
            'email' => 'required|email:dns',
        ]);

        $user = Mahasiswa::where('email', $request->email)->first();

        if (!$user) {
            $user = Psikolog::where('email', $request->email)->first();
        }

        if ($user) {
            $response = Password::broker($user->getTable())->sendResetLink(
                ['email' => $user->email]
            );

            if ($response === Password::RESET_LINK_SENT) {
                return back()->with([
                    'notifikasi' => 'Tautan reset password telah dikirim melalui email.',
                    'type' => 'success'
                ]);
            }

            return back()->with([
                'notifikasi' => __($response),
                'type' => 'error'
            ]);
        }
        else{
            return back()->with([
                'notifikasi' => 'Email tidak ditemukan',
                'type' => 'error'
            ]);
        }
    }

    public function showResetForm(Request $request, $token)
    {
        return view('reset-password', [
            'token' => $token,
            'email' => $request->email,
            'broker' => $this->getBroker($request),
        ]);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email:dns',
            'password' => 'required|confirmed|min:8',
            'password_confirmation' => 'required|same:password'
        ]);

        $credentials = $request->only(
            'email', 'password', 'password_confirmation', 'token'
        );

        $broker = $request->broker;

        $response = Password::broker($broker)->reset(
            $credentials,
            function ($user, $password) use ($broker) {
                if ($broker === 'mahasiswa' && $user->akunMahasiswa) {
                    $user->akunMahasiswa->password = Hash::make($password);
                    $user->akunMahasiswa->save();
                } elseif ($broker === 'psikolog' && $user->akunPsikolog) {
                    $user->akunPsikolog->password = Hash::make($password);
                    $user->akunPsikolog->save();
                }

                event(new PasswordReset($user));
            }
        );


        return $response === Password::PASSWORD_RESET
            ? redirect()->route('loginPage')->with([
                'notifikasi' => __($response),
                'type' => 'success'
            ])
            : back()->with([
                'notifikasi' => __($response),
                'type' => 'error'
            ]);
    }

    protected function getBroker(Request $request)
    {
        if (Mahasiswa::where('email', $request->email)->first()) {
            return 'mahasiswa';
        } elseif (Psikolog::where('email', $request->email)->first()) {
            return 'psikolog';
        }

        return back()->with([
            'notifikasi' => 'Terjadi Kesalahan',
            'type' => 'error'
        ]);
    }
}
