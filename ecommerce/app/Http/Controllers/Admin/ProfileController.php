<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function updateName(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:3|max:50',
        ]);

        $admin = Auth::guard('admin')->user();
        $admin->name = $request->name;
        $admin->save();

        return back()->with('success', 'Name updated successfully!');
    }
}
