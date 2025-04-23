<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrganizationService extends Pivot
{
    use SoftDeletes;
    protected $fillable = ['organization_id', 'service_id', 'employee_id', 'price'];

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
}

