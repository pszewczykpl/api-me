<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hobby extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    public static $searchColumns = ['name', 'description'];

    /**
     * Get the user of hobby.
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
