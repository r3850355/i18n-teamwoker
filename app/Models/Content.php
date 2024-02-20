<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'key',
        'en_US',
        'zh_TW',
        'zh_CN',
        'ja_JP'
    ];
}
