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
                Rule::unique('inventories', 'name')->where(fn ($query) => $query->where('is_active', 1)),
            ],
            'inventorytype'   => ['required', 'exists:inventory_types,id'],
            'length'          => ['nullable', 'numeric', 'gt:0'],
            'width'           => ['nullable', 'numeric', 'gt:0'],
            'actual_price'    => ['required', 'numeric', 'gt:0'],
            'sell_price'      => ['required', 'numeric', 'gt:0'],
            'discount_price'  => ['nullable', 'numeric', 'gte:0'],
            'total_stock'     => ['required', 'integer', 'gt:0'],
        ];
    }

    public function messages()
    {
        return [
            'inventory.unique' => 'This inventory name already exists for an active inventory.',
            // Customize other messages as needed
        ];
    }
}
