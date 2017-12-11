<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        $this->printSQL();
    }


    private function printSQL()
    {
        DB::listen(function ($closure){

            $tmp = str_replace('?', "'%s'", $closure->sql);
            $sql = vsprintf($tmp, $closure->bindings);
            Log::info($sql);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
