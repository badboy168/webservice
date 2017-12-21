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

        $host = env('ALLOW_ORIGIN_HOST');
        $response = $next($request);

        $response->headers->set('Access-Control-Allow-Origin', $host);
        $response->headers->set('Access-Control-Allow-Headers', 'Origin, Content-Type, Access-Token, Cookie, Accept, multipart/form-data');
        $response->headers->set('Access-Control-Allow-Headers', 'Origin, Content-Type, Cookie, Accept');
        $response->headers->set('Access-Control-Allow-Methods', 'GET, POST, PATCH, PUT, OPTIONS');
//        $response->header('Access-Control-Allow-Methods', 'GET, POST, PATCH, PUT, OPTIONS');
//        $response->header('Access-Control-Allow-Credentials', 'true');

//        header('Access-Control-Allow-Origin: *');
//        header("Access-Control-Allow-Credentials: true");
//        header("Access-Control-Allow-Methods: *");
//        header("Access-Control-Allow-Headers: Content-Type,Access-Token");
//        header("Access-Control-Expose-Headers: *");

        return $response;
    }
}
