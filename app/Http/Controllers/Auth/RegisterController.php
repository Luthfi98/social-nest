<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\RoleModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{

    public function index()
    {
        $data = [
            'title' => __('Register'),
        ];

        return view('auth.register', $data);
    }
    public function register(Request $request)
    {
        try {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'confirmed', Password::defaults()],
            ]);

            // Get default user role (assuming role_id 2 is for regular users)
            $userRole = RoleModel::where('name', 'User')->first();

            $user = User::create([
                'role_id' => $userRole->id,
                'name' => $request->name,
                'username' => $request->email,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'status' => 'inactive',
            ]);

            // Generate verification token
            $token = Str::random(64);
            $user->verification_token = $token;
            $user->save();

            // Send verification email
            $send = Mail::send('emails.verify-email', ['token' => $token, 'user' => $user], function($message) use($user) {
                $message->to($user->email);
                $message->subject('Email Verification');
            });

            if ($send) {
                return redirect()->route('login')->with('success', 'Registration successful. Please check your email for verification.');
            } else {
                return redirect()->back()->with('error', 'Email verification failed. Please try again.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Registration failed: ' . $e->getMessage());
        }
    }

    public function verifyEmail($token)
    {
        $user = User::where('verification_token', $token)->first();

        if (!$user) {
            return redirect()->route('login')->with('error', 'Invalid verification token');
        }

        $user->status = 'active';
        $user->email_verified_at = now();
        $user->verification_token = null;
        $user->save();

        return redirect()->route('login')->with('success', 'Email verified successfully. You can now login.');
    }
}
