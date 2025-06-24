<?php
namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Device extends Model
{
    use HasFactory, SoftDeletes;

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function logs()
    {
        return $this->hasMany(DeviceLog::class);
    }
}
