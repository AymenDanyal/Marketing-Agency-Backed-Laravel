<?php

// app/Models/CaseStudy.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaseStudy extends Model
{
    use HasFactory;

    protected $table = 'case_studies';
    public $timestamps = false; 
    protected $fillable = [
        'slug', 'title', 'cat_id', 'thumbnail', 'desktop_banner', 
        'mob_banner', 'content', 'summary', 'date_created'
    ];

    public function category()
    {
        return $this->belongsTo(CaseCategory::class, 'cat_id');
    }
}
