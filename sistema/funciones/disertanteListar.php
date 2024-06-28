<?php
set_include_path("../../modelo/".PATH_SEPARATOR."../../lib/");
require 'DisertanteFilter.php'; 
require 'Sanitize.class.php';
require 'pagination.php';
//creamos al DisertanteFilter
$filter = new DisertanteFilter();

//declaramos las variables que vamos a usar
$contador = 0;
$numeral = 0;
$filtros = [];
// Llamar al método arregloFilter en la instancia de DisertanteFilter


//creamos las variables para paginar
//var_dump($_REQUEST)."<br>";
if (isset($_GET["page"])) {
    $paginaActual = $_GET['page'];
} else {
    $paginaActual = 1; // Valor por defecto si $_GET['pagina'] no está definido
}
if (isset($_GET['perpage'])) {
    $paginasRegistro = $_GET['perpage'];
} else {
    $paginasRegistro = 10; // Cantidad de registros a mostrar por página
}

$arregloCantidad = $filter->getCantidad(); 
$cantidadRegistros = $arregloCantidad['cantidad']; 
$offset = ($paginaActual) * $paginasRegistro;
// Obtener el total de registros desde la base de datos
$totalPaginas = ceil($cantidadRegistros/$paginasRegistro); //enteramos los resultados
// echo "total de registros por pagina: ".$paginasRegistro."<br>";
// echo "pagina actual: ".$paginaActual."<br>";
// echo "cantidad de registros: ".$cantidadRegistros."<br>";
// echo "total de paginas que se deben dividir la cantidad de registros: ".$totalPaginas."<br>"; 
// echo "el offset debe ser de: ".$offset."<br>";
$datosDisertantes= $filter->arregloFilter($paginasRegistro,$offset,$filtros); //['apellidos' => 'Ramos', 'nombre' => 'a']

//declaramos las variables afuera
//$id = (isset($_POST['id']))?SanitizeVars::INT($_POST['id']):false;
$nombre = (isset($_POST['nombre']))?SanitizeVars::STRING($_POST['nombre'],1,255):false; //es string y no hace pregmatch con algun numero
$apellidos = (isset($_POST['apellidos']))?SanitizeVars::STRING($_POST['apellidos'],2,255):false;//es string y no hace pregmatch con algun numero
$telefono = (isset($_POST['telefono']))?SanitizeVars::TELEFONO($_POST['telefono'],11,11):false;

// creamos las variables para la paginacion
$page = (isset($_POST['page']))?SanitizeVars::INT($_POST['page']):false;
$perpage = (isset($_POST['perpage']))?SanitizeVars::INT($_POST['perpage']):false;


//var_dump($_POST);
//die();
//echo $nombre;

//declaramos los arreglos asociativos
   /*  if($id){
    $filtros["id"] = $id;
    } */

    if($nombre){
        $filtros["nombre"] = $nombre;
    }
    if($apellidos){
        $filtros["apellidos"] = $apellidos;
    }
    if($telefono){
        $filtros["telefono"] = $telefono;
    }
   /*  if($url){
        $filtros['url'] = $url;
    }
    if($twitter){
        $filtros['twitter'] = $twitter;
    }
    if($linkedin){
        $filtros['linkedin'] = $linkedin;
    }
 */

   

      



?>

 <div class="hover:border-spacing-2 min-w-full divide-y divide-gray-200 mt-8">
    <tr><!-- los imputs -->
       
        <th>nombre</th><input class="mb-auto" name="inputFiltroNombre" id="inputFiltroNombre" label="nombre" value=<?=$nombre?>>
        <th>apellidos</th><input class="mb-auto" name="inputFiltroApellidos" id="inputFiltroApellidos" label="apellidos" value=<?=$apellidos?>>
        <th>telefono</th><input class="mb-auto" name="inputFiltroTelefono" id="inputFiltroTelefono" label="telefono" value=<?=$telefono?>>
       
 </tr>
 </div>
 





