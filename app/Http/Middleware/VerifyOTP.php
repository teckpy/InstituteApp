<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Twilio\Rest\Client;
use Illuminate\Foundation\Bus\Dispatchable;

class VerifyOTP
{
    use Dispatchable;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    private $otp;

    public function __construct($otp)
    {
        $this->otp = $otp;
    }

    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        if (!$user->is_verified) {
            // Use the provided OTP
            $this->sendSMS($user->phone_number, $this->otp);
            //$this->sendEmail($user->email, $this->otp);

            Session::put('otp', $this->otp);
            return redirect()->route('verification.show');
        }

        return $next($request);
    }

    private function sendSMS($to, $otp)
    {
        $client = new Client(config('services.twilio.sid'), config('services.twilio.token'));

        $client->messages->create(
            $to,
            [
                'from' => config('services.twilio.from'),
                'body' => "Your OTP is: $otp",
            ]
        );
    }
}
