<?php

namespace App\Imports;

use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\Review;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Row;

class ProductImport implements ToModel, WithHeadingRow, OnEachRow, WithUpserts, WithValidation
{
//    WithHeadingRow :  This For enable to import Excel file with headers
//    OnEachRow      :  This For import Excel file with relation
//    WithUpserts      :  This For make unique field
//    WithValidation      :  This For make validation rules

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Product([
            'title' => $row['title'],
            'description' => $row['description'],
            'user_id' => $row['user_id'],
        ]);
    }

    public function onRow(Row $row)
    {
        $row = $row->toArray();

        ProductDetail::create([
            'size' => $row['size'],
            'color' => $row['color'],
            'price' => $row['price'],
            'product_id' => Product::where('title', $row['title'])->pluck('id')->last(),
        ]);

        Review::create([
            'comment' => 'test comment',
            'product_id' => Product::where('title', $row['title'])->pluck('id')->last(),
            'user_id' => $row['user_id']
        ]);
    }

    public function rules(): array
    {
        return [
            //'title' => Rule::unique('products', 'title'),
        ];
    }

    public function uniqueBy()
    {
        return 'title';
    }

}
