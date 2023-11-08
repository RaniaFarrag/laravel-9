<?php

namespace App\Http\Requests\Api\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $id = request()->segment(3);
        return [
            //'title' => 'required|max:25|string|unique:products,id'.$this->id,    //Or use this only
            'title' => 'required|max:25|string|unique:products,title,'.$id.',id',
            'description' => 'required|string',
            'size' => 'required|numeric',
            'color' => 'required|in:red,green',
            'price' => 'nullable|numeric',
        ];
    }
}
