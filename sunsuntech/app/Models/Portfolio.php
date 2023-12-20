<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    protected $table = 'portfolios';

    protected $fillable = [
        'id',
        'user_id',
        'serbice_name',
        'site_url',
        'site_file_path',
        'explanation'
    ];
}
