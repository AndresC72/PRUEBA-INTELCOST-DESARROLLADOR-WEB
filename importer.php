<?php

    // declaramos nuestra variable para nuestro .json donde se encuentra toda la informacion

    $json = file_get_contents('data-1.json');

    //print_r($json);

    // decodificamos la variable y la convertimos en un arreglo 
    $data= json_decode($json, true);

    //print_r($data);

    //creamos la rutina donde comienza a correr y su funcion 
    //es de leer la cantidad de registros que se encuentran en el .json

    foreach($data as $row) {

       // print_r($row);

        $id = $row ['Id'];
        $direccion = $row ['Direccion'];
        $ciudad = $row ['Ciudad'];
        $telefono = $row ['Telefono'];
        $codigo_postal = $row ['Codigo_Postal'];
        $tipo = $row ['Tipo'];
        $precio = $row ['Precio'];


        //echo($id .'<br/>');

        //creamos dicha funcion de manera dinamica jalando la informacion del archivo .json

        $sql = "INSERT INTO `ciudad`(`id`, `direccion`, `ciudad`, `telefono`, `codigo_postal`, `tipo`, `precio`) VALUES ('$id','$direccion','$ciudad','$telefono','$codigo_postal','$tipo','$precio');";


        //mysqli_query($sql);

        //dicha funcion que imprime mi sentencia me permite imprimir el resultado del .json en .sql y no tener que ingresar registro por registro
        echo($sql);
          
    
    }

    





     /**
  * @author Andres Cristancho
  */


 /**#@-*/
    
?>






