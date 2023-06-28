<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Debt extends Model
{
    protected $collection = 'debts';

    protected $fillable = [
        'id',
        'debtor_id',
        'debt_amount',
        'paid_amount',
        'paid_at',
        'paid_by',
        'debt_due_date',
        'created_at',
        'updated_at',
    ];

}
