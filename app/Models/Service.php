<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['name', 'description'];

    public function organizations()
    {
        return $this->belongsToMany(Organization::class, 'organization_service')
                    ->withPivot('employee_id', 'price')
                    ->withTimestamps();
    }

    public function employees()
    {
        return $this->belongsToMany(Employee::class, 'organization_service', 'service_id', 'employee_id')
                    ->withPivot('price')
                    ->withTimestamps();
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
