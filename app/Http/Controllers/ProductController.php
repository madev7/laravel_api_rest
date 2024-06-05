<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

/**
* @OA\Info(
*             title="Api Products", 
*             version="1.0",
* )
*/
class ProductController extends Controller
{
    /**
    * Display a list of resources.
    *
    * Display all records
    * @OA\Get (
    *     path="/api/products",
    *     tags={"Products"},
    *     @OA\Response(
    *         response=200,
    *         description="Success",
    *         @OA\JsonContent(
    *             @OA\Property(
    *                 type="array",
    *                 property="rows",
    *                 @OA\Items(
    *                     type="object",
    *                     @OA\Property(
    *                         property="id",
    *                         type="number",
    *                         example="1"
    *                     ),
    *                     @OA\Property(
    *                         property="description",
    *                         type="string",
    *                         example="TV Sony"
    *                     ),
    *                     @OA\Property(
    *                         property="price",
    *                         type="float",
    *                         example="100.0"
    *                     ),
    *                     @OA\Property(
    *                         property="stock",
    *                         type="integer",
    *                         example="1"
    *                     ),
    *                     @OA\Property(
    *                         property="created_at",
    *                         type="string",
    *                         example="2023-02-23T00:09:16.000000Z"
    *                     ),
    *                     @OA\Property(
    *                         property="updated_at",
    *                         type="string",
    *                         example="2023-02-23T12:33:45.000000Z"
    *                     )
    *                 )
    *             )
    *         )
    *     )
    * )
    */
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
    * 
    * @OA\Post (
    *     path="/api/products",
    *     tags={"Product"},
    *     @OA\RequestBody(
    *         @OA\MediaType(
    *             mediaType="application/json",
    *             @OA\Schema(
    *                 @OA\Property(
    *                      type="object",
    *                      @OA\Property(
    *                          property="description",
    *                          type="string"
    *                      ),
    *                      @OA\Property(
    *                          property="price",
    *                          type="float"
    *                      ),
    *                      @OA\Property(
    *                          property="stock",
    *                          type="integer"
    *                      )
    *                 ),
    *                 example={
    *                     "description":"TV Sony",
    *                     "price":"100.0",
    *                     "stock":"1"
    *                }
    *             )
    *         )
    *      ),
    *      @OA\Response(
    *          response=201,
    *          description="CREATED",
    *          @OA\JsonContent(
    *              @OA\Property(property="id", type="number", example=1),
    *              @OA\Property(property="description", type="string", example="TV Sony"),
    *              @OA\Property(property="price", type="float", example="100.0"),
    *              @OA\Property(property="stock", type="integer", example="1"),
    *              @OA\Property(property="created_at", type="string", example="2023-02-23T00:09:16.000000Z"),
    *              @OA\Property(property="updated_at", type="string", example="2023-02-23T12:33:45.000000Z")
    *          )
    *      ),
    *      @OA\Response(
    *          response=422,
    *          description="UNPROCESSABLE CONTENT",
    *          @OA\JsonContent(
    *              @OA\Property(property="message", type="string", example="The description field is required."),
    *              @OA\Property(property="errors", type="string", example="error"),
    *          )
    *      )
    * )
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
    * 
    * @OA\Get (
    *     path="/api/products/{id}",
    *     tags={"Product"},
    *     @OA\Parameter(
    *         in="path",
    *         name="id",
    *         required=true,
    *         description="A unique integer value identifying this product.",
    *         @OA\Schema(type="integer")
    *     ),
    *     @OA\Response(
    *         response=200,
    *         description="Success",
    *         @OA\JsonContent(
    *              @OA\Property(property="id", type="number", example=1),
    *              @OA\Property(property="description", type="string", example="TV Sony"),
    *              @OA\Property(property="price", type="float", example="100.0"),
    *              @OA\Property(property="stock", type="integer", example="1"),
    *              @OA\Property(property="created_at", type="string", example="2023-02-23T00:09:16.000000Z"),
    *              @OA\Property(property="updated_at", type="string", example="2023-02-23T12:33:45.000000Z")
    *        )
    *     ),
    *     @OA\Response(
    *         response=404,
    *         description="NOT FOUND",
    *         @OA\JsonContent(
    *              @OA\Property(property="message", type="string", example="No query results for model [App\Models\Product] #id"),
    *         )
    *     )
    * )
    */
    public function show(Request $request)
    {
        $product = Product::findOrFail($request->id);
        return $product;
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
    * 
    * @OA\Put (
    *     path="/api/products/{id}",
    *     tags={"Product"},
    *     @OA\Parameter(
    *         in="path",
    *         name="id",
    *         required=true,
    *         @OA\Schema(type="integer")
    *     ),
    *     @OA\RequestBody(
    *         @OA\MediaType(
    *             mediaType="application/json",
    *             @OA\Schema(
    *                @OA\Property(
    *                      type="object",
    *                      @OA\Property(
    *                          property="description",
    *                          type="string"
    *                      ),
    *                      @OA\Property(
    *                          property="price",
    *                          type="float"
    *                      ),
    *                      @OA\Property(
    *                          property="stock",
    *                          type="integer"
    *                      )
    *                 ),
    *                 example={
    *                     "description": "TV Sony",
    *                     "price": "100.0",
    *                     "stock": "1"
    *                }
    *             )
    *         )
    *      ),
    *      @OA\Response(
    *          response=200,
    *          description="Success",
    *          @OA\JsonContent(
    *              @OA\Property(property="id", type="number", example=1),
    *              @OA\Property(property="description", type="string", example="TV Sony"),
    *              @OA\Property(property="price", type="float", example="100.0"),
    *              @OA\Property(property="stock", type="integer", example="1"),
    *              @OA\Property(property="created_at", type="string", example="2023-02-23T00:09:16.000000Z"),
    *              @OA\Property(property="updated_at", type="string", example="2023-02-23T12:33:45.000000Z")
    *          )
    *      ),
    *      @OA\Response(
    *          response=422,
    *          description="UNPROCESSABLE CONTENT",
    *          @OA\JsonContent(
    *              @OA\Property(property="message", type="string", example="The description field is required."),
    *              @OA\Property(property="errors", type="string", example="error"),
    *          )
    *      ),
    *      @OA\Response(
    *          response=404,
    *          description="Error: Not Found",
    *          @OA\JsonContent(
    *              @OA\Property(property="message", type="string", example="No query results for model [App\\Models\\Product] #id.")
    *          )
    *      )
    * )
    */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'description' => 'required',
            'price' => 'required',
            'stock' => 'required'
        ]);

        $product = Product::findOrFail($request->id);
        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->save();

        return $product;
    }

    /**
    * Remove the specified resource from storage.
    * 
    * @OA\Delete (
    *     path="/api/products/{id}",
    *     tags={"Product"},
    *     @OA\Parameter(
    *         in="path",
    *         name="id",
    *         required=true,
    *         @OA\Schema(type="integer")
    *     ),
    *     @OA\Response(
    *         response=204,
    *         description="No Content"
    *     ),
    *      @OA\Response(
    *          response=404,
    *          description="Error: Not Found",
    *          @OA\JsonContent(
    *              @OA\Property(property="message", type="string", example="Action could not be performed correctly"),
    *          )
    *      )
    * )
    */
    public function destroy(Request $request, string $id)
    {
        $product = Product::find($id);

        if(is_null($product))
        {
            return response()->json(['message' => 'Action could not be performed correctly'], 404);
        }

        $product->delete();

        return response()->noContent();
    }
}
