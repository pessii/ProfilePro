<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsersSkillsType extends Model
{
    protected $table = 'users_skills_types';

    // ホワイトリスト
    protected $fillable = [
        'user_id',
        'skill_id',
    ];
}
