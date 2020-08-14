<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'isVerified',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function OTP()
    {
        return Cache::get('OTP');
    }

   public function cacheTheOTP()
   {
       $OTP = rand(100000, 999999);
       Cache::put([$this->OTPKey() => $OTP], now()->addSeconds(60));
       return $OTP;
   }


   public function sendOTP($via)
   {
       if ($via === 'sms') {

       } else {
           Mail::to('iamsarder20@gmail.com')->send(new OTPMail($this->cacheTheOTP()));
       }
   }
}
