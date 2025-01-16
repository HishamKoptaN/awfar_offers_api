<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create(
            'notifications',
            function (Blueprint $table) {
                $table->id();
                $table->string('message');
                $table->foreignId("store_id")->constrained('stores');
                $table->string('image')->nullable();
                $table->timestamps();
            },
        );
    }

    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
