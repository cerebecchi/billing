<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Debtor extends Model
{
    protected $fillable = [
        'id',
        'name',
        'email',
        'government_id',
        'created_at',
        'updated_at',
    ];


}
