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
        Schema::create('quadras', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('qrd_user_id');
            $table->string('qrd_nome');
            $table->string('qrd_endereco');
            $table->string('qrd_bairro');
            $table->string('qrd_cidade');
            $table->string('qrd_uf', 2);
            $table->string('qrd_tamanho', 10);
            $table->string('qrd_hora_abertura');
            $table->string('qrd_hora_fechamento');
            $table->string('qrd_hora_valor');
            $table->string('qrd_final_semana');
            $table->string('qrd_users_edicao')->nullable();
            $table->string('qrd_imagem')->nullable();
            $table->timestamp('qrd_dt_criacao')->nullable();
            $table->timestamp('qrd_dt_atualizacao')->nullable();
            $table->string('qrd_status');
            $table->timestamps();
            
            $table->foreign('qrd_user_id')->references('id')->on('usuarios')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuarios'); 
    }
};
