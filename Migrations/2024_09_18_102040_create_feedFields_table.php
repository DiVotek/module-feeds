<?php

use App\Services\Status;
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
            $table->boolean('is_visible')->default(Status::ON);
            $table->boolean('is_req')->default(Status::OFF);
            $table->string('product_field');
            $table->string('category_field');
            $table->boolean('isProduct')->default(Status::OFF);
            $table->boolean('is_category')->default(Status::OFF);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('feedFields');
    }
};
