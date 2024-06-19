<?php
// Verificar si se recibieron datos por POST
set_include_path("../../modelo/".PATH_SEPARATOR."../../lib/");
require 'Disertante.php';
require 'Sanitize.class.php';
$disert = new Disertante(); //creamos el disertante que usaremos para llamar los metodos
$arregloResultado = [];
$id = (isset($_POST['id']))?SanitizeVars::INT($_POST['id']):false; 
//var_dump($_POST);
 if($id){ 
        $datosDisertante = $disert->getDisertantesById($id);
        //var_dump($id,$datosDisertante); por las dudas para ver si lo enviaba
        $arregloResultado['mensaje'] = "se encontro el ID y fue invocado por la funcion";
        $arregloResultado['codigo'] = "10";    
        $arregloResultado['datos'] = $datosDisertante;    
 }else{
    $arregloResultado['mensaje'] = "no se encontro el ID";
    $arregloResultado['codigo'] = "99";
    $arregloResultado['datos'] = []; 
} 
json_encode($arregloResultado); 
echo json_encode($arregloResultado);  
?>


