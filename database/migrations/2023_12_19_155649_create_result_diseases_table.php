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
        Schema::create('result_diseases', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Result::class)->constrained();
            $table->foreignIdFor(\App\Models\Disease::class)->constrained();
            $table->decimal('certainty_factor', places: 5)->nullable()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('result_diseases');
    }
};
