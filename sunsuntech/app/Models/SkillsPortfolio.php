<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SkillsPortfolio extends Model
{
    protected $table = 'skills_portfolios';

    // ホワイトリスト
    protected $fillable = [
        'skill_id',
        'portfolio_id',
    ];
}
