<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Actions\RedirectIfTwoFactorAuthenticatable;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
		{
		    // ... твої існуючі налаштування, якщо є

		    Fortify::loginView(fn () => view('auth.login'));
		    Fortify::registerView(fn () => view('auth.register'));
		    Fortify::requestPasswordResetLinkView(fn () => view('auth.forgot-password'));
		    Fortify::resetPasswordView(fn ($request) => view('auth.reset-password', ['request' => $request]));
		    Fortify::twoFactorChallengeView(fn () => view('auth.two-factor-challenge'));
		    
		    Fortify::createUsersUsing(CreateNewUser::class);
		    Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
			Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
			Fortify::resetUserPasswordsUsing(ResetUserPassword::class);
		}
}
