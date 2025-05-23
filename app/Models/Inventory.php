<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    //
    protected $tables = "inventories";
    protected $fillable = [
    'name', 'type_id', 'length', 'width', 'actual_price',
    'sell_price', 'discount_price', 'total_stock', 'is_active'
];

}
