<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        /*
                array(
          "id" => 1,
          "nombre" => "Cervezas La Virgen",
          "descripcion" => "Cervecería artesanal con cervezas de alta calidad elaboradas con ingredientes naturales.",
          "poblacion" => "Las Rozas de Madrid",
          "latitud" => 40.4939, 
          "longitud" => -3.8735
        ),
        */
        Schema::create('breweries', function (Blueprint $table) {
            $table->id();
            $table->string('name', 200);
            $table->text('description');
            $table->string('place', 200);
            $table->decimal('latitude', 10, 3);
            $table->decimal('longitude', 10, 3);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('breweries');
    }
};
