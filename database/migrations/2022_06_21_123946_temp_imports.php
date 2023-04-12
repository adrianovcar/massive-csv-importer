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
        Schema::create('imports', function (Blueprint $table) {
            $table->id();
            $table->string('data_requerimento');
            $table->string('numero_requerimento');
            $table->string('cpf');
            $table->string('pis_pasep_nit');
            $table->string('nome_requerente');
            $table->string('uf_recepcao');
            $table->string('municipio_recepcao');
            $table->string('numero_parcela');
            $table->string('data_emissao_parcela');
            $table->string('data_situacao_parcela');
            $table->string('situacao_parcela');
            $table->string('valor_situacao_parcela');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
