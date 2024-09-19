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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('user_nome');
            $table->string('user_cpf')->unique();
            $table->string('user_email')->unique();
            $table->string('user_senha');
            $table->integer('user_nivel');
            $table->timestamp('user_dt_criacao')->useCurrent(); // Corrigido para timestamp
            $table->string('user_status');
            $table->string('user_telefone');
            $table->timestamps(); // Adiciona created_at e updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuarios'); // Remove a tabela e suas colunas
    }
};
