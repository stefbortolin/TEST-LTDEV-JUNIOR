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
        Schema::create('conversions', function (Blueprint $table) {
            $table->id();
            $table->timestamp('fecha_conversion')->useCurrent();
            $table->string('ultima_actualizacion_btc');
            $table->decimal('precio_usd', 20, 10);
            $table->decimal('cantidad_usd', 20, 10);
            $table->decimal('cantidad_btc', 20, 10);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conversions');
    }
};
