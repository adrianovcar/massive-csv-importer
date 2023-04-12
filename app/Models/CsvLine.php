<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CsvLine extends Model
{
    protected $table = 'imports';

    protected $fillable = [
        'data_requerimento',
        'numero_requerimento',
        'cpf',
        'pis_pasep_nit',
        'nome_requerente',
        'uf_recepcao',
        'municipio_recepcao',
        'numero_parcela',
        'data_emissao_parcela',
        'data_situacao_parcela',
        'situacao_parcela',
        'valor_situacao_parcela',
    ];

    use HasFactory;
}
