<?php


namespace LaravelMultipleGuards\Traits;


use Illuminate\Contracts\Auth\Factory;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

trait FindGuardType
{
    /**
     * find the guard type
     * that has been authenticated
     * @param bool $returnGuardNameString
     * @return Factory|Guard|StatefulGuard|Application|string
     */
    public function findGuardType(bool $returnGuardNameString = false)
    {
        // validate if its an array
        if (count(config('laravel-multiple-guards.guards'))) {
            // check the guard authenticated by looping
            foreach (config('laravel-multiple-guards.guards') as $guard) {
                // validate if the guard driver exists
                if (auth()->getDefaultDriver() === $guard)
                    if (Auth::guard((string)$guard)->check()) {
                        if ($returnGuardNameString)
                            return (string)$guard;
                        return auth((string)$guard);
                    }

                Log::emergency('This guard does not exists -> ' . $guard);
            }
        } else {
            Log::info('Kindly set the an array of guards in your .env file i.e \'web\',\'admin\'');
        }
    }
}
