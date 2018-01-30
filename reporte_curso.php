<?php
session_start();
if(isset($_SESSION['conectado']) && $_SESSION['conectado'] == "si") {
    include "conexion.php";

    $sql = "SELECT * FROM curso
            INNER JOIN profesor ON profesor.id_profesor = curso.id_profesor
            INNER JOIN usuario ON usuario.rut_usr = profesor.rut_usr
            WHERE curso.id_curso = $_GET[curso]";
    $res = $dbcon->query($sql);
    while($datos = mysqli_fetch_array($res)){
        $nombre_curso = $datos['nombre_curso'];
        $nombre_profe = $datos['nombre_usr'].' '.$datos['apellido_p_usr'].' '.$datos['apellido_m_usr'];
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
        ->setTitle("Reporte Curso")// Titulo
        ->setSubject("Reporte Curso")//Asunto
        ->setDescription("Reporte Curso")//Descripción
        ->setKeywords("Reporte Curso")//Etiquetas
        ->setCategory("Reporte excel"); //Categorias

//----------------------------------------------------------------------------------------------------------------------------------

        $tituloReporte = array('Alumnos', 'Observaciones', 'Asistencia a reunion', 'Asistencia');
        $titulosColumnas = array('Nota 1', 'Nota 2', 'Nota 3', 'Nota 4', 'Nota 5', 'Nota 6', 'Nota 7', 'Nota 8', 'Nota 9', 'Nota 10', 'Promedio');

        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('B1',$nombre_curso)
            ->setCellValue('B2','Profesor(a): '.$nombre_profe);

        // Se combinan las celdas A1 hasta D1, para colocar ahí el titulo del reporte
        $objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('D2:F2')
            ->mergeCells('H3:J3')
            ->mergeCells('L4:P4');

        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('B4',$tituloReporte[0])// Titulo del reporte
            ->setCellValue('D3',$tituloReporte[1])
            ->setCellValue('H3',$tituloReporte[2])
            ->setCellValue('L3',$tituloReporte[3])
            ->setCellValue('D4','positiva')
            ->setCellValue('E4','negativa')
            ->setCellValue('F4','firma apoderado')
            ->setCellValue('H4','asistencia a reunion')
            ->setCellValue('I4','total')
            ->setCellValue('J4','no asistido')
            ->setCellValue('L4','Inasist')
            ->setCellValue('M4','Asist')
            ->setCellValue('N4','%Asist')
            ->setCellValue('O4','Dias Trabajados');


        $sql2 = "SELECT * FROM lista
                INNER JOIN alumno ON alumno.id_alumno = lista.id_alumno
                INNER JOIN usuario ON usuario.rut_usr = alumno.rut_usr
                WHERE lista.id_curso = $_GET[curso] AND lista.anio = YEAR(NOW())
                ORDER BY usuario.nombre_usr";
        $res2 = $dbcon->query($sql2);

        $f = 5;
        while($datos2 = mysqli_fetch_array($res2)){
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('B'.$f,$datos2['nombre_usr'].' '.$datos2['apellido_p_usr'].' '.$datos2['apellido_m_usr']);



            $f++;
        }


        // Se asigna el nombre a la hoja
        $objPHPExcel->getActiveSheet()->setTitle('Lista');


        //Ancho columnas
        $columnas = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O',);
        for($i=0;$i<15;$i++) {
            $objPHPExcel->getActiveSheet()->getColumnDimension($columnas[$i])->setAutoSize(true);
        }


        $sql3 = "SELECT * FROM asignatura
                INNER JOIN clase ON clase.id_asignatura = asignatura.id_asignatura
                WHERE clase.id_curso = $_GET[curso] AND clase.anio = YEAR(NOW())
                ORDER BY asignatura.nombre_asignatura";
        $res3 = $dbcon->query($sql3);

        $p = 1;
        while($datos3 = mysqli_fetch_array($res3)){
            $objPHPExcel->createSheet();
            $objPHPExcel->setActiveSheetIndex($p)
                ->setCellValue('B1','Curso: '.$nombre_curso)
                ->setCellValue('B4','Alumnos');

            $sql4 = "SELECT * FROM clase
                    INNER JOIN profesor ON profesor.id_profesor = clase.id_profesor 
                    INNER JOIN usuario ON usuario.rut_usr = profesor.rut_usr
                    WHERE clase.id_curso = $_GET[curso] AND clase.id_asignatura = $datos3[id_asignatura]
                    AND clase.anio = YEAR(NOW())";
            $res4 = $dbcon->query($sql4);

            while($datos4 = mysqli_fetch_array($res4)){
                $objPHPExcel->setActiveSheetIndex($p)
                    ->setCellValue('B2','Profesor(a): '.$datos4['nombre_usr'].' '.$datos4['apellido_p_usr'].' '.$datos4['apellido_m_usr']);
            }

            $sql5 = "SELECT * FROM lista
                INNER JOIN alumno ON alumno.id_alumno = lista.id_alumno
                INNER JOIN usuario ON usuario.rut_usr = alumno.rut_usr
                WHERE lista.id_curso = $_GET[curso] 
                ORDER BY usuario.nombre_usr";
            $res5 = $dbcon->query($sql5);

            $f=5;
            while($datos5 = mysqli_fetch_array($res5)){
                $objPHPExcel->setActiveSheetIndex($p)
                    ->setCellValue('B'.$f,$datos5['nombre_usr'].' '.$datos5['apellido_p_usr'].' '.$datos5['apellido_m_usr']);

                $sql6 = "SELECT * FROM semestre
                        WHERE semestre.anio = YEAR(NOW())";

                $res6 = $dbcon->query($sql6);

                while($datos6 = mysqli_fetch_array($res6)){

                    $notas = array(null,null,null,null,null,null,null,null,null,null);

                    if($datos6['nombre_sem'] == 'Primer Semestre'){

                        $objPHPExcel->setActiveSheetIndex($p)
                            ->mergeCells('C3:M3')->setCellValue('C3',$datos6['nombre_sem']);

                        $objPHPExcel->setActiveSheetIndex($p)
                            ->setCellValue('C4',$titulosColumnas[0])
                            ->setCellValue('D4',$titulosColumnas[1])
                            ->setCellValue('E4',$titulosColumnas[2])
                            ->setCellValue('F4',$titulosColumnas[3])
                            ->setCellValue('G4',$titulosColumnas[4])
                            ->setCellValue('H4',$titulosColumnas[5])
                            ->setCellValue('I4',$titulosColumnas[6])
                            ->setCellValue('J4',$titulosColumnas[7])
                            ->setCellValue('K4',$titulosColumnas[8])
                            ->setCellValue('L4',$titulosColumnas[9])
                            ->setCellValue('M4',$titulosColumnas[10]);

                        $sql7 = "SELECT * FROM nota
                                WHERE nota.id_alumno = $datos5[id_alumno] AND nota.id_asignatura = $datos3[id_asignatura]
                                AND nota.id_semestre = $datos6[id_semestre]";
                        $res7 = $dbcon->query($sql7);

                        $n=0;
                        $suma_notas_p = 0;
                        $num_notas_p = mysqli_num_rows($res7);

                        while($datos7 = mysqli_fetch_array($res7)){
                            $notas[$n] = $datos7['nota'];
                            $suma_notas_p = $suma_notas_p + $datos7['nota'];
                            $n++;
                        }

                        for($i = 0;$i < 10;$i++){

                                if ($i == 0) {
                                    $objPHPExcel->setActiveSheetIndex($p)->setCellValue('C'.$f, $notas[$i]);
                                }
                                if ($i == 1) {
                                    $objPHPExcel->setActiveSheetIndex($p)->setCellValue('D'.$f, $notas[$i]);
                                }
                                if ($i == 2) {
                                    $objPHPExcel->setActiveSheetIndex($p)->setCellValue('E'.$f, $notas[$i]);
                                }
                                if ($i == 3) {
                                    $objPHPExcel->setActiveSheetIndex($p)->setCellValue('F'.$f, $notas[$i]);
                                }
                                if ($i == 4) {
                                    $objPHPExcel->setActiveSheetIndex($p)->setCellValue('G'.$f, $notas[$i]);
                                }
                                if ($i == 5) {
                                    $objPHPExcel->setActiveSheetIndex($p)->setCellValue('H'.$f, $notas[$i]);
                                }
                                if ($i == 6) {
                                    $objPHPExcel->setActiveSheetIndex($p)->setCellValue('I'.$f, $notas[$i]);
                                }
                                if ($i == 7) {
                                    $objPHPExcel->setActiveSheetIndex($p)->setCellValue('J'.$f, $notas[$i]);
                                }
                                if ($i == 8) {
                                    $objPHPExcel->setActiveSheetIndex($p)->setCellValue('K'.$f, $notas[$i]);
                                }
                                if ($i == 9) {
                                    $objPHPExcel->setActiveSheetIndex($p)->setCellValue('L'.$f, $notas[$i]);
                                }

                                if($num_notas_p == 0)$num_notas_p = 1;
                                $div = $suma_notas_p/$num_notas_p;
                                $prom = number_format($div,1,".",",");
                                $objPHPExcel->setActiveSheetIndex($p)->setCellValue('M'.$f,$prom);
                        }

                    }
                    else{
                        $objPHPExcel->setActiveSheetIndex($p)
                            ->mergeCells('O3:Y3')->setCellValue('O3',$datos6['nombre_sem']);

                        $objPHPExcel->setActiveSheetIndex($p)
                            ->setCellValue('O4',$titulosColumnas[0])
                            ->setCellValue('P4',$titulosColumnas[1])
                            ->setCellValue('Q4',$titulosColumnas[2])
                            ->setCellValue('R4',$titulosColumnas[3])
                            ->setCellValue('s4',$titulosColumnas[4])
                            ->setCellValue('T4',$titulosColumnas[5])
                            ->setCellValue('U4',$titulosColumnas[6])
                            ->setCellValue('V4',$titulosColumnas[7])
                            ->setCellValue('W4',$titulosColumnas[8])
                            ->setCellValue('x4',$titulosColumnas[9])
                            ->setCellValue('Y4',$titulosColumnas[10])
                            ->setCellValue('AA4','Final');


                        $sql7 = "SELECT * FROM nota
                                WHERE nota.id_alumno = $datos5[id_alumno] AND nota.id_asignatura = $datos3[id_asignatura]
                                AND nota.id_semestre = $datos6[id_semestre]";
                        $res7 = $dbcon->query($sql7);

                        $n=0;
                        $suma_notas_s = 0;
                        $num_notas_s = mysqli_num_rows($res7);

                        while($datos7 = mysqli_fetch_array($res7)){
                            $notas[$n] = $datos7['nota'];
                            $suma_notas_s = $suma_notas_s + $datos7['nota'];
                            $n++;
                        }

                        for($i = 0;$i < 10;$i++){

                            if ($i == 0) {
                                $objPHPExcel->setActiveSheetIndex($p)->setCellValue('O'.$f, $notas[$i]);
                            }
                            if ($i == 1) {
                                $objPHPExcel->setActiveSheetIndex($p)->setCellValue('P'.$f, $notas[$i]);
                            }
                            if ($i == 2) {
                                $objPHPExcel->setActiveSheetIndex($p)->setCellValue('Q'.$f, $notas[$i]);
                            }
                            if ($i == 3) {
                                $objPHPExcel->setActiveSheetIndex($p)->setCellValue('R'.$f, $notas[$i]);
                            }
                            if ($i == 4) {
                                $objPHPExcel->setActiveSheetIndex($p)->setCellValue('S'.$f, $notas[$i]);
                            }
                            if ($i == 5) {
                                $objPHPExcel->setActiveSheetIndex($p)->setCellValue('T'.$f, $notas[$i]);
                            }
                            if ($i == 6) {
                                $objPHPExcel->setActiveSheetIndex($p)->setCellValue('U'.$f, $notas[$i]);
                            }
                            if ($i == 7) {
                                $objPHPExcel->setActiveSheetIndex($p)->setCellValue('V'.$f, $notas[$i]);
                            }
                            if ($i == 8) {
                                $objPHPExcel->setActiveSheetIndex($p)->setCellValue('W'.$f, $notas[$i]);
                            }
                            if ($i == 9) {
                                $objPHPExcel->setActiveSheetIndex($p)->setCellValue('X'.$f, $notas[$i]);
                            }

                            if($num_notas_s == 0)$num_notas_s = 1;
                            $div = $suma_notas_s/$num_notas_s;
                            $prom = number_format($div,1,".",",");
                            $objPHPExcel->setActiveSheetIndex($p)->setCellValue('Y'.$f,$prom);
                        }

                        $suma_total = $suma_notas_p + $suma_notas_s;
                        $num_total = $num_notas_p + $num_notas_s;
                        $div_total = $suma_total/$num_total;

                        $prom_total = $prom = number_format($div_total,1,".",",");
                        $objPHPExcel->setActiveSheetIndex($p)->setCellValue('AA'.$f,$prom_total);

                    }


                }

                $f++;
            }

            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->setTitle($datos3['nombre_asignatura']);
            $p++;
        }



//----------------------------------------------------------------------------------------------------------------------------------



        // Se activa la hoja para que sea la que se muestre cuando el archivo se abre
        $objPHPExcel->setActiveSheetIndex(0);

        // Inmovilizar paneles
        //$objPHPExcel->getActiveSheet(0)->freezePane('A4');
        $objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0,4);

        // Se manda el archivo al navegador web, con el nombre que se indica, en formato 2007
        header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
        header('Content-Disposition: attachment;filename="Reporte_'.$nombre_curso.'.xlsx"');
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