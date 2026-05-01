<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Hero extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'slug',
        'name',
        'role',
        'difficulty'
    ];

    protected $keyType = 'string';
    public $incrementing = false;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($hero) {
            if (empty($hero->slug)) {
                $hero->slug = Str::slug($hero->name);
            }
        });
    }

    // Relasi: Hero punya banyak Orders
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
