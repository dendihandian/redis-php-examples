<?php

namespace App\Http\Middleware;

use Closure;
use App\Product;

class FindProduct
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

        // find product
        $product = Product::find($id);

        // check if the product not found
        if (!$product) {

            // prepare response
            $response = [
              'message' => 'Product Not Found',
              'id' => (int) $id,
            ];

            return response()->json($response, 404);
        }

        // add product to request attributes (pass product to the controller)
        $request->attributes->add(['product' => $product]);

        return $next($request);
    }
}
