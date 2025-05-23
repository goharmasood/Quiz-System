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
            'discount_price'  => ['required', 'numeric', 'gte:0'],
            'total_stock'     => ['required', 'integer', 'gt:0'],
        ];
    }

    public function messages()
    {
        return [
            'inventory.unique' => 'This inventory name already exists for an active inventory.',
            'inventory.required' => 'Inventory name is required.',
            // Customize other messages as needed
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($this->sell_price < $this->actual_price) {
                $validator->errors()->add('sell_price', 'The sell price must be greater than or equal to the actual price.');
            }
            // Check discount_price is between actual_price and sell_price
            if ($this->discount_price < $this->actual_price || $this->discount_price > $this->sell_price) {
                $validator->errors()->add('discount_price', 'The discount price must be between the actual price and the sell price.');
            }
        });
    }
}
