<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'allocations',
        'state',
        'team',
        'billing_company',
        'role',
        'skill',
        'seniority',
        'location',
        'office',
        'start_date',
        'end_date',
        'sphere',
        'classification',
        'billing_code',
        'order',
        'invoice_desc',
        'value',
        'currency',
        'rate',
        'discount',
        'flagged',
        'notes',
        'email',
    ];
}
