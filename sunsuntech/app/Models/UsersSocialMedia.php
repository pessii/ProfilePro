<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsersSocialMedia extends Model
{
    protected $table = 'users_social_medias';

    // ホワイトリスト
    protected $fillable = [
        'user_id',
        'social_media_id',
    ];
}
