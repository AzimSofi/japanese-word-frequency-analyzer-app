<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('word_frequency', function (Blueprint $table) {
            $table->id();
            $table->foreignId('input_text_id')
                ->constrained('input_texts')
                ->onDelete('cascade');
            $table->string("word");
            $table->integer("frequency");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('word_frequency');
    }
};
