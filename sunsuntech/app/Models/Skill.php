<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $table = 'skills';

    protected $fillable = [
        'id',
        'skill_name',
        'skill_file_path',
    ];

    /**
     * skills - users_skills_types - users
     *
     * @return void
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
