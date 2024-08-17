<?php
set_include_path("../modelo/");
require 'EventoUsuario.php';
//require 'Usuario.php';

$eventUser = new EventoUsuario;
$ide = 1;
$datos = $eventUser->getDatosUsuariosInscriptosEventos($ide);
$numeral=1;
$contador=0;
?>

<!-- nav -->
<nav aria-label="breadcrumb">
<ol class="breadcrumb">
  <li><a href="../index.php">index</a></li>
  <li><a href="./menuDisertante.php">menu de disertantes</a></li>
  <li><a target="_blank" href="http://localhost/phpmyadmin/index.php?route=/database/structure&server=1&db=eventos_db">base de datos</a></li>
  <li><a href="./menuUsuarios.php">menu de usuarios</a></li>
  <li><a href="./listadoEventos.php">Listado de eventos </a></li>
  <li><a href="./listadoEventoUsuarios.php">Listado de inscriptos </a></li>

  <li class="breadcrumb-item active" aria-current="page">pagina actual</li>
</ol>
</nav>

<?php 
//print_r($datos) ;
/*     if($contador == 10){ //llave del break
        break; //termina
        } */
?>

<table class="" id="">
    <tbody>
        <thead>
            <tr>
            <th name="numeral" id="numeral">N°</i></th>
                <th>dni <i class="ri-links-line"></i></th>
                <th>nombre<i class="ri-account-box-line"></i></th>
                <th>telefono<i class="ri-phone-line"></i></th>
                <th>email <i class="ri-links-line"></i></th>
             
            </tr>
        </thead>

        <?php //abrimos llave 
        if(empty($datos)){ //en el caso que no existan elementos 
        ?> 
        <tr>
            <td>NO EXISTEN DATOS</td>
        </tr>
        <?php //abrimos llave 
        }
        ?> 

        <?php //abrimos llave 
        foreach ($datos as $subArreglo) { //el FOREACH del arreglo de disertantes y cada sub arreglo dentro
        //var_dump($subArreglo) ;
        $contador++; //contador para limitar los elementos en pantalla
     
        ?>  
 <tr class="user-row">
            <td><?=$numeral++;?></td>
            <td><?=$subArreglo['dni']; //elemento del arreglo ?></td>
            <td><?=$subArreglo['nombre']." ".$subArreglo['apellidos']; //elemento del arreglo ?></td>
            <td><?=$subArreglo['telefono']; //elemento del arreglo ?></td>
            <td><?=$subArreglo['email']; //elemento del arreglo ?></td>
            
</tr>
        <?php //abrimos llave 

        }

        ?> 
    </tbody>
</table>

