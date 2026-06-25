<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
    'client_name',
    'issue_date',
    'due_date',
    'balance_due'
];
}
