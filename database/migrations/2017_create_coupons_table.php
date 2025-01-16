<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create(
            'coupons',
            function (Blueprint $table) {
                $table->id();
                $table->string('code');
                $table->foreignId('store_id')->constrained('stores')->onDelete('cascade');
                $table->foreignId("category_id")->constrained('categories')->onDelete('cascade');
                $table->string('url');
                $table->string('description');
                $table->boolean('is_work')->default(true);
                $table->timestamps();
            },
        );
    }
    public function down(): void
    {
        Schema::dropIfExists(
            'coupons',
        );
    }
};
