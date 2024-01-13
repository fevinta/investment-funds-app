<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function ManagedFounds(): HasMany
    {
        return $this->hasMany(Fund::class);
    }

    public function InvestedFunds(): BelongsToMany
    {
        return $this->belongsToMany(Fund::class)->withTimestamps();
    }

}
