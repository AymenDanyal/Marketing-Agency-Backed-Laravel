<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class TestimonialTag extends Pivot
{   public $timestamps = false; 
    protected $table = 'testimonial_tags';
    protected $fillable = ['testimonial_id','tag_id'];
}
