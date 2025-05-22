<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryType extends Model
{
    //
    protected $tables = "inventory_types";
    protected $fillable = [
    'name',
    'is_active',
    'added_by',
];

}
