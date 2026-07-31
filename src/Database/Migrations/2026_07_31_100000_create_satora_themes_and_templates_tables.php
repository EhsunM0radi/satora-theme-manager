<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('satora_themes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->unique();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('preview_image')->nullable();
            $table->json('colors')->nullable();
            $table->json('typography')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->json('metadata')->nullable();
            $table->timestamps();
        });

        Schema::create('satora_templates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->unique();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('preview_image')->nullable();
            $table->json('sections')->nullable();
            $table->json('navigation')->nullable();
            $table->json('homepage_layout')->nullable();
            $table->json('default_pages')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->json('metadata')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('satora_templates');
        Schema::dropIfExists('satora_themes');
    }
};
