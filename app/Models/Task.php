<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'title',
        'description',
        'dateEcheance',
        'priority',
        'status',
        'user_id'
    ];
}
