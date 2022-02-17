<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Services\AffiliateService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'data_center' => ['required', 'int'],
            'email_receive' => ['boolean'],
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        ])->validate();

        $user = \DB::transaction(function() use ($input) {
            /**
             * @var User $user
             */
            $user = User::create([
                'name' => 'User',
                'email' => $input['email'],
                'password' => Hash::make($input['password']),
                'datacenter_id' => $input['data_center'],
                'newsletter' => isset($input['email_receive']) && $input['email_receive'],
            ]);

            // Affiliate
            if($affiliateUser = AffiliateService::instance()->getAffiliateUser()) {
                $user->load("userAffiliate");
                $current = $user->userAffiliate;
                $current->recruited_by = $affiliateUser->id;
                $current->save();
            }

            return $user;
        });

        return $user;
    }
}
