<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductAttributeRequest;
use App\Http\Requests\UpdateProductAttributeRequest;
use App\Http\Resources\ProductAttributeResource;
use App\Models\Product;
use App\Models\ProductAttribute;

class ProductAttributeController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Product $product): \Illuminate\Http\JsonResponse
    {
        return $this->sendResponse(ProductAttributeResource::collection($product->attributes));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Product $product, StoreProductAttributeRequest $request): \Illuminate\Http\JsonResponse
    {
        $productAttribute = $product->attributes()->create($request->validated());

        return $this->sendResponse(new ProductAttributeResource($productAttribute), 'Product attribute created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product, ProductAttribute $attribute): \Illuminate\Http\JsonResponse
    {
        return $this->sendResponse(new ProductAttributeResource($attribute));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Product $product, UpdateProductAttributeRequest $request, ProductAttribute $attribute): \Illuminate\Http\JsonResponse
    {
        $attribute->update($request->validated());

        return $this->sendResponse(new ProductAttributeResource($attribute), 'Product attribute updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product, ProductAttribute $attribute): \Illuminate\Http\JsonResponse
    {
        $attribute->delete();

        return $this->sendResponse(null, 'Product attribute deleted!');
    }
}
