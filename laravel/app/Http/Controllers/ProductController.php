<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    public function getProducts()
    {
        $products = Product::with('category')->get();
        return response()->json([
            'message' => 'Products retrieved successfully.',
            'data' => $products
        ]);
    }

    public function createProduct(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:products,name',
            'pricing' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        $product = Product::create($request->all());

        return response()->json([
            'message' => 'Product created successfully.',
            'product' => $product->load('category')
        ], 201);
    }

    public function getProduct($productId)
    {
        $product = Product::with('category')->find($productId);

        if (!$product) {
            return response()->json([
                'message' => 'Product not found.'
            ], 404);
        }

        return response()->json([
            'message' => 'Product retrieved successfully.',
            'product' => $product
        ]);
    }

    public function updateProduct(Request $request, $productId)
    {
        $product = Product::find($productId);

        if (!$product) {
            return response()->json([
                'message' => 'Product not found.'
            ], 404);
        }

        $request->validate([
            'name' => 'sometimes|string|max:255|unique:products,name,' . $productId,
            'pricing' => 'sometimes|numeric|min:0',
            'description' => 'sometimes|string',
            'category_id' => 'sometimes|exists:categories,id',
        ]);

        // $product->update($request->all());
        $product->pricing = $request->pricing;
        $product->save();

        return response()->json([
            'message' => 'Product updated successfully.',
            'product' => $product->load('category')
        ]);
    }

    public function deleteProduct($productId)
    {
        $product = Product::find($productId);

        if (!$product) {
            return response()->json([
                'message' => 'Product not found.'
            ], 404);
        }

        $product->delete();

        return response()->json([
            'message' => 'Product deleted successfully.'
        ]);
    }
}
