<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VarietyDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'variety_id'
    ];

    public function variety(){
        return $this->belongsTo(Variety::class);
    }
}
