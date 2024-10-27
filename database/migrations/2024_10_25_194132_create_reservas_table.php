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
        Schema::create('reservas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rsv_user_id');
            $table->unsignedBigInteger('rsv_quadra_id');
            $table->string('rsv_valor_total');
            $table->timestamp('rsv_data');
            $table->timestamp('rsv_data_cancelamento')->nullable();
            $table->timestamp('rsv_data_edicao')->nullable();
            $table->string('rsv_status');
            $table->timestamps();
            
            $table->foreign('rsv_user_id')->references('id')->on('usuarios')->onDelete('cascade');
            $table->foreign('rsv_quadra_id')->references('id')->on('quadras')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservas');
    }
};
