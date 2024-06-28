<?php
set_include_path("../modelo/");
require 'EventoFilter.php'; 
//creamos al DisertanteFilter
$evento = new EventoFilter();
$eventosListados = $evento->getEventosFilter();
$prueba = $evento->getDatosDisertanteByEventos();
//variables:


$contador = 0;
$numeral = 1;
foreach ($prueba as $disertante){
echo$disertante['nombre'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado Eventos</title>
</head>
<body>
    <!-- nav -->
<nav class="bg-slate-50 font-serif " aria-label="breadcrumb">

<ol class="breadcrumb">
  <li class="breadcrumb-item text-slate-500 hover:text-blue-600"><a href="../index.php">index</a></li>
  <li class="breadcrumb-item text-slate-500 hover:text-blue-600"><a href="./menuDisertante.php">menu de disertantes</a></li>
  <li class="breadcrumb-item text-slate-500 hover:text-blue-600"><a target="_blank" href="http://localhost/phpmyadmin/index.php?route=/database/structure&server=1&db=eventos_db">base de datos</a></li>
  <li class="breadcrumb-item text-slate-500 hover:text-blue-600"><a href="./menuUsuarios.php">menu de usuarios</a></li>
  <li class="breadcrumb-item text-slate-500 hover:text-blue-600"><a href="./listadoEventos.php">Listado de eventos </a></li>
  <li class="breadcrumb-item text-slate-500 hover:text-blue-600"><a href="./listadoEventoUsuarios.php">Listado de inscriptos </a></li>

  <li class="breadcrumb-item active" aria-current="page">pagina actual</li>
</ol>
</nav>
<!-- nav -->
 <h2>Eventos</h2>

<table class="hover:border-spacing-2 min-w-full divide-y divide-gray-200 mt-8" id="example">
    <thead>
        <tr>
            <th class="mb-auto"># <i class="ri-account-circle-line"></i></th>
            <th><input type="checkbox" name="inputIdAllUsuarios" id="inputIdAllUsuarios"><i class="ri-reply-all-line"></i></th>
            <th>Fecha <i class="ri-links-line"></i></th>
            <th>/Hora <i class="ri-links-line"></i></th>
            <th>Id <i class="ri-account-circle-line"></i></th> 
            <th>Título <i class="ri-account-box-line"></i></th>
            <!-- <th>Descripción <i class="ri-user-line"></i></th> -->
           
            <th>Duración <i class="ri-phone-line"></i></th>
            <th>Idioma <i class="ri-links-line"></i></th>
            <th>Disertante <i class="ri-links-line"></i></th>
            <th>Acciones <i class="ri-links-line"></i></th>
        </tr>
    </thead>
    <tbody>
        <?php
        if(empty($eventosListados)){
        ?> 
        <tr>
            <td colspan="11">NO EXISTEN DATOS</td>
        </tr>
        <?php
        } else {
            foreach ($eventosListados as $eventos) {
                $contador++;
        ?> 
        <tr class="user-row">
            <td><?=$numeral++?></td>
            <td><input class="check" id="checkItem" name="inputIdEventos[]" value="<?=$eventos['id']?>" type="checkbox"></td>
            <td class="user-fecha"><?=$eventos['fecha']?></td>
            <td class="user-hora"><?=$hora=substr($eventos['hora'],0,5)?></td>
            <td class="user-id"><?=$eventos['id']?></td> 
            <td class="user-titulo"><?=$eventos['titulo']?></td>
            <!-- <td class="user-descripcion"><?=$eventos['descripcion']?></td> -->
           
            <td class="user-duracion"><?=$eventos['duracion']?></td>
            <td class="user-idioma"><?=$eventos['idioma']?></td>
            <td class="user-disertante-evento-id"><?=$eventos['disertante_id']?></td>
            <td>
                <button onclick="eventoEliminar(<?=$eventos['id']?>)">eliminar</button>
                <button>editar</button>
                <button onclick="verInscriptos(<?=$eventos['id']?>)">ver</button>  
            </td>
        </tr>
        <?php
                if($contador == 10) {
                    break;
                }
            }
        }
        ?>
    </tbody>
</table>


</body>
</html>