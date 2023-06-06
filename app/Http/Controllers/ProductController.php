<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;

class ProductController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        return $this->sendResponse(ProductResource::collection(Product::all()));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request): \Illuminate\Http\JsonResponse
    {
        $product = Product::create($request->validated());

        return $this->sendResponse(new ProductResource($product), 'Product created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product): \Illuminate\Http\JsonResponse
    {
        return $this->sendResponse(new ProductResource($product->load('attributes')));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product): \Illuminate\Http\JsonResponse
    {
        $product->update($request->validated());

        return $this->sendResponse(new ProductResource($product), 'Product updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product): \Illuminate\Http\JsonResponse
    {
        $product->delete();

        return $this->sendResponse(null, 'Product deleted!');
    }
}
