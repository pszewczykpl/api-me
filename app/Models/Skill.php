<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public static $searchColumns = [
        'name'
    ];

    /**
     * Get the user of skill.
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
