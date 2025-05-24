<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreInventoryRequest extends FormRequest
{
    public function authorize()
    {
        // Allow all users for now, customize as needed
        return true;
    }

    public function rules()
    {
        return [
            'inventory' => [
                'required',
                'string',
                'min:2',
                'max:255',
                // Unique only when is_active = 1
                //Rule::unique('inventories', 'name')->where(fn ($query) => $query->where('is_active', 1)),
                Rule::unique('inventories', 'name')
                ->where(function ($query) {
                    return $query->where('is_active', 1)
                                 ->where('type_id', $this->inventorytype);
                }),
            ],
            'inventorytype'   => ['required', 'exists:inventory_types,id'],
            'length' => ['required', 'numeric', 'gt:0'],
            'width' => ['required', 'numeric', 'gt:0'],
            'actual_price'    => ['required', 'numeric', 'gt:0'],
            'sell_price'      => ['required', 'numeric', 'gt:0'],
            'total_stock'     => ['required', 'integer', 'gt:0'],
        ];
    }

    public function messages()
    {
        return [
            'inventory.unique' => 'This inventory name already exists for an active inventory.',
            'inventory.required' => 'Inventory name is required.',
            'inventorytype.required' => 'Inventory type is required.',
            'length.required' => 'Length is required.',
            'width.required' => 'Width is required.',
            'actual_price.required' => 'Actual price is required.',
            'sell_price.required' => 'Sell price is required.',
            'total_stock.required' => 'Total stock is required.',
            // Customize other messages as needed
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($this->sell_price < $this->actual_price) {
                $validator->errors()->add('sell_price', 'The sell price must be greater than or equal to the actual price.');
            }
        });
    }
}
