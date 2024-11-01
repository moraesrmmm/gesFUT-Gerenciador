<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('denuncias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dnc_user_id');
            $table->unsignedBigInteger('dnc_rsv_id');
            $table->string('dnc_descricao');
            $table->timestamp('dnc_data');
            $table->string('dnc_status');
            $table->timestamps();
            
            $table->foreign('dnc_user_id')->references('id')->on('usuarios')->onDelete('cascade');
            $table->foreign('dnc_rsv_id')->references('id')->on('reservas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('denuncias');
    }
};
