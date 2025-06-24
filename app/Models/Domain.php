<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Domain extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'domain',
        'tenant_id',
    ];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}
