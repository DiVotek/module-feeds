<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('feed_fields', function (Blueprint $table) {
            $table->id();
            $table->string('feed_id');
            $table->string('name');
            $table->string('XML_tag');
            $table->boolean('is_visible');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('feed_fields');
    }
};
