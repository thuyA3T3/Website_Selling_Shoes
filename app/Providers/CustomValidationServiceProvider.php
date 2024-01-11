<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;


use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class CustomValidationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('password', function ($attribute, $value, $parameters, $validator) {
            return Hash::check($value, Auth::guard('customer')->user()->password);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
