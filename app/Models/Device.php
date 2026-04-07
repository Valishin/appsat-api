<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $table = 'devices';

    protected $fillable = [
        'client_id',
        'type',
        'brand',        
        'model',
        'serial_number',
        'imei',
        'sim',
        'password',
        'condition_notes',
        'notes'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}

?>