<!-- clases de la libreria de vale = table table-striped -->
<table class="hover:border-spacing-2 min-w-full divide-y divide-gray-200 mt-8" id="example">
    <tbody>
        <thead>
            <tr>
            <th class="mb-auto" name="numeral" id="numeral"># <i class="ri-account-circle-line"></i></th>
                <th><input type="checkbox" name= "inputIdAllDisertante" id="inputIdAllDisertante" ><i class="ri-reply-all-line"></i></th>
                <th>id <i class="ri-account-circle-line"></i></th>
                <th>nombre<i class="ri-account-box-line"></i></th>
                <th>apellidos<i class="ri-user-line"></i></th>
                <th>telefono<i class="ri-phone-line"></i></th>
                <th>url <i class="ri-links-line"></i></th>
                <th>twitter <i class="ri-links-line"></i></th>
                <th>linkedin <i class="ri-links-line"></i></th>
                <th>opciones <i class="ri-links-line"></i></th>   
            </tr>
        </thead>

        <?php //abrimos llave 
        if(empty($datosDisertantes)){ //en el caso que no existan elementos 
        ?> 
        <tr>
            <td>NO EXISTEN DATOS</td>
        </tr>
        <?php //abrimos llave 
        }
        ?> 

        <?php //abrimos llave 
        foreach ($datosDisertantes as $subArreglo) { //el FOREACH del arreglo de disertantes y cada sub arreglo dentro
        //var_dump($subArreglo) ;
        $contador++; //contador para limitar los elementos en pantalla
        ?> 

        <tr>
            <td><?=$numeral++;?></td>
            <td><input class="check" id="checkItem" name="inputIdDisertante[]" value="<?=$subArreglo['id']; //elemento del arreglo, el checked tiene [] pq es un arreglo?>" type="checkbox"></td>
            <td id="inputId" data-id="<?=$subArreglo['id'];?>" class = "" ><strong><?=$subArreglo['id']; //elemento del arreglo ?>
            </strong></td>
            <td data-nombre="<?=$subArreglo['nombre'];?>" class = "" ><?=$subArreglo['nombre']; //elemento del arreglo ?></td>
            <td data-apellidos="<?=$subArreglo['apellidos'];?>" class = "" ><?=$subArreglo['apellidos']; //elemento del arreglo ?></td>
            <td data-telefono="<?=$subArreglo['telefono'];?>" class = "" ><?=$subArreglo['telefono']; //elemento del arreglo ?></td>
            <td data-url="<?=$subArreglo['url'];?>" class = "" ><?=$subArreglo['url']; //elemento del arreglo ?></td>
            <td data-twitter="<?=$subArreglo['twitter'];?>" class = "" ><?=$x =  substr($subArreglo['twitter'],10); //elemento del arreglo ?></td>
            <td data-linkedin="<?=$subArreglo['linkedin'];?>" class = "" ><?=$l = substr($subArreglo['linkedin'],24); //elemento del arreglo ?></td>
            <td> 
		          <button class="btn-editar" value="<?=$subArreglo['id'];?>" type="hidden" name="inputIdDisertante" id="btneditar" data-id="<?=$subArreglo['id'];?>" onclick="disertanteEditar(<?=$subArreglo['id'];?>)" >editar<i class="ri-user-shared-line"></i></button>
		          <button name="inputIdDisertante"  value="<?=$subArreglo['id'];?>" id="btnborrar"  onclick="eliminarDisertante(<?=$subArreglo['id'];?>)">eliminar<i class="ri-user-unfollow-line"></i></i></button>
                  <button onclick="verFormulario(<?=$subArreglo['id'];?>)"> ver</button>
            </tr>



        <?php //abrimos llave 
        if($contador == $paginasRegistro){ //llave del break
        break; //termina
        }
        }
        ?> 
    </tbody>
</table>


<button class = "font-serif text-slate-500 hover:text-blue-600" id="enviar" onclick="aplicarFiltros()">enviar filtros <i class="ri-code-fill"></i></button>
<button class = "font-serif text-slate-500 hover:text-blue-600" id="eliminar" onclick="eliminarFiltros()">eliminar filtros  <i class="ri-code-s-slash-fill"></i></button>
<button class = "font-serif text-slate-500 hover:text-blue-600" type="button" onclick="disertantesEliminar()">Eliminar todos</button>


