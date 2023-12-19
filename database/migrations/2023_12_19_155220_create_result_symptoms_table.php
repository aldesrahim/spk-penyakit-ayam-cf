<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('result_symptoms', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Result::class)->constrained();
            $table->foreignIdFor(\App\Models\Symptom::class)->constrained();
            $table->decimal('rule', places: 1)->nullable()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('result_symptoms');
    }
};
