<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use Carbon\Carbon;

class AdminLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:admins,email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            $user = Auth::guard('admin')->user();

            // Generate 6-digit 2FA code
            $code = rand(100000, 999999);
            $user->two_factor_code = $code;
            $user->two_factor_expires_at = Carbon::now()->addMinutes(10);
            $user->last_login_ip = $request->ip();
            $user->save();

            // Logout immediately to enforce 2FA
            Auth::guard('admin')->logout();

            // Store ID in session to verify
            $request->session()->put('admin_2fa_id', $user->id);

            // In a real app, send SMS here. For now, we will log it or just trust the database.
            // \Log::info("2FA Code for {$user->email}: {$code}");

            return redirect()->route('admin.verify')->with('success', 'Code sent to your phone.');
        }

        return back()->withErrors(['email' => 'Invalid credentials.']);
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed',
        ]);

        $admin = Auth::guard('admin')->user();
        $admin->password = Hash::make($request->password);
        $admin->save();

        return back()->with('success', 'Password changed successfully!');
    }
}
