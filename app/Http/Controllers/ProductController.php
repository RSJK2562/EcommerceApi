<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    /**
     * Display a listing of the products.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        // Implement caching for products list
        $products = Cache::remember('products', 60 * 15, function () {
            return Product::all();
        });

        $formattedProducts = $products->map(function ($product) {
            return $product->formatForApi();
        });

        return response()->json([
            'data' => $formattedProducts,
            'message' => 'Products retrieved successfully',
            'success' => true
        ]);
    }

    /**
     * Store a newly created product in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'active' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'message' => 'Validation failed',
                'success' => false
            ], 422);
        }

        $data = $request->except('image');

        // Handle file upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();

            // Store the file in the public disk
            $path = $file->storeAs('products', $filename, 'public');

            // Save the full path to the database
            $data['image'] = $path;
        }

        $product = Product::create($data);

        // Clear cache when creating new product
        Cache::forget('products');

        return response()->json([
            'data' => $product->formatForApi(),
            'message' => 'Product created successfully',
            'success' => true
        ], 201);
    }

    /**
     * Display the specified product.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'message' => 'Product not found',
                'success' => false
            ], 404);
        }

        return response()->json([
            'data' => $product->formatForApi(),
            'message' => 'Product retrieved successfully',
            'success' => true
        ]);
    }

    /**
     * Update the specified product in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'message' => 'Product not found',
                'success' => false
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'string|max:255',
            'description' => 'string',
            'price' => 'numeric|min:0',
            'stock' => 'integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'active' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'message' => 'Validation failed',
                'success' => false
            ], 422);
        }

        $data = $request->except('image');

        // Handle file upload for update
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($product->image_path) {
                Storage::disk('public')->delete($product->image_path);
            }

            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();

            // Store the new file
            $path = $file->storeAs('products', $filename, 'public');

            // Save the full path to the database
            $data['image_path'] = $path;
        }

        $product->update($data);

        // Clear cache when updating product
        Cache::forget('products');

        return response()->json([
            'data' => $product->formatForApi(),
            'message' => 'Product updated successfully',
            'success' => true
        ]);
    }

    /**
     * Remove the specified product from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'message' => 'Product not found',
                'success' => false
            ], 404);
        }

        // Delete associated image file if exists
        if ($product->image_path) {
            Storage::disk('public')->delete($product->image_path);
        }

        $product->delete();

        // Clear cache when deleting product
        Cache::forget('products');

        return response()->json([
            'message' => 'Product deleted successfully',
            'success' => true
        ]);
    }
}
