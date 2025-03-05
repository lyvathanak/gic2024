<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getCategories(Request $request)
    {
        return response()->json([
            'message' => 'Get all categories',
            'data' => []
        ]);
    }

    public function createCategory(Request $request)
    {
        return response()->json([
            'message' => 'Create a category',
            'data' => []
        ]);
    }

    public function getCategory(Request $request, $categoryId)
    {
        return response()->json([
            'message' => 'Get a category',
            'data' => []
        ]);
    }

    public function updateCategory(Request $request, $categoryId)
    {
        return response()->json([
            'message' => 'Update a category',
            'data' => []
        ]);
    }

    public function deleteCategory(Request $request, $categoryId)
    {
        return response()->json([
            'message' => 'Delete a category',
            'data' => []
        ]);
    }
}
