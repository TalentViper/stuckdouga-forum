<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class PasswordController extends Controller
{
    public function forgotPasswordRequest() {
        return view('frontend.auth.forgotPassword');
    }

    public function forgotPassword(Request $request) {
        $request->validate(['email' => 'required|email']);
        $status = Password::sendResetLink(
            $request->only('email')
        );
        if($status === Password::RESET_LINK_SENT) {
            Toastr::success(__('Email was sent successful. Please check your email.'));
            return back()->with(['status' => __($status)]);
        } else {
            Toastr::error(__('Email not found'));
            return back()->withErrors(['email' => __($status)]);
        }
    }

    public function resetPassword(string $token) {
        return view('frontend.auth.resetPassword', ['token' => $token]);
    }

    public function updatePassword(Request $request) {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        if($status === Password::PASSWORD_RESET) {
            Toastr::success(__('Password is updated successful.'));
            return redirect()->route('login')->with('status', __($status));
        } else {
            Toastr::error(__('Operation failed.'));
            return back()->withErrors(['email' => [__($status)]]);
        }
    }
}
