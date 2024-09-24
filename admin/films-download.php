<?php

session_start();

if (!isset($_SESSION['login'])) {
    echo "<script> 
            alert('Please login first');
            document.location.href = 'login.php';
          </script>";

    exit;
}


require_once 'C:\Users\62813\vendor\autoload.php';
require 'config/app.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$activeWorksheet = $spreadsheet->getActiveSheet();

$activeWorksheet->setCellValue('A2', 'No')->getColumnDimension('A')->setAutoSize(true);
$activeWorksheet->setCellValue('B2', 'Category')->getColumnDimension('B')->setAutoSize(true);
$activeWorksheet->setCellValue('C2', 'Url')->getColumnDimension('C')->setAutoSize(true);
$activeWorksheet->setCellValue('D2', 'Title')->getColumnDimension('D')->setAutoSize(true);
$activeWorksheet->setCellValue('E2', 'Slug')->getColumnDimension('E')->setAutoSize(true);
$activeWorksheet->setCellValue('F2', 'Description')->getColumnDimension('F')->setAutoSize(true);
$activeWorksheet->setCellValue('G2', 'Release Date')->getColumnDimension('G')->setAutoSize(true);
$activeWorksheet->setCellValue('H2', 'Studio')->getColumnDimension('H')->setAutoSize(true);
$activeWorksheet->setCellValue('I2', 'Private')->getColumnDimension('I')->setAutoSize(true);

$styleColumn = [
    'borders' => [
        'allBorders' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
        ],
    ],
];

$no = 1;
$loc = 3;

$films = select("SELECT * FROM films");
$categories = select("SELECT * FROM categories");

foreach ($films as $film) {
    $activeWorksheet->setCellValue('A'. $loc, $no++);
    foreach ($categories as $category)
    {
        if ($category['id_category'] == $film['id_category']) {
            $activeWorksheet->setCellValue('B'. $loc, $category['title']);
        }
    }
    $activeWorksheet->setCellValue('C'. $loc, $film['url']);
    $activeWorksheet->setCellValue('D'. $loc, $film['title']);
    $activeWorksheet->setCellValue('E'. $loc, $film['slug']);
    $activeWorksheet->setCellValue('F'. $loc, $film['description']);
    $activeWorksheet->setCellValue('G'. $loc, $film['release_date']);
    $activeWorksheet->setCellValue('H'. $loc, $film['studio']);
    $activeWorksheet->setCellValue('I'. $loc, $film['is_private']);
    $loc++;
}

$activeWorksheet->getStyle('A2:I'. ($loc-1))->applyFromArray($styleColumn);

$writer = new Xlsx($spreadsheet);
$file_name = 'Film List.xlsx';
$writer->save($file_name);

// ganti proses download ke folder download bukan project 
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Length:' . filesize($file_name));
header('Content-Disposition: attachment; filename="' . $file_name.'"');
readfile($file_name);
unlink($file_name);