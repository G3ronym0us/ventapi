<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variety extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'product_id'
    ];

    public function products()
    {
        return $this->belongsTo(Product::class);
    }

    public function details()
    {
        return $this->hasMany(VarietyDetail::class);
    }
}
