<?php
namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AutomationAction extends Model
{
    use HasFactory, SoftDeletes;

    public function automation()
    {
        return $this->belongsTo(Automation::class);
    }

    public function device()
    {
        return $this->belongsTo(Device::class);
    }
}
