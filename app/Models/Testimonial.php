<?php

// app/Models/Page.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $table = 'testimonial';

    protected $fillable = ['person', 'comment', 'image', 'logo'];
    public $timestamps = true; 
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'testimonial_tags', 'testimonial_id', 'tag_id');
    }

}
