<?php

// app/Models/Video.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $table = 'videos';
    public $timestamps = false; 
    protected $fillable = ['title', 'media_type'];

    public function page()
    {
        return $this->belongsTo(Page::class, 'page_id');
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'video_tags', 'video_id', 'tag_id');
    }

}
