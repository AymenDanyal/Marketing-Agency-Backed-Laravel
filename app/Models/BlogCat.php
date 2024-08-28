<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogCat extends Model
{
    protected $table = 'blog_cats'; // Specify the table name if different from the model name
    protected $primaryKey = 'id'; // Primary key column
    public $timestamps = false; // Disable timestamps if not using them

    protected $fillable = [
        'category',
        'slug'
    ];
    public function blogs()
    {
        return $this->hasMany(Blog::class, 'cat_id', 'id');
    }
}
