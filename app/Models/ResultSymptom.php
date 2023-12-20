<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ResultSymptom extends Model
{
    protected $fillable = [
        'result_id',
        'symptom_id',
        'rule',
    ];

    public function symptom(): BelongsTo
    {
        return $this->belongsTo(Symptom::class);
    }
}
