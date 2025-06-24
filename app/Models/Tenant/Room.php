<?php
namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    use HasFactory, SoftDeletes;

    public function home()
    {
        return $this->belongsTo(Home::class);
    }

    public function devices()
    {
        return $this->hasMany(Device::class);
    }
}
