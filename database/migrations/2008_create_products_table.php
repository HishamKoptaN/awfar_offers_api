<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create(
            'products',
            function (
                Blueprint $table,
            ) {
                $table->id();
                $table->string('image');
                $table->decimal('price', 10, 2)->nullable();
                $table->decimal('discount_rate', 5, 2)->nullable();
                $table->foreignId('offer_id')->constrained('offers')->cascadeOnDelete();
                $table->foreignId('marka_id')->constrained('markas')->cascadeOnDelete();
                $table->timestamps();
            },
        );
    }
    public function down(): void
    {
        Schema::dropIfExists(
            'products',
        );
    }
};
