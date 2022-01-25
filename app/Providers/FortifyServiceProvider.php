<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Models\User;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Features;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if (request()->isAdmin()) {
            config([
                // Change guard and prefix
                'fortify.guard' => 'admin',
                'fortify.prefix' => 'admin',

                // Disable registration
                'fortify.features' => array_diff(config("fortify.features"), [
                    Features::registration()
                ])
            ]);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Fortify::loginView(request()->isAdmin() ? 'admin.auth.login' : 'auth.login');

        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            return Limit::perMinute(5)->by($request->email.$request->ip());
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        // Login
        Fortify::authenticateUsing(function (Request $request) {
            /**
             * @var User $user
             */
            $user = User::where('email', $request->email)->first();

            dd(1);

            // Not a user or wrong password
            if (!$user || !Hash::check($request->password, $user->password)) {
                return false;
            }

            // Login to admin
            if($request->isAdmin() && ($user->isAdminAccount() || $user->isSupportAccount() || $user->isEditorAccount())) {
                return $user;
            }

            // Login to customer panel
            if(!$request->isAdmin() && ($user->isCustomerAccount() || $user->isTaxAdvisorAccount() || $user->isAffiliateAccount())) {
                return $user;
            }

            return null;
        });
    }
}
