<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Customer extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'slug',
        'name',
        'email',
        'phone'
    ];

    protected $keyType = 'string';
    public $incrementing = false;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($customer) {
            if (empty($customer->slug)) {
                $customer->slug = Str::slug($customer->name) . '-' . Str::random(6);
            }
        });
    }

    // Relasi: Customer punya banyak Orders
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
