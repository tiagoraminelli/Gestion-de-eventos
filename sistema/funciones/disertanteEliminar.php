<?php
set_include_path("../../modelo"); //llamamos las carpetas
require 'Disertante.php'; //llamamos la clase


//var_dump($_POST['checked']); //comprabamos que llegan los elementos;

$disert = new Disertante(); //creamos el disertante que usaremos para llamar los metodos
$arregloResultado = [];//creamos el arreglo que contendra los mensajes en caso que se realize una accion

$arregloEliminador = explode("/",$_POST['inputIdDisertante']);
//var_dump($arregloEliminador);
if(isset($arregloEliminador)){ //si existe un POST
    if(!empty($arregloEliminador)){ //si el arreglo es DIFERENTE de vacio, prosigue
        foreach($arregloEliminador as $valor){ //se ejecuta el FOR
            //echo "<br>"."DELETE FROM disertante WHERE `disertante`.`id` = $valor"."<br>"; //ERA PARA VER Q LLEGABAN
            $disert->deleteDisertanteById($valor); //se llama al metodo con el id
            $arregloResultado['codigo'] = 12; //se cargan los mensajes
            $arregloResultado['mensaje'] = "se ha ejecutado con Exito";//se cargan los mensajes
        }
    }else{ //SI ES VACIO
        $arregloResultado['codigo'] = 10; //se cargan los mensajes
        $arregloResultado['mensaje'] = "error"; //se cargan los mensajes
    } 
}
else{ //SINO existe el POST
    $arregloResultado['codigo'] =  99; //se cargan los mensajes
    $arregloResultado['mensaje'] = "no haz seleccionado nada"; //se cargan los mensajes
}



/* if($rest){ //rest es true
    $arregloResultado['codigo'] = 12;
    $arregloResultado['mensaje'] = "se ha ejecutado con Exito";
}else{ //rest es FALSE
    $arregloResultado['codigo'] = 10;
    $arregloResultado['mensaje'] = "error";
} */
json_encode($arregloResultado);
echo json_encode($arregloResultado);  
//declaramos las variables;
/* $id = $_POST['id'];
$rest = false;


//invocamos los disertantes para la funcion
$disert = new Disertante();
$disert->deleteDisertanteById($id);
//$arregloEliminado = $disert->deleteDisertanteById($id);
//var_dump($disert->deleteDisertanteById($id));


if(empty($id)){ //si es vacio el ID
    header("location:../menuDisertante.php");
}

if($disert){ //si existe el ID, ejecuta
    header("location:../menuDisertante.php");
    $rest = true; //definimos la variable rest, como true y activamos el otro codigo;
}else{
    header("location:../menuDisertante.php"); //a casa hacker
}

/*
nota de numeros
10 = error
99 = no encontro el ID
12 = fue eliminado con exito
*/


 
?>
