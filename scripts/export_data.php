<?php
require 'vendor/autoload.php';  // Assuming PhpSpreadsheet is installed via Composer

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
include('../config/config.php'); // Database connection

// Create a new spreadsheet object
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Add headers to the sheet
$sheet->setCellValue('A1', 'Employee ID');
$sheet->setCellValue('B1', 'Name');
$sheet->setCellValue('C1', 'Department');
$sheet->setCellValue('D1', 'Communication');
$sheet->setCellValue('E1', 'Teamwork');
$sheet->setCellValue('F1', 'Productivity');
$sheet->setCellValue('G1', 'Average Score');
$sheet->setCellValue('H1', 'Rating Month');

// Apply styles to the header row
$sheet->getStyle('A1:H1')->getFont()->setBold(true);
$sheet->getStyle('A1:H1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('A1:H1')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
$sheet->getStyle('A1:H1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('D3D3D3');  // Light gray color

// Query to fetch employee performance data
$query = "
    SELECT e.employee_id, e.name, e.department, p.communication, p.teamwork, p.productivity, p.average_score, p.rating_month
    FROM employees e
    LEFT JOIN performance_ratings p ON e.employee_id = p.employee_id
";
$stmt = $pdo->prepare($query);
$stmt->execute();

// Initialize row for data insertion
$row = 2;

// Fetch and insert data into the spreadsheet
while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $sheet->setCellValue('A' . $row, $data['employee_id']);
    $sheet->setCellValue('B' . $row, $data['name']);
    $sheet->setCellValue('C' . $row, $data['department']);
    $sheet->setCellValue('D' . $row, $data['communication']);
    $sheet->setCellValue('E' . $row, $data['teamwork']);
    $sheet->setCellValue('F' . $row, $data['productivity']);
    $sheet->setCellValue('G' . $row, $data['average_score']);
    $sheet->setCellValue('H' . $row, $data['rating_month']);

    $row++;
}

// Set column widths to auto for better presentation
foreach (range('A', 'H') as $col) {
    $sheet->getColumnDimension($col)->setAutoSize(true);
}

// Set the response headers for Excel file download
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="employee_performance.xlsx"');
header('Cache-Control: max-age=0');

// Create the Excel file and send to the browser for download
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;
?>
