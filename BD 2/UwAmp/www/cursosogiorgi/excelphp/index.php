<?php

/** Inclui a biblioteca PHPExcel */
require_once 'phpexcel/Classes/PHPExcel.php';

// Cria um novo objeto PHPExcel

$objPHPExcel = new PHPExcel();
// Adiciona uma descrição no início da planilha

$objPHPExcel->getActiveSheet()->setCellValue('A1', 'Cálculos usando fórmulas');

// Define a largura das colunas de modo automático

$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);

// Label da fórmula soma

$objPHPExcel->getActiveSheet()->setCellValue('A6', 'Soma:');

// Adiciona os dados nas colulas B e C para usar nas fórmulas.

$objPHPExcel->getActiveSheet()->setCellValue('B2', 'Valores 1')
        ->setCellValue('B3', 3)
        ->setCellValue('B4', 7)
        ->setCellValue('B5', 13)
        ->setCellValue('B6', '=SUM(B3:B5)');

$objPHPExcel->getActiveSheet()->setCellValue('C2', 'Valores 2')
        ->setCellValue('C3', 5)
        ->setCellValue('C4', 11)
        ->setCellValue('C5', 17)
        ->setCellValue('C6', '=SUM(C3:C5)');

// Fórmula que calcula o valor total do intervalo

$objPHPExcel->getActiveSheet()->setCellValue('A8', 'Valor total do intervalo:');
$objPHPExcel->getActiveSheet()->setCellValue('B8', '=SUM(B6:C6)');

// Fórmula que calcula o valor mínimo do intervalo

$objPHPExcel->getActiveSheet()->setCellValue('A9', 'Valor mínimo do intervalo:');
$objPHPExcel->getActiveSheet()->setCellValue('B9', '=MIN(B3:C5)');

// Fórmula que calcula o máximo total do intervalo

$objPHPExcel->getActiveSheet()->setCellValue('A10', 'Valor máximo do intervalo:');
$objPHPExcel->getActiveSheet()->setCellValue('B10', '=MAX(B3:C5)');

// Fórmula que calcula a média do intervalo

$objPHPExcel->getActiveSheet()->setCellValue('A11', 'Média do intervalo:');
$objPHPExcel->getActiveSheet()->setCellValue('B11', '=AVERAGE(B3:C5)');

// Seta a primeira planilha como padrão

$objPHPExcel->setActiveSheetIndex(0);

// Redireciona a saída para o navegador

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="exemplo4.xlsx"');
header('Cache-Control: max-age=0');
header('Cache-Control: max-age=1');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // Data de modificação
header('Cache-Control: cache, must-revalidate');
header('Pragma: public');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');

exit;
?>