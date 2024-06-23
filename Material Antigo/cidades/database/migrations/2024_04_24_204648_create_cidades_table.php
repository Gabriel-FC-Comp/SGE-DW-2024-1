<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estados', function (Blueprint $table) {
            $table->string('sigla');
            $table->string('nome',80);
            $table->primary('sigla');

            //$table->timestamps();
        });

        Schema::create('cidades', function (Blueprint $table) {
            $table->integer('codigo');
            $table->string('nome',80);
            $table->string('sigla_estado',2);
            $table->primary('codigo');
            $table->foreign('sigla_estado')->references('sigla')->on('estados');

            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cidades');
        Schema::dropIfExists('estados');
    }
}