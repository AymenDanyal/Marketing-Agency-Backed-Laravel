<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $table = 'blogs'; // Specify the table name if different from the model name
    protected $primaryKey = 'id'; // Primary key column
    public $timestamps = false; // Disable timestamps if not using them

    protected $fillable = [
        'slug',
        'title',
        'cat_id',
        'thumbnail',
        'desktop_banner',
        'mob_banner',
        'content',
        'summary',
        'date_created'
    ];

    protected $casts = [
        'date_created' => 'datetime',
    ];
    public function category()
    {
        return $this->belongsTo(BlogCat::class, 'cat_id', 'id');
    }
}
