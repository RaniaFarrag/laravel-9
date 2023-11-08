<?php


namespace App\Services;

//This is Service Container

use App\Models\Product;

class ProductService
{

    public function getAllProducts()
    {
        return Product::all();
    }

    public function getOneProduct($id)
    {
        return Product::findOrFail($id);
    }

    public function createProduct($requestData)
    {
        $product = Product::create($requestData);
        $product->productDetails()->create($requestData);

        return $product;

    }

    public function updateProduct($requestData, $product)
    {
        $product->title = $requestData['title'];
        $product->description = $requestData['description'];
        $product->user_id = $requestData['user_id'];
        $product->productDetails->size = $requestData['size'];
        $product->productDetails->color = $requestData['color'];
        $product->productDetails->price = $requestData['price'];
        $product->save();
        $product->productDetails->save();

        return $product;
    }

    public function deleteProduct($product){
        if ($product->productDetails){
            $product->productDetails()->delete();
        }
        if ($product->reviews){
            $product->reviews()->delete();
        }
        if ($product->image){
            $product->image()->delete();
        }
        $product->delete();

    }


}
