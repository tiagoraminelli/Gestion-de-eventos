<?php
set_include_path("../../modelo"); //llamamos las carpetas
require 'Usuario.php'; //llamamos la clase


//var_dump($_POST['checked']); //comprabamos que llegan los elementos;

$disert = new Usuario(); //creamos el disertante que usaremos para llamar los metodos
$arregloResultado = [];//creamos el arreglo que contendra los mensajes en caso que se realize una accion

$arregloEliminador = explode("/",$_POST['inputIdUsuario']);
//var_dump($arregloEliminador);
if(isset($arregloEliminador)){ //si existe un POST
    if(!empty($arregloEliminador)){ //si el arreglo es DIFERENTE de vacio, prosigue
        foreach($arregloEliminador as $valor){ //se ejecuta el FOR
            echo "<br>"."DELETE FROM disertante WHERE `disertante`.`id` = $valor"."<br>"; //ERA PARA VER Q LLEGABAN
            $disert->deleteUsuariosById($valor); //se llama al metodo con el id
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
json_encode($arregloResultado);
echo json_encode($arregloResultado);  



 
?>
