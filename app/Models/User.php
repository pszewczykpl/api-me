<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'main',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get user's educations.
     */
    public function educations()
    {
        return $this->hasMany('App\Models\Education');
    }

    /**
     * Get user's experiences.
     */
    public function experiences()
    {
        return $this->hasMany('App\Models\Experience');
    }

    /**
     * Get user's hobbies.
     */
    public function hobbies()
    {
        return $this->hasMany('App\Models\Hobby');
    }

    /**
     * Get user's projects.
     */
    public function projects()
    {
        return $this->hasMany('App\Models\Project');
    }

    /**
     * Get user's skills.
     */
    public function skills()
    {
        return $this->hasMany('App\Models\Skill');
    }
}
