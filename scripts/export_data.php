<?php
require 'vendor/autoload.php';  // Assuming PhpSpreadsheet is installed via Composer

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Add headers
$sheet->setCellValue('A1', 'Employee ID');
$sheet->setCellValue('B1', 'Name');
$sheet->setCellValue('C1', 'Department');
// Add more headers as needed...

// Fetch data from database and add to sheet...

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
?>
