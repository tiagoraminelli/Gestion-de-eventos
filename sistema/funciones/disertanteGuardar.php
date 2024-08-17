<?php

set_include_path("../../modelo"); //llamamos las carpetas
require 'Disertante.php'; //llamamos la clase
require_once 'Db.php';  //llamamos la clase
set_include_path("../../lib"); //llamamos las carpetas de librerias
require 'Sanitize.class.php';
require 'SanitizeCustom.php';


$disertante = new Disertante; //llamamos el disertante
//$id = $_REQUEST['id']; //capturamos el ID


//empezamos con la validacion
$id = (isset($_POST['id']))?SanitizeCustom::id($_POST['id']):false; //comprobamos q es numerico de 1 al 100000
$nombre = (isset($_POST['nombre']))?SanitizeCustom::Nombres($_POST['nombre'],1,255):false; //es string y no hace pregmatch con algun numero
$apellidos = (isset($_POST['apellidos']))?SanitizeCustom::Apellidos($_POST['apellidos'],2,255):false;//es string y no hace pregmatch con algun numero
$biografia = (isset($_POST['biografia']))?SanitizeCustom::Biografia($_POST['biografia'],10,255):false;//es string y no hace pregmatch con algun numero
$telefono = (isset($_POST['telefono']))?SanitizeCustom::Telefono($_POST['telefono'],12,12):false;
$url = (isset($_POST['url']))?SanitizeCustom::Url($_POST['url'],8,255):false;//es string y no hace pregmatch con algun numero
$email = (isset($_POST['email']))?SanitizeCustom::Email($_POST['email']):false;//es email y hace pregmatch si no encuentra el @
$twitter = (isset($_POST['twitter']))?SanitizeCustom::Redes($_POST['twitter'],8,255):false;//es string y no hace pregmatch con algun numero
$linkedin = (isset($_POST['linkedin']))?SanitizeCustom::Redes($_POST['linkedin'],8,255):false;//es string y no hace pregmatch con algun numero
//var_dump($_POST);
//a ver si estan bien
/* echo "Nombre: " . $nombre . "<br>";
echo "Apellidos: " . $apellidos . "<br>";
echo "Biografía: " . $biografia . "<br>";
echo "Teléfono: " . $telefono . "<br>";
echo "URL: " . $url . "<br>";
echo "Twitter: " . $twitter . "<br>";
echo "LinkedIn: " . $linkedin . "<br>"; */
//creamos el arreglo de parametros;
$param = [];
$arreglo_resultado = [];


//los datos q no nos importan aca
if($biografia){
    $param['biografia'] = $biografia;
    //echo $param['biografia'];
}
if($telefono){
    $param['telefono'] = $telefono;
    //echo $param['telefono'];
}
if($url){
    $param['url'] = $url;
    //echo $param['url'];
}
if($email){
    $param['email'] = $email;
    //echo $param['email'];
}
if($twitter){
    $param['twitter'] = $twitter;
    //echo $param['twitter'];
}
if($linkedin){
    $param['linkedin'] = $linkedin;
    //echo $param['linkedin'];
}


//los datos q nos importan aca
//echo $nombre." ".$apellidos; PRUEBA
//die;  //MI MEJOR AMIGO
if($nombre && $apellidos){
    $param['nombre'] = $nombre;
    $param['apellidos'] = $apellidos;
    //echo $param['nombre'];
    //echo $param['apellidos'];
    if ($id){
        $param['id'] = $id;
        $disertante->save($param);
        //$datos = $disertante ->save($param);
        //var_dump($datos);
        $arreglo_resultado['codigo'] = 10;
        $arreglo_resultado['mensaje'] = "se encontro el ID";
    }else{
        $disertante->save($param);
        //$datos = $disertante ->save($param);
        //var_dump($datos);
        $arreglo_resultado['codigo'] = 99;
        $arreglo_resultado['mensaje'] = "no encontro el ID";
    }

    /*
nota de numeros
10 = error
99 = no encontro el ID
12 = fue eliminado con exito
*/
   
}else{
    $arreglo_resultado['codigo'] = 10;
    $arreglo_resultado['mensaje'] = "faltan campos obligatorios";
}

echo json_encode($arreglo_resultado);
?>