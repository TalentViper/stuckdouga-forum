<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\RegisterMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    //
    public function registerView()
    {
        return view('frontend.auth.register1');
    }

    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users|max:255',
            'full_name' => 'required',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
            'username' => 'required|unique:users',
        ]);

        $userData = $request->only(['email', 'full_name',  'location',  'password', 'username']);
        $userData['password'] = Hash::make($request->input('password'));
        $user = User::create($userData);

        $address = $request['email'];
        auth()->login($user);
        // Toastr::success(__('Your account has been successfully created.'));
        event(new Registered($user));
        return redirect()->route('verification.notice');
    }

    public function created()
    {
        return view('frontend.auth.created');
    }
}
