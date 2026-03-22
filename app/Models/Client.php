<?php

namespace App\Models;

use App\Enums\ClientType;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $casts = [
        'type' => ClientType::class,
        'phone' => 'array'
    ];

    protected $fillable = [
        'type',
        'name',
        'dni_cif',
        'phone',
        'email',
        'notes'
    ];

    public function addresses(){
        return $this->hasMany(Address::class);
    }

    public function devices()
    {
        return $this->hasMany(Device::class);
    }

}
