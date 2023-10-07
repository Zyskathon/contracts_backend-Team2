<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contract extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'start_date' => 'datetime:d-m-Y',
        'end_date' => 'datetime:d-m-Y',
        'completed_date' => 'datetime:d-m-Y',
    ];

    protected $dates = [
        'deleted_at',
    ];

    public function employees()
    {
        return $this->belongsToMany(Employee::class, 'contract_employees');
    }

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function qaLead()
    {
        return $this->belongsTo(Employee::class, 'qalead_id');
    }

    public function devLead()
    {
        return $this->belongsTo(Employee::class, 'devlead_id');
    }

    public function pm()
    {
        return $this->belongsTo(Employee::class, 'pm_id');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }


}
