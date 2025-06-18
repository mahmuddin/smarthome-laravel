<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Str;
use Stancl\Tenancy\Database\Concerns\HasDataColumn;
use Stancl\Tenancy\Database\Concerns\HasDomains;
use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;

class Tenant extends BaseTenant
{
    use HasDomains, HasDataColumn;

    public $incrementing  = false;
    protected $keyType    = 'string';
    protected $primaryKey = 'id';

    protected $casts = [
        'data' => 'array',
    ];

    // Jika ingin menambahkan atribut atau relasi khusus tenant

    // Contoh: menambahkan atribut custom
    protected $fillable = [
        'id',   // biasanya berupa id
        'data', // kolom JSON yang berisi info tenant seperti nama, alamat, dll,
    ];

    protected static function booted()
    {
        static::creating(function ($tenant) {
            if (empty($tenant->id)) {
                $tenant->id = (string) Str::uuid();
            }
        });
    }

    // Contoh accessor untuk nama tenant
    protected function name(): Attribute
    {
        return Attribute::get(fn() => $this->data['name'] ?? null);
    }

    // ⬇️ Tambahkan ini agar Laravel tahu kolom `data` menyimpan dynamic attributes
    public static function getCustomColumns(): array
    {
        return ['id', 'data'];
    }
}
