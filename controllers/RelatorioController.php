<?php
require (__DIR__ . '/../vendor/autoload.php');
require (__DIR__ . '/../controllers/MemberController.php');

    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

    $membros = (object) MemberController::selectAll();

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setCellValue('A1', 'NOME');
    $sheet->setCellValue('B1', 'SEG');
    $sheet->setCellValue('C1', 'TER');
    $sheet->setCellValue('D1', 'QUA');
    $sheet->setCellValue('E1', 'QUI');
    $sheet->setCellValue('F1', 'SEX');
    $sheet->setCellValue('G1', 'SAB');
    $sheet->setCellValue('H1', 'DOM');
    $sheet->setCellValue('I1', 'TOTAL');

    $comeco = 2;
    foreach ($membros as $membro){
        $sheet->setCellValue('A' . (string) $comeco++ , $membro->name);
    }

    $writer = new Xlsx($spreadsheet);
    $writer->save(__DIR__ . '/../assets/files/hello world.xlsx');
    header('Location: http://' . $_SERVER['HTTP_HOST'] . '/assets/files/hello world.xlsx');
