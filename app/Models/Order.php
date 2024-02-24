<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'status',
        'client_name',
        'client_surname',
        'client_mail',
        'client_phone',
        'client_address'
    ];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function dishes()
    {
        return $this->belongsToMany(Dish::class);
    }
}
