<?php
namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Automation extends Model
{
    use HasFactory, SoftDeletes;

    public function home()
    {
        return $this->belongsTo(Home::class);
    }

    public function rules()
    {
        return $this->hasMany(AutomationRule::class);
    }

    public function actions()
    {
        return $this->hasMany(AutomationAction::class);
    }
}
