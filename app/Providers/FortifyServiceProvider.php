<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\Fortify;
use App\Models\User;
use Livewire\Livewire;

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
        /*Fortify::loginView(function () {
            return view('auth.login');
        });

        Fortify::authenticateUsing(function (Request $request) {
            $user = User::where('email', $request->email)->first();

            if ($user &&
                Hash::check($request->password, $user->password)) {
                return $user;
            }
        });*/

        Fortify::registerView(function () {
            return view('auth.register');
        });

        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);
        Fortify::twoFactorChallengeView('auth.two-factor-challenge');
        /*Fortify::TwoFactorAuthenticationForm()*/

        /*Fortify::TwoFactorAuthenticationForm(function() {
            return view('auth.fergot-password');
        });*/

        Fortify::requestPasswordResetLinkView(function() {
            return view('auth.fergot-password');
        });

        Fortify::resetPasswordView(function($request) {
            return view('auth.reset-password', ['request' => $request]);
        });
    }
}