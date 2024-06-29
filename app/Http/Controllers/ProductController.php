<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;


class ProductController extends Controller
{
    /**
    * Display a list of resources.
    **/
    public function index()
    {
        $product = Product::all();
        return $product;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
    * Store a newly created resource in storage.
    */
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required',
            'price' => 'required',
            'stock' => 'required'
        ]);

        $product = new Product();
        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->save();

        return $product;
    }

    /**
    * Display the specified resource.
    */
    public function show(Request $request)
    {
        $product = Product::find($request->id);
        if ($product) {
            return $product;
        }
        return response()->json(['id' => $request->id, 'message' => 'Not Found'], 404);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
    * Update the specified resource in storage.
    */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'description' => 'required',
            'price' => 'required',
            'stock' => 'required'
        ]);

        $product = Product::find($request->id);
        if ($product){
            $product->description = $request->description;
            $product->price = $request->price;
            $product->stock = $request->stock;
            $product->save();

            return $product;
        }
        return response()->json(['id' => $request->id, 'message' => 'Not Found'], 404);
    }

    /**
    * Remove the specified resource from storage.
    */
    public function destroy(Request $request, string $id)
    {
        $product = Product::find($id);

        if(is_null($product))
        {
            return response()->json(['id' => $request->id, 'message' => 'Not Found'], 404);
        }

        $product->delete();

        return $product;
    }
}
