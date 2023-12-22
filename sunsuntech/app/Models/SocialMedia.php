<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialMedia extends Model
{
    protected $table = 'social_medias';

    // ホワイトリスト
    protected $fillable = [
        'user_id',
        'social_media_name',
        'url',
    ];

    /**
     * social_medias - users_skills_types - users
     *
     * @return void
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
