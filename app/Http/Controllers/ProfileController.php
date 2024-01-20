<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;

class ProfileController extends Controller
{
    public function profile()
    {
        try {
            return response()->json(['success' => true, 'data' => auth()->user()]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => $e->getMessage()]);
        }
    }

    public function updateProfile(Request $request)
    {
        if (auth()->user()) {
            $validator = Validator::make($request->all(), [
                'id' => 'required',
                'name' => 'required|string',
                'email' => 'required|email|string'
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors());
            }

            $user = User::find($request->id);
            $user->name = $request->name;
            if ($user->email != $request->email) {
                $user->is_verified = 0;
            }
            $user->email = $request->email;
            $user->save();
            return response()->json(['success' => true, 'msg' => 'User Date', 'data' => $user]);
        } else {
            return response()->json(['success' => false, 'msg' => 'User is not Authenticated']);
        }
    }

    public function sendVerifyMail($email)
    {
        if (auth()->user()) {
            $user = User::where('email', $email)->get();
            if (count($user) > 0) {


                $random = Str::random(40);
                $domain = URL::to('/');
                $url = $domain . '/verify-mail/' . $random;

                $data['url'] = $url;
                $data['email'] = $email;
                $data['title'] = "Email Verification";
                $data['body'] = "Please click here to below to verify your mail";

                Mail::send('verifyMail', ['data' => $data], function ($message) use ($data) {
                    $message->to($data['email'])->subject($data['title']);
                });

                $user = User::find($user[0]['id']);
                $user->remember_token = $random;
                $user->save();

                return response()->json(['success' => true, 'msg' => 'Mail sent successfully']);
            }
        } else {
            return response()->json(['success' => false, 'msg' => 'User is not Authenticated']);
        }
    }

    public function verificationEmail($token)
    {
        $user = User::where('remember_token', $token)->get();

        if (count($user) > 0) {
            $datetime = Carbon::now()->format('Y-m-d H:i:s');
            $user = User::find($user[0]['id']);
            $user->remember_token = '';
            $user->is_verified = '1';
            $user->email_verified_at = $datetime;
            $user->save();

            return "<h1>Email verified success</h1>";
        } else {
            return view('404');
        }
    }
}
