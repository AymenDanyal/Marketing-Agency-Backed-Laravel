<?php

// app/Models/Page.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $table = 'pages';

    protected $fillable = ['name', 'slug'];
    public $timestamps = false; 
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'page_tags', 'page_id', 'tag_id');
    }

    public function videos()
    {
        return $this->hasMany(Video::class, 'page_id');
    }
}
