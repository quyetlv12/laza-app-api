<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $table = "cart";
    public $fillable = [
        'product_id',
        'quantity',
        'size'
    ];

    public function products() {
        return $this->belongsTo(Product::class , 'product_id');
    }
}
