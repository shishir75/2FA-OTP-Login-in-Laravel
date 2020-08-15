<?php

namespace App\Http\Controllers;

use App\Http\Requests\OTPRequest;

class VerifyOTPController extends Controller
{
    public function verify(OTPRequest $request)
    {
        if(request('OTP') == auth()->user()->OTP()) {
            auth()->user()->update(['isVerified'=> true]);
            return redirect('/home');
        }

        return back()->withErrors('OTP is Expired or Invalid');
    }

    public function showVerifyForm()
    {
        return view('OTP.verify');
    }
}
