<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index()
    {
        // prepare response
        $response = [
          'message' => 'Product List',
          'data' => Product::all(),
        ];

        return response()->json($response, 200);
    }

    public function store(Request $request)
    {
        // get all parameters
        $input = $request->all();

        // create product
        $product = Product::create([
          'name' => $input['name'],
          'slug' => str_slug($input['name']),
          'stock' => $input['stock'],
          'price' => $input['price'],
          'description' => $input['description'],
        ]);

        // prepare response
        $response = [
          'message' => 'Product Created',
          'data' => $product,
        ];

        return response()->json($response, 201);
    }

    public function show(Request $request, $id)
    {
        // prepare response
        $response = [
          'message' => 'Product Detail',
          'data' => $request->get('product')
        ];

        return response()->json($response, 200);
    }

    public function update(Request $request)
    {
        // get all parameters
        $input = $request->all();

        // get product from id or middleware request next
        $product = $request->get('product');

        // update the product
        $product->name = $input['name'];
        $product->slug = str_slug($input['name']);
        $product->stock = $input['stock'];
        $product->price = $input['price'];
        $product->description = $input['description'];
        $product->save();

        // prepare response
        $response = [
          'message' => 'Product Updated',
          'data' => $product,
        ];

        return response()->json($response, 200);
    }

    public function destroy(Request $request, $id)
    {
        // get product from id or middleware request next
        $product = $request->get('product');

        // delete product in database
        $product->delete();

        // prepare response
        $response = [
          'message' => 'Product Deleted',
          'id' => (int) $id,
        ];

        return response()->json($response, 200);
    }
}
