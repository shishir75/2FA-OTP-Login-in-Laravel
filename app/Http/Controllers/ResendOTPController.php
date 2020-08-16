<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResendOTPRequest;
use Illuminate\Http\Request;

class ResendOTPController extends Controller
{
    public function resend(ResendOTPRequest $request)
    {
        return response(null, 201);
    }
}
