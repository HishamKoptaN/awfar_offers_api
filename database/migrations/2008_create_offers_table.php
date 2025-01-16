<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create(
            'offers',
            function (Blueprint $table) {
                $table->id();
                $table->foreignId("offer_group_id")->constrained('offer_groups')->cascadeOnDelete();
                $table->boolean('status')->default(true)->comment('true-false');
                $table->string('image')->nullable();
                $table->timestamps();
            },
        );
    }


    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};
