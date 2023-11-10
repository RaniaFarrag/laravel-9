<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductExport implements FromArray, WithHeadings
{

    public function headings(): array
    {
//        return [];
        return ["title", "description", "user_id", "user name", "size", "color", "price"];
    }

    public function array(): array
    {
        $list = [];
        $products = Product::all();
        foreach ($products as $product) {
            $list[] = [$product->title, $product->description, $product->user_id, $product->user->name,
                $product->productDetails->size, $product->productDetails->color, $product->productDetails->price];
        }
        return $list;
    }

}

