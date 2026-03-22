<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'client_addresses';

    protected $fillable = [
        'client_id',
        'address',
        'city',        
        'postal_code',
        'province',
        'country',
        'label'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}

?>