<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Alias extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function Fund(): BelongsTo
    {
        return $this->belongsTo(Fund::class);
    }
}
