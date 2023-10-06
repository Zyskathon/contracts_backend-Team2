<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;

    protected $fillable = [
        'contract_number',
        'description',
        'agreement_file',
        'company_name',
        'start_date',
        'end_date',
        'completed_date',
        'type',
        'salary',
        'amount',
    ];

    protected $casts = [
        'start_date' => 'datetime:d-m-Y',
        'end_date' => 'datetime:d-m-Y',
        'completed_date' => 'datetime:d-m-Y'
    ];

}
