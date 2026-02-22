<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AdminTwoFactorController extends Controller
{
    public function index()
    {
        if (!session()->has('admin_2fa_id')) {
            return redirect()->route('admin.login');
        }
        return view('admin.auth.verify');
    }

    public function store(Request $request)
    {
        $request->validate([
            'two_factor_code' => 'required|integer',
        ]);

        if (!session()->has('admin_2fa_id')) {
            return redirect()->route('admin.login');
        }

        $adminId = session('admin_2fa_id');
        $admin = Admin::find($adminId);

        if (!$admin) {
             return redirect()->route('admin.login')->withErrors(['email' => 'Session expired.']);
        }

        if ($admin->two_factor_code == $request->two_factor_code && 
            $admin->two_factor_expires_at->gt(Carbon::now())) {

            // Reset 2FA code
            $admin->two_factor_code = null;
            $admin->two_factor_expires_at = null;
            $admin->save();

            // Login
            Auth::guard('admin')->login($admin);
            session()->forget('admin_2fa_id');

            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['two_factor_code' => 'Invalid or expired code.']);
    }

    public function resend()
    {
         if (!session()->has('admin_2fa_id')) {
            return redirect()->route('admin.login');
        }

        $adminId = session('admin_2fa_id');
        $admin = Admin::find($adminId);
        
        if($admin) {
            $code = rand(100000, 999999);
            $admin->two_factor_code = $code;
            $admin->two_factor_expires_at = Carbon::now()->addMinutes(10);
            $admin->save();
             return back()->with('success', 'Code resent.');
        }

        return redirect()->route('admin.login');
    }
}
