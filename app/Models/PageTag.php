<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class PageTag extends Pivot
{   public $timestamps = false; 
    protected $table = 'page_tags';
    protected $fillable = ['page_id','tag_id'];
}
