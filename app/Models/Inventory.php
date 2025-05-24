<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    //
    protected $tables = "inventories";
    protected $fillable = [
        'name', 'type_id', 'length', 'width', 'actual_price',
        'sell_price', 'total_stock', 'is_active'
    ];

    public function InventoryTypes()
    {
        return $this->belongsTo(InventoryType::class, 'type_id');
    }

    public function InventoryType()
    {
        return $this->belongsTo(InventoryType::class, 'type_id')->select('id','name');
    }

    public function getLengthInFeetAttribute()
    {
        return $this->formatFeet($this->length);
    }

    public function getWidthInFeetAttribute()
    {
        return $this->formatFeet($this->width);
    }

    public function getActualPriceFormattedAttribute()
    {
        return $this->formatAmount($this->actual_price);
    }

    public function getSellPriceFormattedAttribute()
    {
        return $this->formatAmount($this->sell_price);
    }

    private function formatFeet($value)
    {
        return (fmod($value, 1) == 0 ? number_format($value) : rtrim(rtrim(number_format($value, 2, '.', ''), '0'), '.')) . ' ft';
    }

    private function formatAmount($value)
    {
        return 'PKR ' . (fmod($value, 1) == 0 ? number_format($value) : rtrim(rtrim(number_format($value, 2, '.', ''), '0'), '.'));
    }

}
