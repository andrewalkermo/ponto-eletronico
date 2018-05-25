<?php
    require (__DIR__ . '/../vendor/autoload.php');
    require (__DIR__ . '/../controllers/MemberController.php');
    require (__DIR__ . '/../controllers/PointController.php');

    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    use PhpOffice\PhpSpreadsheet\IOFactory;

    Class RelatorioController {
        public static function membros(){

            $_POST['relatorio']['beginDate'] = str_replace('/', '-', $_POST['relatorio']['beginDate']);
            $beginDate = str_replace('/', '-', $_POST['relatorio']['beginDate']);
            $beginDate = date("Y-m-d", strtotime($beginDate));

            $_POST['relatorio']['endDate'] = str_replace('/', '-', $_POST['relatorio']['endDate']);
            $endDate = str_replace('/', '-', $_POST['relatorio']['endDate']);
            $endDate = date("Y-m-d", strtotime($endDate));

            $type = $_POST['relatorio']['tipo'];

            $membros = (object) MemberController::selectAll();

            $linhaInicioNome = 3;
            $linhainicioSemana = 3;
            $colunaInicioSemana = 'B';


            $nameFile = (strtoupper('TABELA DE MEMBROS - ' . $type .' - ' . $_POST['relatorio']['beginDate'] .' à ' . $_POST['relatorio']['endDate']) . '.xlsx');

            $reader = IOFactory::createReaderForFile(__DIR__ . '/../assets/files/MODEL_TABELA_MEMBROS.xlsx');
            $spreadsheet = $reader->load(__DIR__ . '/../assets/files/MODEL_TABELA_MEMBROS.xlsx');
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->setCellValue('A1' , strtoupper('TABELA DE MEMBROS - ' . $type .' - ' . $_POST['relatorio']['beginDate'] .' à ' . $_POST['relatorio']['endDate']));
            $dayweek = new DateTime($beginDate);
            for ($i = $colunaInicioSemana; $i != 'I'; $i++){
                $day = ($dayweek->format('d'));
                $sheet->setCellValue( $i . (string) '2' , ($spreadsheet->getActiveSheet()->getCell($i . (string) '2')->getValue() . ' - ' . $day));
                $dayweek->modify('+1 day');

            }
            foreach ($membros as $membro){
                $date = new DateTime($beginDate);
                $totalMinutosMembro = 0;


                for ($i = $colunaInicioSemana; $i != 'I'; $i++){

                    $sheet->setCellValue('A' . (string) $linhaInicioNome , $membro->name);


                    $dia = ($date->format('Y-m-d'));

                    $ponto = PointController::queryAll('SELECT * FROM point where `fk_members` = '.$membro->id_member.' 
                                                AND `begin_datetime` BETWEEN ("'. $dia .' 00:00:00") 
                                                AND ("'. $dia .' 23:59:59") 
                                                AND `type` = "' . $type . '"
                                                AND `end_datetime` IS NOT NULL 
                                                ORDER BY `begin_datetime`');

                    $date->modify('+1 day');


                    if(count($ponto) != 0){

                        for ($j = 0; $j < count($ponto); $j++) {
                            $chegada = new DateTime((date("Y-m-d", strtotime($ponto[$j]->begin_datetime)) . ' ' . $ponto[$j]->begin_time . ':00'));
                            $saida = new DateTime((date("Y-m-d", strtotime($ponto[$j]->end_datetime)) . ' ' . $ponto[$j]->end_time . ':00'));
                            $diferença = $saida->diff($chegada);
                            $diferença = $diferença->format('%H:%I');
                            list($hour, $minute) = explode(':', $diferença);
                            $totalMinutosMembro += $hour * 60;
                            $totalMinutosMembro += $minute;
                        }

                       if(count($ponto) == 1){
                           $sheet->setCellValue( $i . (string) $linhaInicioNome , ($ponto[0]->begin_time . " - " . $ponto[0]->end_time));
                       }
                       else {
                           $sheet->setCellValue( $i . (string) $linhaInicioNome , ($ponto[0]->begin_time . " - " . $ponto[0]->end_time));
                           for ($j = 1; $j < count($ponto); $j++) {
                               $valorAtual = $spreadsheet->getActiveSheet()->getCell($i . (string) $linhaInicioNome);
                               $sheet->setCellValue( $i . (string) $linhaInicioNome , ($valorAtual  . ' | ' . $ponto[$j]->begin_time . " - " . $ponto[$j]->end_time));
                                if($j == 2){
                                    break;
                                }
                           }
                       }

                    }
                }
                $hours = floor($totalMinutosMembro / 60);
                $totalMinutosMembro -= $hours * 60;
                $sheet->setCellValue('I' . (string) $linhaInicioNome , ((string) $hours) . 'h ' . (string) $totalMinutosMembro . 'm');

                $linhaInicioNome++;
            }

            $writer = new Xlsx($spreadsheet);
            $writer->save(__DIR__ . '/../assets/files/' . $nameFile);
            header('Location: http://' . $_SERVER['HTTP_HOST'] . '/assets/files/' . $nameFile);
//            unlink(__DIR__ . '/../assets/files/' . $nameFile);

        }

        public static function sede(){

            $_POST['relatorio']['beginDate'] = str_replace('/', '-', $_POST['relatorio']['beginDate']);
            $beginDate = str_replace('/', '-', $_POST['relatorio']['beginDate']);
            $beginDate = date("Y-m-d", strtotime($beginDate));

            $_POST['relatorio']['endDate'] = str_replace('/', '-', $_POST['relatorio']['endDate']);
            $endDate = str_replace('/', '-', $_POST['relatorio']['endDate']);
            $endDate = date("Y-m-d", strtotime($endDate));

            $type = $_POST['relatorio']['tipo'];

            $membros = (object) MemberController::selectAll();

            $linhaInicioNome = 3;
            $linhainicioSemana = 3;
            $colunaInicioSemana = 'B';

            $horarios = [
                0 => [
                    'inicio' => '07:00:00',
                    'fim' => '08:49:59'
                ],
                1 => [
                    'inicio' => '08:50:00',
                    'fim' => '10:39:59'
                ],
                2 => [
                    'inicio' => '10:40:00',
                    'fim' => '12:29:59'
                ],
                3 => [
                    'inicio' => '12:30:00',
                    'fim' => '12:59:59'
                ],
                4 => [
                    'inicio' => '13:00:00',
                    'fim' => '14:49:59'
                ],
                5 => [
                    'inicio' => '14:50:00',
                    'fim' => '16:39:59'
                ],
                6 => [
                    'inicio' => '16:40:00',
                    'fim' => '18:29:59'
                ],
                7 => [
                    'inicio' => '18:30:00',
                    'fim' => '20:19:59'
                ],
                8 => [
                    'inicio' => '20:20:00',
                    'fim' => '22:10:59'
                ]
            ];

            $nameFile = (strtoupper('TABELA DE MEMBROS - ' . $type .' - ' . $_POST['relatorio']['beginDate'] .' à ' . $_POST['relatorio']['endDate']) . '.xlsx');

            $reader = IOFactory::createReaderForFile(__DIR__ . '/../assets/files/MODEL_TABELA_MEMBROS.xlsx');
            $spreadsheet = $reader->load(__DIR__ . '/../assets/files/MODEL_TABELA_MEMBROS.xlsx');
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->setCellValue('A1' , strtoupper('TABELA DE SEDE - ' . $_POST['relatorio']['beginDate'] .' à ' . $_POST['relatorio']['endDate']));
            $dayweek = new DateTime($beginDate);
            for ($i = $colunaInicioSemana; $i != 'G'; $i++){
                $day = ($dayweek->format('d'));
                $sheet->setCellValue( $i . (string) '2' , ($spreadsheet->getActiveSheet()->getCell($i . (string) '2')->getValue() . ' - ' . $day));
                $dayweek->modify('+1 day');
                for ($j = 0; $j < count($horarios); $j++) {
//                    $ponto = PointController::queryAll('SELECT * FROM point where `fk_members` = '.$membro->id_member.'
//                                                AND `begin_datetime` BETWEEN ("'. $dia .' 00:00:00")
//                                                AND ("'. $dia .' 23:59:59")
//                                                AND `type` = "' . $type . '"
//                                                AND `end_datetime` IS NOT NULL
//                                                ORDER BY `begin_datetime`');
                }


            }
            foreach ($membros as $membro){
                $date = new DateTime($beginDate);


                for ($i = $colunaInicioSemana; $i != 'I'; $i++){

                    $sheet->setCellValue('A' . (string) $linhaInicioNome , $membro->name);


                    $dia = ($date->format('Y-m-d'));

                    $ponto = PointController::queryAll('SELECT * FROM point where `fk_members` = '.$membro->id_member.' 
                                                AND `begin_datetime` BETWEEN ("'. $dia .' 00:00:00") 
                                                AND ("'. $dia .' 23:59:59") 
                                                AND `type` = "' . $type . '"
                                                AND `end_datetime` IS NOT NULL 
                                                ORDER BY `begin_datetime`');

                    $date->modify('+1 day');


                    if(count($ponto) != 0){
                        if(count($ponto) == 1){
                            $sheet->setCellValue( $i . (string) $linhaInicioNome , ($ponto[0]->begin_time . " - " . $ponto[0]->end_time));
                        }
                        else {
                            $sheet->setCellValue( $i . (string) $linhaInicioNome , ($ponto[0]->begin_time . " - " . $ponto[0]->end_time));
                            for ($j = 1; $j < count($ponto); $j++) {
                                $valorAtual = $spreadsheet->getActiveSheet()->getCell($i . (string) $linhaInicioNome);
                                $sheet->setCellValue( $i . (string) $linhaInicioNome , ($valorAtual  . ' | ' . $ponto[$j]->begin_time . " - " . $ponto[$j]->end_time));
                                if($j == 2){
                                    break;
                                }
                            }
                        }

                    }
                }
                $linhaInicioNome++;
            }

            $writer = new Xlsx($spreadsheet);
            $writer->save(__DIR__ . '/../assets/files/' . $nameFile);
            header('Location: http://' . $_SERVER['HTTP_HOST'] . '/assets/files/' . $nameFile);
            unlink(__DIR__ . '/../assets/files/' . $nameFile);

        }
    }

$postActions = array('membros', 'sede');

if (isset($_POST['action']) && in_array($_POST['action'], $postActions)) {
    $action = $_POST['action'];
    RelatorioController::$action();
}