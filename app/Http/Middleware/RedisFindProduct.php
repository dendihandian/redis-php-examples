<?php

namespace App\Http\Middleware;

use Closure;
use Predis\Client as Redis;

class RedisFindProduct
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // get id from url parameter
        $id = $request->route()[2]['id'];

        // create redis instance
        $redis = new Redis([
          'scheme' => 'tcp',
          'host'   => env('REDIS_HOST'),
          'port'   => env('REDIS_PORT'),
        ]);

        // check if the product not found in redis
        if (! $redis->exists('products:' . $id)) {

            // prepare response
            $response = [
              'message' => 'Product Not Found',
              'id' => (int) $id,
            ];

            return response()->json($response, 404);
        }

        // add product to request attributes (pass product to the controller)
        $request->attributes->add(['product' => $redis->hgetall('products:' . $id)]);

        return $next($request);
    }
}
