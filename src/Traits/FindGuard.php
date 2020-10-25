<?php


namespace LaravelMultipleGuards\Traits;


use Exception;
use Illuminate\Contracts\Auth\Factory;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

trait FindGuard
{
    /**
     * ---------------------------------------------------------
     * find the guard type
     * that has been authenticated
     * @param bool $returnGuardNameString
     * @return Factory|Guard|StatefulGuard|Application|string
     * ---------------------------------------------------------
     * @throws Exception
     */
    public function findGuardType(bool $returnGuardNameString = false)
    {
        // validate if its an array
        if (count($this->sliceArray())) {
            // check the guard authenticated by looping
            foreach ($this->sliceArray() as $guard) {
                try {
                    if ((string)$guard !== 'web') {
                        if (Auth::guard((string)$guard)->check()) {
                            if ($returnGuardNameString)
                                return (string)$guard;
                            return auth((string)$guard);
                        }
                    } else {
                        if (Auth::guard()->check()) {
                            if ($returnGuardNameString)
                                return (string)$guard;
                            return auth();
                        }
                    }
                } catch (Exception $exception) {
                    if (app()->environment() === 'local')
                        throw new Exception($exception->getMessage());
                    Log::emergency('This guard does not exists -> ' . $guard);
                    continue;
                }
            }
        } else {
            Log::info('Kindly set the an array of guards in your .env file i.e \'web\',\'admin\'');
        }
    }

    /**
     * -----------------------------------------------------------------
     * set the guard middleware
     * @return string
     * -----------------------------------------------------------------
     * @throws Exception
     * @todo this will help setting and handling multiple
     * auth middleware in one controller i.e auth, auth:admin and so on
     * -----------------------------------------------------------------
     */
    public function setGuardMiddleware()
    {
        // validate if its an array
        if (count($this->sliceArray())) {
            // check the guard authenticated by looping
            foreach ($this->sliceArray() as $guard) {
                try {
                    if ((string)$guard !== 'web') {
                        if (Auth::guard((string)$guard)->check()) {
                            return 'auth:' . $guard;
                        }
                    } else {
                        if (Auth::guard()->check()) {
                            return 'auth';
                        }
                    }
                } catch (Exception $exception) {
                    if (app()->environment() === 'local')
                        throw new Exception($exception->getMessage());
                    Log::emergency('This middleware does not exists -> ' . 'auth:' . $guard);
                    continue;
                }
            }
        } else {
            Log::info('Kindly set a guard middleware in the config/auth.php file.');
        }
    }

    /**
     * Slice and re-arrange the array so that the
     * web guard will always come last
     * @return array|RedirectResponse
     * @throws Exception
     */
    private function sliceArray()
    {
        // define empty array
        $sliced = [];

        try {
            $array = config('laravel-multiple-guards.guards');

            // get array count/length
            $arrayLength = count($array);

            // do the looping
            foreach ($array as $item) {
                if (!in_array($item, $sliced)) {
                    if ($item !== 'web') {
                        array_push($sliced, $item);
                    }

                    if ($arrayLength == 1) {
                        array_push($sliced, 'web');
                    }
                }
                $arrayLength--;
            }

            return $sliced;
        } catch (Exception $exception) {
            if (app()->environment() === 'local')
                throw new Exception($exception->getMessage());
            Log::emergency('Error occurred while slicing and re-arranging the array.');
            return $sliced;
        }
    }
}
