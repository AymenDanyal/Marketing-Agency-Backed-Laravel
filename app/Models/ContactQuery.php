<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactQuery extends Model
{
    protected $table = 'contact_queries'; // Specify the table name if different from the model name
    protected $primaryKey = 'id'; // Primary key column
    public $timestamps = false; // Disable timestamps if not using them

    protected $fillable = [
        'id',
        'name',
        'email',
        'contact',
        'company',
        'webUrl',
        'message',
        'date_created'
    ];


    protected $casts = [
        'date_created' => 'datetime',
    ];
}
