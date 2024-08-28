<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCat extends Model
{
    protected $table = 'product_cats'; // Specify the table name if different from the model name
    protected $primaryKey = 'id'; // Primary key column
    public $timestamps = true; // Enable timestamps if used

    protected $fillable = [
        'category',
        'description',
        'image',
        'meta_description',
        'meta_title',
        'meta_footer',
        'parent_id',
        'sort_by',
        'slug',
        'created_at',

    ];
    public function products()
    {
        return $this->hasMany(Product::class, 'cat_id', 'id');
    }
}
