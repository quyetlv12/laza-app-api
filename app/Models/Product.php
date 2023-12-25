<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name' , 'price' , 'description' , 'thumbnail' , 'images' , 'size' , 'comment_id' , 'cate_id'];
    protected $casts = [
        'size_id' => 'json',
    ];
    public function cart(){
        return $this->belongsToMany(Cart::class , 'id');
    }
    public function comments(){
        return $this->belongsTo(Comments::class , 'comment_id'); 
    }
    public function Categories(){
        return $this->belongsTo(Categories::class , 'cate_id'); 
    }
    public function size(){
        return $this->belongsTo(Size::class , 'size_id'); 
    }
}
