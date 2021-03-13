<?php

    require 'Classes/PHPExel.php';
    require 'conexion.php';

    $sql = "SELECT id, direccion, ciudad, telefono, codigo_postal, tipo, precio FROM ciudad"
    $resultado = $mysqli->query($sql);

    //una variable que nos indique desde donde va empezar a escribir el exel 
    $fila = 2;

    $objPHPExel = new PHPExel();
    $objPHPExel->getProperties()->setCreator("Reportes exel")->setDescription("Reporte general");


    $objPHPExel->setActiveSheetIndex(0);
    $objPHPExel->getActiveSheet()->setTitle("Productos");


    $objPHPExel->getActiveSheet()->setCellValue('A1', 'ID');
    $objPHPExel->getActiveSheet()->setCellValue('B1', 'DIRECCION');
    $objPHPExel->getActiveSheet()->setCellValue('C1', 'CIUDAD');
    $objPHPExel->getActiveSheet()->setCellValue('D1', 'TELEFONO');
    $objPHPExel->getActiveSheet()->setCellValue('E1', 'CODIGOPOSTAL');
    $objPHPExel->getActiveSheet()->setCellValue('F1', 'TIPO');
    $objPHPExel->getActiveSheet()->setCellValue('G1', 'PRECIO');

    while($row = $resultado->fetch_assoc())
    {
        $objPHPExel->getActiveSheet()->setCellValue('A'.$fila, $row['id']);
        $objPHPExel->getActiveSheet()->setCellValue('B'.$fila, $row['direccion']);
        $objPHPExel->getActiveSheet()->setCellValue('C'.$fila, $row['ciudad']);
        $objPHPExel->getActiveSheet()->setCellValue('D'.$fila, $row['telefono']);
        $objPHPExel->getActiveSheet()->setCellValue('E'.$fila, $row['codigo_postal']);
        $objPHPExel->getActiveSheet()->setCellValue('F'.$fila, $row['tipo']);
        $objPHPExel->getActiveSheet()->setCellValue('G'.$fila, $row['precio']);

        $objPHPExel->getActiveSheet()->setCellValue('E'.$fila, '=C'.$fila.'*D'.$fila);
       
        $fila++;

    }

    header("Content-Type:
    application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
    header('Content-Disposition: attachment;filename="Productos.xlsx"');
    header('Cache-Control: max-age=0');

    $objWriter = new PHPExel_Writer_Exel2007($objPHPExel);
    $objPHPExel->save('php://output');



    


?>