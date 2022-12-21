<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description', 
        'url'
    ];

    public static $searchColumns = [
        'name', 
        'description', 
        'url'
    ];

    /**
     * Get the user of project.
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
