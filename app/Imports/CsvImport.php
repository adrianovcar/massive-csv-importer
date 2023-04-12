<?php

namespace App\Imports;

use App\Models\CsvLine;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

HeadingRowFormatter::default('none');

class CsvImport implements ToModel, WithChunkReading
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new CsvLine([
            'data_requerimento' => $row[0],
            'numero_requerimento' => $row[1],
            'cpf' => $row[2],
            'pis_pasep_nit' => $row[3],
            'nome_requerente' => $row[4],
            'uf_recepcao' => $row[5],
            'municipio_recepcao' => $row[6],
            'numero_parcela' => $row[7],
            'data_emissao_parcela' => $row[8],
            'data_situacao_parcela' => $row[9],
            'situacao_parcela' => $row[10],
            'valor_situacao_parcela' => $row[11],
        ]);
    }

//    public function batchSize(): int
//    {
//        return 10000;
//    }

    public function chunkSize(): int
    {
        return 65000;
    }
}
