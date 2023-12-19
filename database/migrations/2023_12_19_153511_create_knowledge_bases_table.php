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
        Schema::create('knowledge_bases', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Disease::class)->constrained();
            $table->foreignIdFor(\App\Models\Symptom::class)->constrained();
            $table->decimal('mb', places: 1)->nullable()->default(0)->comment('measure of increased belief ');
            $table->decimal('md', places: 1)->nullable()->default(0)->comment('measure of increased disbelief ');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('knowledge_bases');
    }
};
