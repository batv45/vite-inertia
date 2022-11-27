<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\Rules\Password;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        //region Fortify Views
        Fortify::loginView(fn () => inertia('auth/login'));
        Fortify::registerView(fn () => inertia('auth/register'));

        Fortify::verifyEmailView(fn () => inertia('auth/verify-email'));

        Fortify::resetPasswordView(fn () => inertia('auth/reset-password',[
            'page_password_rules' => Password::getRules()
        ]));
        Fortify::confirmPasswordView(fn () => inertia('auth/confirm-password'));
        Fortify::requestPasswordResetLinkView(fn () => inertia('auth/forgot-password'));
        //endregion

        //region RateLimiters
        RateLimiter::for('login', function (Request $request) {
            $email = (string) $request->email;

            return Limit::perMinute(5)->by($email.$request->ip());
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });
        //endregion
    }
}
