<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Organization extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['name', 'email', 'phone', 'address', 'user_id','description'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function services()
    {
        return $this->belongsToMany(Service::class, 'organization_service')
                    ->withPivot('employee_id', 'price')
                    ->withTimestamps();
    }
    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    public function admin()
{
    return $this->belongsTo(User::class, 'user_id');
}

}
