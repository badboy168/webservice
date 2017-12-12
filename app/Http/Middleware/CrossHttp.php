<?php

namespace App\Http\Middleware;

use Closure;

class CrossHttp
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $response = $next($request);
        $response->header('Access-Control-Allow-Origin', '*');
//        $response->header('Access-Control-Allow-Headers', 'Origin, Content-Type, Cookie, Accept, multipart/form-data, application/json');
        $response->header('Access-Control-Allow-Methods', 'GET, POST, PATCH, PUT, OPTIONS');
        $response->header('Access-Control-Allow-Credentials', 'false');


//        header('Access-Control-Allow-Origin: *');
//        header("Access-Control-Allow-Credentials: true");
//        header("Access-Control-Allow-Methods: *");
//        header("Access-Control-Allow-Headers: Content-Type,Access-Token");
//        header("Access-Control-Expose-Headers: *");

        return $response;
    }
}
