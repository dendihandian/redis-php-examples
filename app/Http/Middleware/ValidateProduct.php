<?php

namespace App\Http\Middleware;

use Closure;
use App\Product;

class ValidateProduct
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
        // get all paramters
        $input = $request->all();

        // validate product
        $rules = [
          'name' => 'required|string|min:3|max:255',
          'price' => 'required|integer|min:1|max:999999',
          'stock' => 'required|integer|min:1|max:9999',
          'description' => 'nullable|string|min:10',
        ];

        $validator = \Validator::make($input, $rules);
        if ($validator->fails()) {
            return response()->json([
              'message' => 'Validation Error',
              'data' => $validator->errors()
            ], 400);
        }

        return $next($request);
    }
}
