<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;


class BladeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('date', function ($expression) {
            $default = "'d-m-Y H:i'";           //set default format if not present in $expression
            
            $parts = str_getcsv($expression);
            $parts[1] = (isset($parts[1]))?$parts[1]:$default;   

            
            return '<?php if(' . $parts[0] . '){ echo e(date(' .  $parts[1] . ', strtotime(' . $parts[0] . '))); } ?>';
        });
    }
}
