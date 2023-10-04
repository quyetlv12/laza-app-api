<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favourate extends Model
{
    use HasFactory;

   protected $table = "favourates";
   public function product(){
    return $this ->belongsTo(Product::class , 'product_id');
   }
}
