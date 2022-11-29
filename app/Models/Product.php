<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'admin_id', 'category_id', 'product_name', 'description', 'image', 'price', 'total_quantity', 'used_quantity', 'remaining_quantity'
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
