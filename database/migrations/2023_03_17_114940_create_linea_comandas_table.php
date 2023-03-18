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
        Schema::create('linea_comandas', function (Blueprint $table) {
            $table->id();
            $table->integer('cantidad');
            $table->unsignedBigInteger('id_plato');
            $table->foreign('id_plato')->references('id')->on('platos')->onDelete('cascade')
            ->onUpdate('cascade');
            $table->unsignedBigInteger('id_comanda');
            $table->foreign('id_comanda')->references('id')->on('comandas')->onDelete('cascade')
            ->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('linea_comandas');
    }
};
