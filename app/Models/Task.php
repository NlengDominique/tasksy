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

    protected $casts = [
        'dateEcheance' => 'datetime',
        'status' => 'boolean',
    ];


    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
