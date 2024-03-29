<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dish extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'price',
        'img',
        'visibility',
        'restaurant_id'
    ];

    use SoftDeletes;

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class)->withPivot('quantity');
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($dish) {
            if ($dish->price < 0) {
                throw new \Exception("Price cannot be negative.");
            }
        });
    }
}
