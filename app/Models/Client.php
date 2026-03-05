<?php

namespace App\Models;

use App\Enums\ClientType;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $casts = [
        'type' => ClientType::class,
    ];

    protected $fillable = [
        'type',
        'name',
        'dni_cif',
        'phone',
        'email',
        'notes'
    ];

}
