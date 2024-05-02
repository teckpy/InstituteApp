<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Twilio\Rest\Client;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'mobile' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        $otp = mt_rand(100000, 999999);

        return User::create([
            'name' => $input['name'],
            'mobile' => $input['mobile'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'otp' => $otp
        ]);

        $user = Auth::user();
        if (!$user->is_verified) {

            $this->sendSMS($user->phone_number, $otp);
            Session::put('otp', $otp);
        }
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
