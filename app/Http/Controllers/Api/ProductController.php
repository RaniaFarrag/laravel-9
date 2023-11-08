<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Product\CreateProductRequest;
use App\Http\Requests\Api\Product\UpdateProductRequest;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public ProductService $productService;

    public function __construct(ProductService $productService){
        $this->productService = $productService;
    }

    public function index()
    {
        $products = $this->productService->getAllProducts();

        return $this->sendResponse($products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProductRequest $createProductRequest)
    {
        $createProductRequest['user_id'] = Auth::id();
        $product = $this->productService->createProduct($createProductRequest->all());

        return $this->sendResponse($product);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //$product = $this->productService->getOneProduct($id);
        return $this->sendResponse($product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $updateProductRequest, Product $product)
    {
        $updateProductRequest['user_id'] = Auth::id();
        $updatedProduct = $this->productService->updateProduct($updateProductRequest->all(), $product);

        return $this->sendResponse($updatedProduct);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $this->productService->deleteProduct($product);

        return $this->sendResponse('deleted successfully');
    }
}
