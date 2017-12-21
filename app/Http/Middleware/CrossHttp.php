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

        $host = isset($_SERVER['HTTP_ORIGIN'])?$_SERVER['HTTP_ORIGIN']:"";
        $allowHost = explode(',', getenv("ALLOW_ORIGIN_HOST"));
        if(in_array($host, $allowHost) && $host)
        {
            $response->headers->set('Access-Control-Allow-Origin', $host);
            $response->headers->set('Access-Control-Allow-Headers', 'Origin, Content-Type, Access-Token, Cookie, Accept, multipart/form-data');
            $response->headers->set('Access-Control-Allow-Headers', 'Origin, Content-Type, Cookie, Accept');
            $response->headers->set('Access-Control-Allow-Methods', 'GET, POST, PATCH, PUT, OPTIONS');
            $response->header('Access-Control-Allow-Credentials', 'true');
        }


        return $response;
    }
}
