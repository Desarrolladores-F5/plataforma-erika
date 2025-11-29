<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Si la tabla ya existe NO hacemos nada para evitar errores
        if (Schema::hasTable('courses')) {
            return;
        }

        Schema::create('courses', function (Blueprint $table) {
            $table->id();

            // Básico
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();

            // Multimedia
            $table->string('thumbnail')->nullable();      // Imagen pequeña
            $table->string('banner_url')->nullable();     // Imagen grande principal
            $table->string('promo_video_url')->nullable(); // Video promocional

            // Comercial
            $table->decimal('price', 8, 2)->default(0);
            $table->boolean('is_published')->default(false);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
