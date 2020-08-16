<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResendOTPRequest;
use Illuminate\Http\Request;

class ResendOTPController extends Controller
{
    public function resend(ResendOTPRequest $request)
    {
        auth()->user()->sendOTP($request->otp_via);
        return back()->with('message', 'Your new OTP is sent, Please check');
    }
}
