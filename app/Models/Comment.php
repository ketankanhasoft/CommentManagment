<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'client_id',
        'email',
        'phone_number',
        'name',
        'comment',
    ];
}
