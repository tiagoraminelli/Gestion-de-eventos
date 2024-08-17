<?php

set_include_path("./modelo/");
require 'EventoFilter.php'; 
//creamos al DisertanteFilter
$evento = new EventoFilter();
$eventosListados = $evento->getEventosFilter();
//var_dump($eventosListados);

//variables:
$contador=0;
// Definimos la cantidad de registros por página
$porPagina = 3;

// Obtener el número de página actual desde la URL
$paginaActual = isset($_GET['page']) ? (int)$_GET['page'] : 0;
// Calculamos el offset para la consulta según la página actual
$offset = ($paginaActual) * $porPagina;
// Llamamos al método para obtener los usuarios con paginación
//$eventosListados = $evento->getPaginasPorEventos($porPagina, $offset);
// Obtenemos el total de usuarios para calcular el número total de páginas
$aregloCantidad = $evento->getCantidadEventos();
$totalEventos = $aregloCantidad['cantidad']; 
$totalPaginas = ceil($totalEventos / $porPagina);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <link rel="stylesheet" href="./public/css/nav.css">
    <link rel="stylesheet" href="./public/css/eventos.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css" rel="stylesheet">

    <title>index</title>
</head>
<body>
<nav class="bg-slate-50 font-serif " aria-label="breadcrumb">

  <ol class="breadcrumb">
    <li class="--"><a href="./index.php">index</a></li>
    <li class="--"><a href="./sistema/menuDisertante.php">menu de disertantes</a></li>

    <li class="--"><a target="_blank" href="http://localhost/phpmyadmin/index.php?route=/database/structure&server=1&db=eventos_db">base de datos</a></li>
    <li class="--"><a href="./sistema/menuUsuarios.php">menu de usuarios</a></li>
    <li class="--"><a href="./sistema/listadoeventos.php">Listado Eventos</a></li>

    <li class="breadcrumb-item active" aria-current="page">pagina actual</li>
  </ol>
</nav>


    <nav class="navbar">
    <div class="logo">
      <a href="./index.php">Gestion de Eventos</a>
    </div>
    <ul>
      <li><a href="./index.php">Inicio</a></li>
      <li><a href="#">Eventos</a></li>
      <li><a href="./disertante.php">Disertantes</a></li>
      <li><a href="#">Patrocinadores</a></li>
      <li><a href="#">Consulta</a></li>
      <li><a href="#">Regístrate</a></li>
    </ul>
  </nav>
<section class="side-section" id="side-section">
 

  <button onclick="window.location.href='./sistema/html/formulario.html';">REGISTRATE</button>
  <p>¿Ya estás registrado? <a href="./sistema/html/ingreso.html" target="_blank" rel="noopener noreferrer">Acceder</a></p>
  <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Mollitia ad modi quibusdam! Vel ducimus nemo, aliquam tenetur quaerat necessitatibus quae. Pariatur, libero nulla ex ad mollitia harum id voluptates doloribus.</p>
  <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Laboriosam exercitationem ab eveniet facere cupiditate magnam illum recusandae voluptatum non voluptatem. In labore inventore, numquam veniam quod non repudiandae voluptas eum!</p>
  <h2>Ventajas de asistir</h2>
  <ul>
    <li>Lorem ipsum dolor sit amet consectetur adipisicing elit.</li>
    <li>Lorem ipsum dolor sit amet consectetur adipisicing elit.</li>
    <li>Lorem ipsum dolor sit amet consectetur adipisicing elit.</li>
    <li>Lorem ipsum dolor sit amet consectetur adipisicing elit.</li>
    <li>Lorem ipsum dolor sit amet consectetur adipisicing elit.</li>
  </ul>
</section>

<!-- Contenedor oculto para detalles del evento -->
<div id="evento-detalles" style="display: none;">
  <!-- Aquí se mostrarán los detalles del evento -->

  <div id="detalle-evento"></div>
  <button  id="cerrar-detalle">Cerrar Detalle</button>
</div>


<section class="left-section" id="left-section">
  <h1>Disertantes</h1>

  <?php 
  foreach($eventosListados as $eventos) {
    $contador++;
   
    echo "<br>".$eventos['nombre'];
    echo "<br>".$eventos['descripcion'];
    echo "<br>"."Imparte los siguientes eventos:";
    echo "<h4><a href=\"#\" class=\"evento-link\" data-id=\"" . $eventos['id'] . "\">" . $eventos['titulo'] . "</a></h4>";
    echo '<a href="' . $eventos['twitter'] . '" target="_blank"><img src=""><i class="ri-twitter-line"></i> Twitter</a><br>';
    echo '<a href="' . $eventos['linkedin'] . '" target="_blank"><img src=""><i class="ri-linkedin-line"></i> LinkedIn</a><br>';
    // if ($contador == 3) {
    //   break;
    // }
  }
  ?>

  <!-- Navegación de paginación -->
  <div class="pagination">
    <ul class="pagination-list">
      <!-- Botón anterior -->
      <?php if ($paginaActual > 0): ?>
        <a class="pagination-link" href="?page=<?= ($paginaActual - 1) ?>">Anterior</a>
      <?php endif; ?>

      <!-- Enlaces de páginas -->
      <?php
      $start = max(0, $paginaActual - 2);
      $end = min($totalPaginas - 1, $paginaActual + 2);

      if ($end - $start < 2) {
        $start = max(0, $end - 2);
      }
      
      for ($i = $start; $i <= $end; $i++): ?>
        <a class="pagination-link <?= ($paginaActual == $i) ? 'is-current' : '' ?>" href="?page=<?= $i ?>"><?= ($i + 1) ?></a>
      <?php endfor; ?>

      <!-- Botón siguiente -->
      <?php if ($paginaActual < $totalPaginas - 1): ?>
        <a class="pagination-link" href="?page=<?= ($paginaActual + 1) ?>">Siguiente</a>
      <?php endif; ?>
    </ul>
  </div>
</section>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</body>
</html>
<script>

  //<------------------separador de funciones----------------->

  
</script>


