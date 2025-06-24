<?php
namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeviceLog extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $dates = ['recorded_at'];

    public function device()
    {
        return $this->belongsTo(Device::class);
    }
}
