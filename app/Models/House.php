<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'owner_name',
        'description',
    ];

    /**
     * A house may have many rooms.
     */
    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    /**
     * A house may have many devices (if devices not tied to room).
     */
    public function devices()
    {
        return $this->hasMany(Device::class);
    }
}
