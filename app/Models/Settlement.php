<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Settlement extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function sales(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sales_id', 'id');
    }

    public function checkers(): BelongsTo
    {
        return $this->belongsTo(User::class, 'checker_id', 'id');
    }
}
