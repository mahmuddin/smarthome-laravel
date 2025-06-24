<?php
namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class TenantUser extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    // Gunakan koneksi tenant
    protected $connection = 'tenant';

    protected $table = 'users'; // Nama tabel untuk user tenant

    protected $fillable = [
        'name',
        'email',
        'role',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // JWTSubject implementation
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
    public function homes()
    {
        return $this->hasMany(Home::class);
    }
}
