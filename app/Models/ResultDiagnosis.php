<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ResultDiagnosis extends Model
{
    protected $fillable = [
        'result_id',
        'disease_id',
        'certainty_factor',
        'sequence',
    ];

    public function disease(): BelongsTo
    {
        return $this->belongsTo(Disease::class);
    }
}
