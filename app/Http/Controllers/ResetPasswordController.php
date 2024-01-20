<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    public function resetPasswordLoad(Request $request)
    {
        $resetData = PasswordReset::where('token', $request->token)->get();
        if (isset($request->token) && count($resetData) > 0) {
            $user = User::where('email', $resetData[0]['email'])->get();
            return view('resetPassword', compact('user'));
        } else {
            return view('404');
        }
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed'
        ]);

        $user = User::find($request->id);
        $user->password = $request->password;
        $user->save();

        return "<h1>Your password has been reset succesfully</h1>";
    }
}
