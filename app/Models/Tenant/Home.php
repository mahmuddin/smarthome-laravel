<?php
namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Home extends Model
{
    use HasFactory, SoftDeletes;

    public function user()
    {
        return $this->belongsTo(TenantUser::class);
    }

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function automations()
    {
        return $this->hasMany(Automation::class);
    }
}
