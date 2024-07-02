<?php
set_include_path("../modelo/");
require 'EventoFilter.php'; 
//creamos al DisertanteFilter
$evento = new EventoFilter();
$eventosListados = $evento->getEventosFilter();

//variables:

$contador = 0;
$numeral = 1;


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
  <li><a href="../index.php">index</a></li>
  <li><a href="./menuDisertante.php">menu de disertantes</a></li>
  <li><a target="_blank" href="http://localhost/phpmyadmin/index.php?route=/database/structure&server=1&db=eventos_db">base de datos</a></li>
  <li><a href="./menuUsuarios.php">menu de usuarios</a></li>
  <li><a href="./listadoEventos.php">Listado de eventos </a></li>
  <li><a href="./listadoEventoUsuarios.php">Listado de inscriptos </a></li>

  <li class="breadcrumb-item active" aria-current="page">pagina actual</li>
</ol>
</nav>
<!-- nav -->
 <h2>Eventos</h2>

<table id="example">
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
        <tr class="">
            <td><?=$numeral++?></td>
            <td><input class="check" id="checkItem" name="inputIdEventos[]" value="<?=$eventos['id']?>" type="checkbox"></td>
            <td class="user-fecha"><?=$eventos['fecha']?></td>
            <td class="user-hora"><?=$hora=substr($eventos['hora'],0,5)?></td>
            <td class="user-id"><?=$eventos['id']?></td> 
            <td class="user-titulo"><?=$eventos['titulo']?></td>
            <!-- <td class="user-descripcion"><?=$eventos['descripcion']?></td> -->
           
            <td class="user-duracion"><?=$eventos['duracion']?></td>
            <td class="user-idioma"><?=$eventos['idioma']?></td>
            <td class="user-disertante-evento-id"><?=$eventos['nombre']?></td>
            <td>
                <button onclick="eventoEliminar(<?=$eventos['id']?>)">eliminar</button>
                <button onclick="eventoEditar(<?=$eventos['id']?>)">editar</button>
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
<script>
    function eventoEliminar(){
        // Crear objeto con el ID del disertante a eliminar
    let parametros = { "inputIdEvento": id };

if (confirm("¿Estás seguro de eliminar este evento?")) {
    $.post('./funciones/eventoEliminar.php', parametros, function(funcion) {
        $('#mensaje').html('<div class="alert alert-success" role="alert">evento eliminado exitosamente!</div>'); 
       
    }, "json");
} else {
    $('#mensaje').html('<div class="alert alert-danger" role="alert">Se ha cancelado la operación</div>');
}
    }
</script>
</html>

