<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;
    protected $table = "comments";
    public $fillable = [
        'product_id',
        'user_name',
        'content',
        'rating'
    ];
    public function products(){
        return $this->belongsTo(Product::class , 'product_id'); 
    }
}
