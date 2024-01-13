<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Fund extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'start_year'
    ];

    public function ManagerCompany(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function InvestingCompanies(): BelongsToMany
    {
        return $this->belongsToMany(Company::class)->withTimestamps();
    }

    public function Aliases(): HasMany
    {
        return $this->hasMany(Alias::class);
    }
}
