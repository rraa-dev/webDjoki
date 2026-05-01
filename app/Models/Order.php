<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'slug',
        'customer_id',
        'hero_id',
        'current_rank',
        'target_rank',
        'price',
        'status'
    ];

    protected $keyType = 'string';
    public $incrementing = false;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            if (empty($order->slug)) {
                $order->slug = 'order-' . Str::random(10);
            }
        });
    }

    // Relasi: Order milik satu Customer
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    // Relasi: Order milik satu Hero
    public function hero()
    {
        return $this->belongsTo(Hero::class);
    }
}
