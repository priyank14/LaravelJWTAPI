<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    //
    protected $fillable = [
        'user_id', 'heading', 'description',
    ];
}
