<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Authenticatable;
use App\Models\Admin;
use App\Models\User;

class LoginController extends Controller
{
    //
    public function loginView()
    {
        return view('frontend.auth.login');
    }

    public function login(Request $request)
    {
        
        $user = User::where('email', $request->email)
             ->first();
        if (blank($user)) {
            Toastr::error(__('User not found'));
            return back()->withInput();
        }

        $remember_me = $request->has('remember_me');
        $credentials = [];

        $credentials = ['email' => $user->email, 'password' => $request->password];
        if (!Hash::check($request->get('password'), $user->password)) {
            Toastr::error(__('Invalid Credentials'));
            return back()->withInput();
        }

        if (Auth::attempt($credentials, $remember_me)) {
            return redirect()->route('account');
        }

        Toastr::error(__('Invalid Credentials'));
        return back()->withInput();

    }



    public function logout(Request $request)
    {
        Auth::logout();
        // $request->session()->flush();

        // $request->session()->regenerate();
        // return redirect()->route('logout');
        return view('frontend.logout');
    }

    public function adminLoginView()
    {
        return view('admin.auth.login');
    }

    public function adminLogin(Request $request)
    {
        $admin = Admin::where('email', $request->email)->first();

        if (blank($admin)):
            Toastr::error(__('User not found'));
            return back()->withInput();
        endif;

        $remember_me = $request->has('remember') ? true : false;

        if ($request->has('email')):
            if (!Hash::check($request->get('password'), $admin->password)):
                Toastr::error(__('Invalid Credentials'));
                return back()->withInput();
            endif;
            $credentials = ['email' => $request->email, 'password' => $request->password];
        endif;

        if(Auth::guard('admin')->attempt($credentials, $remember_me) && Auth::guard('admin')->user()->status != 'pending'){
            return redirect()->route('admin.dashboard');
        }

        Toastr::error(__('Invalid Credentials'));
                return back()->withInput();
    }

    public function adminLogout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->flush();

        $request->session()->regenerate();

        return redirect()->route('admin.login');
    }
}
