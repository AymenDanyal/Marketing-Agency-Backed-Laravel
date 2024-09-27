<?php

// app/Models/CaseCategory.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaseCategory extends Model
{
    use HasFactory;
    public $timestamps = false; 
    protected $table = 'case_study_categories';

    protected $fillable = ['name', 'logo', 'url', 'slug'];

    public function caseStudies()
    {
        return $this->hasMany(CaseStudy::class, 'cat_id');
    }
}
