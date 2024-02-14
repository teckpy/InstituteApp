<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class VerificationController extends Controller
{
    public function show()
    {
        return view('User.verification');
    }

    public function verify(Request $request)
    {
        $otpInput = $request->input('otp');
        $storedOtp = Session::get('otp');

        if ($otpInput == $storedOtp) {
            $user = Auth::user();
            $user->is_verified = true;
            $user->save();

            return redirect('/dashboard');
        } else {
            return back()->withErrors(['otp' => 'Invalid OTP.']);
        }
    }
}
