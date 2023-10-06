<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'phone_number',
        'hire_date',
        'email',
        'salary',
    ];

    protected $casts = [
        'hire_date' => 'datetime:d-m-Y',
    ];

}
