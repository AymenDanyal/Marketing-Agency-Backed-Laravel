<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products'; // Specify the table name if different from the model name
    protected $primaryKey = 'id'; // Primary key column
    public $timestamps = false; // Enable timestamps if used

    protected $fillable = [
        'title',
        'slug',
        'cat_id',
        'description',
        'meta_footer',
        'image',
        'file',
        'summary',
        'meta_title',
        'meta_description'
    ];
    public function category()
    {
        return $this->belongsTo(ProductCat::class, 'cat_id', 'id');
    }
}
