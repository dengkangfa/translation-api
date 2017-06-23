<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Translation extends Model
{
    protected $fillable = ['type', 'password', 'original', 'translation'];

    protected $casts = ['original' => 'array'];
}
