<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class VideoTag extends Pivot
{   public $timestamps = false; 
    protected $table = 'video_tags';
    protected $fillable = ['video_id','tag_id'];
}
