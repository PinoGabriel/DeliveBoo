<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class restaurant extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'img',
        'p_iva',
        'description',
        'address'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function types()
    {
        return $this->belongsToMany(Type::class);
    }

    public function dishes()
    {
        return $this->hasMany(Dish::class);
    }
}
