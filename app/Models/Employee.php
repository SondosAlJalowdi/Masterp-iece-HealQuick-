<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['organization_id','name', 'email', 'phone', 'position', 'status'];

    public function organizationServices()
    {
        return $this->belongsToMany(Organization::class, 'organization_service');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }
}

