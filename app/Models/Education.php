<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;

    protected $fillable = ['university', 'degree', 'field_of_study', 'from_date', 'to_date', 'currently_study', 'description', 'localization'];

    public static $searchColumns = ['university', 'degree', 'field_of_study', 'from_date', 'to_date', 'description', 'localization'];

    /**
     * Get the user of education.
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
