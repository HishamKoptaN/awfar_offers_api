<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create(
            'offer_groups',
            function (Blueprint $table) {
                $table->id();
                $table->boolean('status')->default(true)->comment('true-false');
                $table->string('name');
                $table->foreignId("store_id")->constrained('stores')->cascadeOnDelete();
                $table->date('start_at')->nullable();
                $table->date('end_at')->nullable();
                $table->timestamps();
            },
        );
    }
    public function down(): void
    {
        Schema::dropIfExists('offer_groups');
    }
};
