<?php

namespace App\Models;

use App\Enums\ClientType;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'dni',
        'type'
    ];

    protected $casts = [
        'type' => ClientType::class,
    ];
}
