<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;

    protected $fillable = [
        'position',
        'company',
        'from_date',
        'to_date',
        'currently_working',
        'description',
        'localization'
    ];

    public static $searchColumns = [
        'position', 
        'company', 
        'from_date', 
        'to_date', 
        'description', 
        'localization'
    ];

    /**
     * Get the user of experience.
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
