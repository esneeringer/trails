<?php
/**
 * Created by PhpStorm.
 * User: esneeringer
 * Date: 5/29/2018
 * Time: 3:27 PM
 */

namespace App\Http\Controllers;

use PhpOffice\PhpSpreadsheet\Reader\Csv;


class CsvController extends Controller
{
    public function getFile(){

        $reader = new Csv();

        $spreadsheet = $reader->load('C:\Users\esneeringer\trails\test.csv');

        $spreadsheetData = $spreadsheet->getActiveSheet()->toArray();


        dd($spreadsheetData);
    }
}