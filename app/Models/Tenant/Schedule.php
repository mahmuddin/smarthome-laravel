<?php
namespace App\Models\Tenant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Schedule extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'device_id',
        'action',
        'schedule_time',
        'repeat',
    ];

    /**
     * Casts
     */
    protected $casts = [
        'schedule_time' => 'datetime:H:i',
    ];

    /**
     * Relasi ke Device
     */
    public function device()
    {
        return $this->belongsTo(Device::class);
    }

    /**
     * Cek jadwal yang sesuai dengan waktu saat ini
     */
    public static function dueNow()
    {
        $now       = now()->format('H:i');
        $dayOfWeek = now()->dayOfWeekIso; // 1 (Senin) - 7 (Minggu)

        return self::where('schedule_time', $now)
            ->where(function ($q) use ($dayOfWeek) {
                $q->where('repeat', 'daily')
                    ->orWhere(function ($query) use ($dayOfWeek) {
                        $query->where('repeat', 'weekly')
                            ->whereRaw('WEEKDAY(NOW()) = ?', [$dayOfWeek - 1]);
                    })
                    ->orWhere('repeat', 'once');
            });
    }

    /**
     * Jalankan aksi schedule ke device
     */
    public function execute()
    {
        $device = $this->device;

        if (! $device) {
            return;
        }

        $device->update([
            'status' => $this->action === 'turn_on',
        ]);

        // Jika hanya sekali, nonaktifkan setelah eksekusi
        if ($this->repeat === 'once') {
            $this->delete();
        }
    }
}
