<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Result extends Model
{
    protected $fillable = [
        'date',
        'code',
        'notes',
    ];

    public function diagnoses(): HasMany
    {
        return $this->hasMany(ResultDiagnosis::class);
    }

    public function diseases(): HasMany
    {
        return $this->hasMany(ResultDisease::class);
    }

    public function symptoms(): BelongsToMany
    {
        return $this->belongsToMany(Symptom::class, ResultSymptom::class)
            ->withPivot('rule');
    }


    public function diagnosis(): HasOne
    {
        return $this->hasOne(ResultDiagnosis::class)->ofMany('sequence', 'MIN');
    }
}
