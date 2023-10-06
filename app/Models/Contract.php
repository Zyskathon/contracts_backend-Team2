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

    public function employee()
    {
        return $this->belongsToMany(Employee::class);
    }
}
