<?php
session_start();
if(isset($_SESSION['conectado']) && $_SESSION['conectado'] == "si") {
    include "conexion.php";

    $sql = "SELECT * FROM alumno
            INNER JOIN usuario ON alumno.rut_usr = usuario.rut_usr
            WHERE alumno.id_alumno = $_GET[id]";
    $res = $dbcon->query($sql);
    while($datos = mysqli_fetch_array($res)){
        $nombre = $datos['nombre_usr'];
        $apellido_p = $datos['apellido_p_usr'];
        $apellido_m = $datos['apellido_m_usr'];
    }

    if(mysqli_num_rows($res) > 0) {

        date_default_timezone_set('Chile/Continental');

        if (PHP_SAPI == 'cli')
            die('Este archivo solo se puede ver desde un navegador web');

        require_once 'excel/PHPExcel.php';

        $objPHPExcel = new PHPExcel();

        // Se asignan las propiedades del libro
        $objPHPExcel->getProperties()->setCreator("Gestion LPC")// Nombre del autor
                                     ->setLastModifiedBy("Gestion LPC")//Ultimo usuario que lo modificó
                                     ->setTitle("Reporte Alumno")// Titulo
                                     ->setSubject("Reporte Alumno")//Asunto
                                     ->setDescription("Reporte Alumno")//Descripción
                                     ->setKeywords("Reporte Alumno")//Etiquetas
                                     ->setCategory("Reporte excel"); //Categorias

//----------------------------------------------------------------------------------------------------------------------------------

        $tituloReporte = "Informe ".$nombre." ".$apellido_p." ".$apellido_m;
        $titulosColumnas = array('Asignaturas', 'Nota 1', 'Nota 2', 'Nota 3', 'Nota 4', 'Nota 5', 'Nota 6', 'Nota 7', 'Nota 8', 'Nota 9', 'Nota 10', 'Promedio');


        // Se combinan las celdas A1 hasta D1, para colocar ahí el titulo del reporte
        $objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('B1:H1');

        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B1',$tituloReporte);// Titulo del reporte

        $sql2 = "SELECT * FROM semestre WHERE anio = YEAR(NOW()) ORDER BY nombre_sem";
        $res2 = $dbcon->query($sql2);

        $fila = 3;
        while ($datos2 = mysqli_fetch_array($res2)){
            if($datos2['nombre_sem'] == 'Primer Semestre'){
                $h = 0;
            }
            else{
                $h=1;
            }


            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('B'.$fila.':H'.$fila)
                        ->setCellValue('B'.$fila,$datos2['nombre_sem']);


            $sql3 = "SELECT * FROM asignatura
                          INNER JOIN clase ON clase.id_asignatura = asignatura.id_asignatura
                          INNER JOIN curso ON curso.id_curso = clase.id_curso
                          INNER JOIN lista ON lista.id_curso = curso.id_curso
                          INNER JOIN alumno ON alumno.id_alumno = lista.id_alumno
                          WHERE alumno.id_alumno = $_GET[id] ORDER BY asignatura.nombre_asignatura";
            $res3 = $dbcon->query($sql3);

            $i = 5;
            while ($datos3 = mysqli_fetch_array($res3)){

                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$i,$datos3['nombre_asignatura']);


                $sql4 = "SELECT nota FROM nota 
                        WHERE id_alumno = $_GET[id] AND id_asignatura = $datos3[id_asignatura]
                        AND id_semestre = $datos2[id_semestre]";

                $res4 = $dbcon->query($sql4);
                $notas = array(null,null,null,null,null,null,null,null,null,null);

                $j=0;
                while($datos4 = mysqli_fetch_array($res4)){
                    $notas[$j] = $datos4['nota'];
                    $j++;
                }

                $suma = 0;
                $num_notas = 0;

                for($k = 0; $k < 10; $k++){
                    if($notas[$k] != null) {

                        if($k=0){
                            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$i,$notas[$k]);
                        }
                        if($k=1){
                            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$i,$notas[$k]);
                        }
                        if($k=2){
                            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$i,$notas[$k]);
                        }
                        if($k=3){
                            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$i,$notas[$k]);
                        }
                        if($k=4){
                            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$i,$notas[$k]);
                        }
                        if($k=5){
                            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$i,$notas[$k]);
                        }
                        if($k=6){
                            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.$i,$notas[$k]);
                        }
                        if($k=7){
                            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.$i,$notas[$k]);
                        }
                        if($k=8){
                            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.$i,$notas[$k]);
                        }
                        if($k=9){
                            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('K'.$i,$notas[$k]);
                        }

                        $suma = $suma + $notas[$k];
                        $num_notas++;

                    }
                    else{


                    }
                }

                $i++;
            }



        }


        // Se agregan los titulos del reporte
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A4',  $titulosColumnas[0])  //Titulo de las columnas
            ->setCellValue('B4',  $titulosColumnas[1])
            ->setCellValue('C4',  $titulosColumnas[2])
            ->setCellValue('D4',  $titulosColumnas[3])
            ->setCellValue('E4',  $titulosColumnas[4])
            ->setCellValue('F4',  $titulosColumnas[5])
            ->setCellValue('G4',  $titulosColumnas[6])
            ->setCellValue('H4',  $titulosColumnas[7])
            ->setCellValue('I4',  $titulosColumnas[8])
            ->setCellValue('J4',  $titulosColumnas[9])
            ->setCellValue('K4',  $titulosColumnas[10])
            ->setCellValue('L4',  $titulosColumnas[11]);








        //Ancho columnas
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);



//----------------------------------------------------------------------------------------------------------------------------------

        // Se asigna el nombre a la hoja
        $objPHPExcel->getActiveSheet()->setTitle('Alumno');

        // Se activa la hoja para que sea la que se muestre cuando el archivo se abre
        $objPHPExcel->setActiveSheetIndex(0);

        // Inmovilizar paneles
        //$objPHPExcel->getActiveSheet(0)->freezePane('A4');
        $objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,4);

        // Se manda el archivo al navegador web, con el nombre que se indica, en formato 2007
        header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
        header('Content-Disposition: attachment;filename="Reporte_'.$nombre.'_'.$apellido_p.'_'.$apellido_m.'.xlsx"');
        header('Cache-Control: max-age=0');

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        ob_end_clean();
        $objWriter->save('php://output');
        exit;
    }
    else{
        print_r("no hay resusltados que mostrar");
    }
    include "cerrar_conexion.php";
}
?>