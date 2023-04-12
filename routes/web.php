<?php

use App\Imports\CsvImport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    ini_set('max_execution_time', 3000);
    set_time_limit(3000);
    DB::disableQueryLog();

    $time_start = microtime(true);
    $fileName = Storage::disk('local')->path('public/csv-rafael.csv');
    $handle = fopen($fileName, "r");
    $lineNumber = 1;

    // Iterate over every line of the file
    while (($raw_string = fgets($handle)) !== false) {
        $row = str_getcsv($raw_string, ';');
        $row = str_replace("'", "''", (array_map("utf8_encode", $row)));
        $dump[] = "('$row[0]', '$row[1]', '$row[2]', '$row[3]', '$row[4]', '$row[5]', '$row[6]', '$row[7]', '$row[8]', '$row[9]', '$row[10]', '$row[11]')";
//        $dump[] = [
//            'data_requerimento' => $row[0],
//            'numero_requerimento' => $row[1],
//            'cpf' => $row[2],
//            'pis_pasep_nit' => $row[3],
//            'nome_requerente' => $row[4],
//            'uf_recepcao' => $row[5],
//            'municipio_recepcao' => $row[6],
//            'numero_parcela' => $row[7],
//            'data_emissao_parcela' => $row[8],
//            'data_situacao_parcela' => $row[9],
//            'situacao_parcela' => $row[10],
//            'valor_situacao_parcela' => $row[11],
//        ];

        if ($lineNumber % 5000 === 0) {
            try {
                //DB::table('imports')->insert($dump);
                DB::insert("INSERT INTO imports (data_requerimento, numero_requerimento, cpf, pis_pasep_nit, nome_requerente, uf_recepcao, municipio_recepcao, numero_parcela, data_emissao_parcela, data_situacao_parcela, situacao_parcela, valor_situacao_parcela) VALUES ".implode(', ', $dump));
            } catch (\Exception $e) {
                dd($e->getMessage());
            }

            $dump = [];
        }

        $lineNumber++;

//        if($lineNumber > 5000) {
//            break;
//        }
    }

    fclose($handle);


    $time_end = microtime(true);
    $execution_time = ($time_end - $time_start);
    dd(number_format($lineNumber).' items stored with total execution time: ' . date("i:s.v",$execution_time). ' seconds');
});
