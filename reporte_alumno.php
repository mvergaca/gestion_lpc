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

    $sql5 = "SELECT * FROM curso
              INNER JOIN lista ON lista.id_curso = curso.id_curso
              INNER JOIN alumno ON alumno.id_alumno = lista.id_alumno
              WHERE alumno.id_alumno = $_GET[id] ";
    $res5 = $dbcon->query($sql5);
    while($datos5 = mysqli_fetch_array($res5)){
        $nombre_curso = $datos5['nombre_curso'];
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

        $tituloReporte = array('Informe de calificaciones anuales', $nombre_curso, 'DECRETO DE EVALUACION N° 112 de 1999', $nombre.' '.$apellido_p.' '.$apellido_m);
        $titulosColumnas = array('Asignaturas', 'Nota 1', 'Nota 2', 'Nota 3', 'Nota 4', 'Nota 5', 'Nota 6', 'Nota 7', 'Nota 8', 'Nota 9', 'Nota 10', 'Promedio');


        $estilo1 = array(
            'borders' => array(
                'outline' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );

        $estilo2 = array(
            'borders' => array(
                'outline' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            ),
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
            ),
            'font'  => array(
                'bold'  => true
            )
        );

        $estilo3 = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
            ),
            'font'  => array(
                'bold'  => true
            )
        );


        // Se combinan las celdas A1 hasta D1, para colocar ahí el titulo del reporte
        $objPHPExcel->setActiveSheetIndex(0)
            ->mergeCells('B2:X2')
            ->mergeCells('B3:X3')
            ->mergeCells('B4:X4')
            ->mergeCells('B5:X5');

        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('B2',$tituloReporte[0])// Titulo del reporte
            ->setCellValue('B3',$tituloReporte[1])
            ->setCellValue('B4',$tituloReporte[2])
            ->setCellValue('B5',$tituloReporte[3]);

        $sql2 = "SELECT * FROM semestre WHERE anio = YEAR(NOW()) ORDER BY nombre_sem";
        $res2 = $dbcon->query($sql2);

        $fila = 7;
        $dias_trabajados = 0;
        $dias_asistidos = 0;
        $obs_positivas = 0;
        $obs_negativas = 0;
        while ($datos2 = mysqli_fetch_array($res2)){ //Semestres

            if($datos2['nombre_sem'] == 'Primer Semestre'){
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A10',  $titulosColumnas[0])  //Titulo de las columnas primer semestre
                    ->setCellValue('B10',  $titulosColumnas[1])
                    ->setCellValue('C10',  $titulosColumnas[2])
                    ->setCellValue('D10',  $titulosColumnas[3])
                    ->setCellValue('E10',  $titulosColumnas[4])
                    ->setCellValue('F10',  $titulosColumnas[5])
                    ->setCellValue('G10',  $titulosColumnas[6])
                    ->setCellValue('H10',  $titulosColumnas[7])
                    ->setCellValue('I10',  $titulosColumnas[8])
                    ->setCellValue('J10',  $titulosColumnas[9])
                    ->setCellValue('K10',  $titulosColumnas[10])
                    ->setCellValue('L10',  $titulosColumnas[11]);

                $objPHPExcel->setActiveSheetIndex(0)->mergeCells('B7:L7')
                    ->setCellValue('B7',$datos2['nombre_sem']);

                $sql3 = "SELECT * FROM asignatura
                          INNER JOIN clase ON clase.id_asignatura = asignatura.id_asignatura
                          INNER JOIN curso ON curso.id_curso = clase.id_curso
                          INNER JOIN lista ON lista.id_curso = curso.id_curso
                          INNER JOIN alumno ON alumno.id_alumno = lista.id_alumno
                          WHERE alumno.id_alumno = $_GET[id] AND clase.anio = YEAR(NOW()) 
                          ORDER BY asignatura.nombre_asignatura";
                $res3 = $dbcon->query($sql3);

                $i = 11;
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

                            if ($k == 0) {
                                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$i, $notas[$k]);
                            }
                            if ($k == 1) {
                                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$i, $notas[$k]);
                            }
                            if ($k == 2) {
                                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$i, $notas[$k]);
                            }
                            if ($k == 3) {
                                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$i, $notas[$k]);
                            }
                            if ($k == 4) {
                                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$i, $notas[$k]);
                            }
                            if ($k == 5) {
                                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$i, $notas[$k]);
                            }
                            if ($k == 6) {
                                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.$i, $notas[$k]);
                            }
                            if ($k == 7) {
                                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.$i, $notas[$k]);
                            }
                            if ($k == 8) {
                                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.$i, $notas[$k]);
                            }
                            if ($k == 9) {
                                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('K'.$i, $notas[$k]);
                            }

                            $suma = $suma + $notas[$k];
                            $num_notas++;
                        }
                        else{
                            if ($k == 0) {
                                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$i, $notas[$k]);
                            }
                            if ($k == 1) {
                                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$i, $notas[$k]);
                            }
                            if ($k == 2) {
                                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$i, $notas[$k]);
                            }
                            if ($k == 3) {
                                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$i, $notas[$k]);
                            }
                            if ($k == 4) {
                                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$i, $notas[$k]);
                            }
                            if ($k == 5) {
                                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$i, $notas[$k]);
                            }
                            if ($k == 6) {
                                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.$i, $notas[$k]);
                            }
                            if ($k == 7) {
                                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.$i, $notas[$k]);
                            }
                            if ($k == 8) {
                                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.$i, $notas[$k]);
                            }
                            if ($k == 9) {
                                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('K'.$i, $notas[$k]);
                            }
                        }

                        if($num_notas==0)$num_notas=1;
                        $div = $suma / $num_notas;
                        $prom = number_format($div,1,".",",");
                        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('L'.$i, $prom);


                    }

                    $i++;
                }//while asignaturas semestre

                //promedio general primer semestre
                $objPHPExcel->setActiveSheetIndex(0)->mergeCells('J27:K27')->setCellValue('J27', 'Promedio General');
                $sql6 = "SELECT nota FROM nota 
                          INNER JOIN asignatura ON asignatura.id_asignatura = nota.id_asignatura
                          WHERE nota.id_alumno = $_GET[id] AND nota.id_semestre = $datos2[id_semestre] 
                          AND asignatura.promediable = 0";
                $res6 = $dbcon->query($sql6);
                $notas_sem = 0;
                $num_sem = 0;
                while($datos6 = mysqli_fetch_array($res6)){
                    $notas_sem = $notas_sem + $datos6['nota'];
                    $num_sem++;
                }

                if($num_sem == 0)$num_sem = 1;
                $div_sem = $notas_sem/$num_sem;
                $prom_sem = number_format($div_sem,1,".",",");
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('L27', $prom_sem);

                //Estilos delsemestre
                $objPHPExcel->getActiveSheet()->getStyle('A7:L7')->applyFromArray($estilo2);
                $objPHPExcel->getActiveSheet()->getStyle('A10:L10')->applyFromArray($estilo2);

                $i=$i-1;

                $objPHPExcel->getActiveSheet()->getStyle('A11:A'.$i)->applyFromArray($estilo1);
                $objPHPExcel->getActiveSheet()->getStyle('B11:L'.$i)->applyFromArray($estilo1);

                $objPHPExcel->getActiveSheet()->getStyle('J27:K27')->applyFromArray($estilo1);
                $objPHPExcel->getActiveSheet()->getStyle('L27')->applyFromArray($estilo1);


            }
            else{

                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('N10',  $titulosColumnas[0])  //Titulo de las columnas segundo semestre
                    ->setCellValue('O10',  $titulosColumnas[1])
                    ->setCellValue('P10',  $titulosColumnas[2])
                    ->setCellValue('Q10',  $titulosColumnas[3])
                    ->setCellValue('R10',  $titulosColumnas[4])
                    ->setCellValue('S10',  $titulosColumnas[5])
                    ->setCellValue('T10',  $titulosColumnas[6])
                    ->setCellValue('U10',  $titulosColumnas[7])
                    ->setCellValue('V10',  $titulosColumnas[8])
                    ->setCellValue('W10',  $titulosColumnas[9])
                    ->setCellValue('X10',  $titulosColumnas[10])
                    ->setCellValue('Y10',  $titulosColumnas[11]);

                $objPHPExcel->setActiveSheetIndex(0)->mergeCells('N7:Y7')
                    ->setCellValue('N7',$datos2['nombre_sem']);


                $sql3 = "SELECT * FROM asignatura
                          INNER JOIN clase ON clase.id_asignatura = asignatura.id_asignatura
                          INNER JOIN curso ON curso.id_curso = clase.id_curso
                          INNER JOIN lista ON lista.id_curso = curso.id_curso
                          INNER JOIN alumno ON alumno.id_alumno = lista.id_alumno
                          WHERE alumno.id_alumno = $_GET[id] AND clase.anio = YEAR(NOW()) 
                          ORDER BY asignatura.nombre_asignatura";
                $res3 = $dbcon->query($sql3);

                $i = 11;
                while ($datos3 = mysqli_fetch_array($res3)){

                    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('N'.$i,$datos3['nombre_asignatura']);


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
                            if ($k == 0) {
                                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('O'.$i, $notas[$k]);
                            }
                            if ($k == 1) {
                                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('P'.$i,$notas[$k]);
                            }
                            if ($k == 2) {
                                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('Q'.$i,$notas[$k]);
                            }
                            if ($k == 3) {
                                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('R'.$i,$notas[$k]);
                            }
                            if ($k == 4) {
                                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('S'.$i,$notas[$k]);
                            }
                            if ($k == 5) {
                                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('T'.$i,$notas[$k]);
                            }
                            if ($k == 6) {
                                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('U'.$i,$notas[$k]);
                            }
                            if ($k == 7) {
                                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('V'.$i,$notas[$k]);
                            }
                            if ($k == 8) {
                                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('W'.$i,$notas[$k]);
                            }
                            if ($k == 9) {
                                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('X'.$i,$notas[$k]);
                            }

                            $suma = $suma + $notas[$k];
                            $num_notas++;

                        }
                        else{
                            if ($k == 0) {
                                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('O'.$i, $notas[$k]);
                            }
                            if ($k == 1) {
                                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('P'.$i, $notas[$k]);
                            }
                            if ($k == 2) {
                                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('Q'.$i, $notas[$k]);
                            }
                            if ($k == 3) {
                                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('R'.$i, $notas[$k]);
                            }
                            if ($k == 4) {
                                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('S'.$i, $notas[$k]);
                            }
                            if ($k == 5) {
                                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('T'.$i, $notas[$k]);
                            }
                            if ($k == 6) {
                                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('U'.$i, $notas[$k]);
                            }
                            if ($k == 7) {
                                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('V'.$i, $notas[$k]);
                            }
                            if ($k == 8) {
                                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('W'.$i, $notas[$k]);
                            }
                            if ($k == 9) {
                                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('X'.$i, $notas[$k]);
                            }
                        }

                        if($num_notas==0)$num_notas=1;
                        $div = $suma / $num_notas;
                        $prom = number_format($div,1,".",",");
                        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('Y'.$i, $prom);


                    //Promedios anuales
                        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AA10','Anual');
                        $anio = Date("Y");
                        $fecha = $anio.'-01-01';
                        $sql12 = "SELECT * FROM nota
                                  WHERE id_alumno = $_GET[id] AND id_asignatura = $datos3[id_asignatura]
                                  AND fecha_nota > '$fecha'";
                        $res12 = $dbcon->query($sql12);
                        $total_notas = mysqli_num_rows($res12);
                        if($total_notas == 0)$total_notas = 1;

                        $suma_notas = 0;
                        while($datos12 = mysqli_fetch_array($res12)){
                            $suma_notas = $suma_notas + $datos12['nota'];
                        }
                        $prom_anual = $suma_notas/$total_notas;
                        $anual = number_format($prom_anual,1,".",",");
                        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AA'.$i,$anual);
                    //fin promedios anuales

                    }

                    $i++;
                }//while notas semestre


                //promedio general segundo semestre
                $objPHPExcel->setActiveSheetIndex(0)->mergeCells('V27:W27')->setCellValue('V27', 'Promedio General');
                $sql6 = "SELECT nota FROM nota 
                          INNER JOIN asignatura ON asignatura.promediable = nota.id_asignatura
                          WHERE id_alumno = $_GET[id] AND id_semestre = $datos2[id_semestre]
                          AND asignatura.promediable = 0";
                $res6 = $dbcon->query($sql6);
                $notas_sem = 0;
                $num_sem = 0;
                while($datos6 = mysqli_fetch_array($res6)){
                    $notas_sem = $notas_sem + $datos6['nota'];
                    $num_sem++;
                }

                if($num_sem == 0)$num_sem = 1;
                $div_sem = $notas_sem/$num_sem;
                $prom_sem = number_format($div_sem,1,".",",");
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue('X27',$prom_sem);


                $objPHPExcel->getActiveSheet()->getStyle('N7:Y7')->applyFromArray($estilo2);
                $objPHPExcel->getActiveSheet()->getStyle('N10:Y10')->applyFromArray($estilo2);

                $i=$i-1;

                $objPHPExcel->getActiveSheet()->getStyle('N11:N'.$i)->applyFromArray($estilo1);
                $objPHPExcel->getActiveSheet()->getStyle('O11:Y'.$i)->applyFromArray($estilo1);

                $objPHPExcel->getActiveSheet()->getStyle('AA10')->applyFromArray($estilo2);
                $objPHPExcel->getActiveSheet()->getStyle('AA11:AA'.$i)->applyFromArray($estilo1);

                $objPHPExcel->getActiveSheet()->getStyle('V27:W27')->applyFromArray($estilo1);
                $objPHPExcel->getActiveSheet()->getStyle('X27')->applyFromArray($estilo1);

                $objPHPExcel->getActiveSheet()->getStyle('AA27')->applyFromArray($estilo1);

            }//if asignaturas semestre

            //promedio anual
            $sql13 = "SELECT * FROM nota
                      INNER JOIN asignatura ON asignatura.id_asignatura = nota.id_asignatura
                      WHERE asignatura.promediable = 0 AND nota.fecha_nota > '$fecha'
                      AND nota.id_alumno = $_GET[id]";

            $res13 = $dbcon->query($sql13);
            $numero_total_notas = mysqli_num_rows($res13);
            if($numero_total_notas == 0) $numero_total_notas = 1;
            $suma_total_notas = 0;
            while($datos13 = mysqli_fetch_array($res13)){
                $suma_total_notas = $suma_total_notas + $datos13['nota'];
            }

            $div_anual = $suma_total_notas/$numero_total_notas;
            $prom_total_anual = number_format($div_anual,1,".",",");
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AA27',$prom_total_anual);
            //fin promedio anual

        //Asistencia
            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('B29:D29')->setCellValue('B29', 'N° dias trabajados');
            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('E29:G29')->setCellValue('E29', 'Asistencia');
            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('H29:J29')->setCellValue('H29', 'N° dias inasistencia');
            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('K29:M29')->setCellValue('K29', '% asistencia');

    //Estilos asistencias
            $objPHPExcel->getActiveSheet()->getStyle('B29:D29')->applyFromArray($estilo1);
            $objPHPExcel->getActiveSheet()->getStyle('E29:G29')->applyFromArray($estilo1);
            $objPHPExcel->getActiveSheet()->getStyle('H29:J29')->applyFromArray($estilo1);
            $objPHPExcel->getActiveSheet()->getStyle('K29:M29')->applyFromArray($estilo1);

            $objPHPExcel->getActiveSheet()->getStyle('B30:D30')->applyFromArray($estilo1);
            $objPHPExcel->getActiveSheet()->getStyle('E30:G30')->applyFromArray($estilo1);
            $objPHPExcel->getActiveSheet()->getStyle('H30:J30')->applyFromArray($estilo1);
            $objPHPExcel->getActiveSheet()->getStyle('K30:M30')->applyFromArray($estilo1);


            $sql7 = "SELECT DISTINCT fecha FROM asistencia 
                      WHERE asistencia.id_alumno = $_GET[id] AND asistencia.fecha >= '$datos2[inicio_semestre]' 
                      AND asistencia.fecha <= '$datos2[fin_semestre]'";

            $res7= $dbcon->query($sql7);
            while($datos7 = mysqli_fetch_array($res7)){
                $dias_trabajados++;
                $sql8 = "SELECT DISTINCT estado FROM asistencia WHERE id_alumno = $_GET[id] AND fecha = '$datos7[fecha]'";
                $res8 = $dbcon->query($sql8);
                while($datos8 = mysqli_fetch_array($res8)){
                    if($datos8['estado'] == 0){
                        $dias_asistidos++;
                    }
                }
            }

            $no_asistidos = $dias_trabajados-$dias_asistidos;
            $total_dias = $dias_trabajados;
            if($dias_trabajados == 0)$total_dias = 1;
            $porcentaje = ($dias_asistidos * 100)/$total_dias;


            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('B30:D30')->setCellValue('B30', $dias_trabajados);
            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('E30:G30')->setCellValue('E30', $dias_asistidos);
            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('H30:J30')->setCellValue('H30', $no_asistidos);
            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('K30:M30')->setCellValue('K30', $porcentaje.'%');
        //fin asistencia

        //observaciones
            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('B32:E32')->setCellValue('B32', 'Observaciones negativas');
            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('B33:E33')->setCellValue('B33', 'Observaciones positivas');
            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('B34:E34')->setCellValue('B34', 'Firma conocimiento');

        //estilos observaciones
            $objPHPExcel->getActiveSheet()->getStyle('B32:E32')->applyFromArray($estilo1);
            $objPHPExcel->getActiveSheet()->getStyle('B33:E33')->applyFromArray($estilo1);
            $objPHPExcel->getActiveSheet()->getStyle('B34:E34')->applyFromArray($estilo1);

            $objPHPExcel->getActiveSheet()->getStyle('F32')->applyFromArray($estilo1);
            $objPHPExcel->getActiveSheet()->getStyle('F33')->applyFromArray($estilo1);
            $objPHPExcel->getActiveSheet()->getStyle('F34')->applyFromArray($estilo1);


            $sql9 = "SELECT * FROM observacion
                      WHERE observacion.id_alumno = $_GET[id] AND observacion.fecha >= $datos2[inicio_semestre]
                      AND observacion.fecha <= $datos2[fin_semestre]";
            $res9 = $dbcon->query($sql9);
            while($datos9 = mysqli_fetch_array($res9)){
                if($datos9['tipo_obs'] == 0){
                    $obs_positivas++;
                }
                else{
                    $obs_negativas++;
                }
            }
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('f32', $obs_negativas);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue('f33', $obs_positivas);

            //fin observaciones

            //firmas
            $sql10 = "SELECT usuario.nombre_usr, usuario.apellido_p_usr, usuario.apellido_m_usr FROM usuario
                      INNER JOIN profesor ON profesor.rut_usr = usuario.rut_usr
                      INNER JOIN curso ON curso.id_profesor = profesor.id_profesor
                      INNER JOIN lista ON lista.id_curso = curso.id_curso
                      INNER JOIN alumno ON alumno.id_alumno = lista.id_alumno
                      WHERE alumno.id_alumno = $_GET[id]";
            $res10 = $dbcon->query($sql10);
            while($datos10 = mysqli_fetch_array($res10)){
                $objPHPExcel->setActiveSheetIndex(0)->mergeCells('B37:F37')->setCellValue('B37', $datos10['nombre_usr'].' '.$datos10['apellido_p_usr'].' '.$datos10['apellido_m_usr']);
            }
            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('B38:F38')->setCellValue('B38', 'Profesor(a) Jefe');
            $objPHPExcel->getActiveSheet()->getStyle('B38:F38')->applyFromArray($estilo3);

            $sql11 = "SELECT usuario.nombre_usr, usuario.apellido_p_usr, usuario.apellido_m_usr FROM director
                      INNER JOIN usuario ON usuario.rut_usr = director.rut_usr";
            $res11 = $dbcon->query($sql11);
            while($datos11 = mysqli_fetch_array($res11)){
                $objPHPExcel->setActiveSheetIndex(0)->mergeCells('I37:M37')->setCellValue('I37', $datos11['nombre_usr'].' '.$datos11['apellido_p_usr'].' '.$datos11['apellido_m_usr']);
            }
            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('I38:M38')->setCellValue('I38', 'Director');
            $objPHPExcel->getActiveSheet()->getStyle('I38:M38')->applyFromArray($estilo3);

            //fin firmas
        }// while semestres




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

        $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('P')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('R')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('S')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('T')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('U')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('V')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('W')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('X')->setAutoSize(true);

        $objPHPExcel->getActiveSheet()->getColumnDimension('Y')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('Z')->setAutoSize(true);

        $objPHPExcel->getActiveSheet()->getColumnDimension('AA')->setAutoSize(true);

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