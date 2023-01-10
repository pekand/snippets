<?php

ini_set('memory_limit', '1024M');

require_once __DIR__ . '\vendor\autoload.php';


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$header = ['column1','column2','column3','column4',];

$data = [
	['column1','column2','column3','column4',],
	['column1'=>'value1','column2'=>'value2','column3'=>'value3','column4'=>'value4',],
	['column1'=>'value5','column2'=>'value6','column3'=>'value7','column4'=>'value8',],
];

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->fromArray($data, null, 'A1');
//$sheet->setCellValue('B1','testing');

$sheet->getStyle('A1:D1')->getFill()
	->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
	->getStartColor()->setARGB('FF000000');
$sheet->getStyle('A1:D1')->getFont()->getColor()->setRGB('FFFFFF');

$writer = new Xlsx($spreadsheet);

ob_start();
$writer->save('php://output');
$export = ob_get_contents();

$filenameWithStamp = "export-".date("Y_m_d-h_i_s").".xlsx";

header('Content-Disposition: attachment; filename=' . $filenameWithStamp );
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Length: ' . strlen($export));
header('Content-Transfer-Encoding: binary');
header('Cache-Control: must-revalidate');
header('Pragma: public');

echo $export;
file_put_contents($filenameWithStamp, $export);