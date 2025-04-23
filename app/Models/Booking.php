<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $casts = [
        'booking_time' => 'datetime:H:i',
    ];
    protected $fillable = ['user_id', 'organization_id', 'service_id', 'employee_id', 'booking_date', 'booking_time','status','price'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}

