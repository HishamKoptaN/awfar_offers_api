<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create(
            'notification_tokens',
            function (
                Blueprint $table,
            ) {
                $table->id();
                $table->string('device_id');
                $table->string('fcm_token')->unique();
                $table->foreignId("city_id")->constrained('cities')->cascadeOnDelete();
                $table->timestamps();
            },
        );
    }
    public function down(): void
    {
        Schema::dropIfExists('notification_tokens');
    }
};
