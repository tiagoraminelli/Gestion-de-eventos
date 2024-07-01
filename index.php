<?php

set_include_path("./modelo/");
require 'Evento.php'; 
//creamos al DisertanteFilter
$evento = new Evento();
$eventosListados = $evento->getEventos();

//variables:
$contador=0;
// Definimos la cantidad de registros por página
$porPagina = 3;

// Obtener el número de página actual desde la URL
$paginaActual = isset($_GET['page']) ? (int)$_GET['page'] : 0;

// Calculamos el offset para la consulta según la página actual
$offset = ($paginaActual) * $porPagina;
// Llamamos al método para obtener los usuarios con paginación
$eventosListados = $evento->getPaginasPorEventos($porPagina, $offset);
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

    <title>index</title>
</head>
<body>
<nav class="bg-slate-50 font-serif " aria-label="breadcrumb">

  <ol class="breadcrumb">
    <li class="breadcrumb-item text-slate-500 hover:text-blue-600"><a href="./index.php">index</a></li>
    <li class="breadcrumb-item text-slate-500 hover:text-blue-600"><a href="./sistema/menuDisertante.php">menu de disertantes</a></li>
    <li class="breadcrumb-item text-slate-500 hover:text-blue-600"><a target="_blank" href="http://localhost/phpmyadmin/index.php?route=/database/structure&server=1&db=eventos_db">base de datos</a></li>
    <li class="breadcrumb-item text-slate-500 hover:text-blue-600"><a href="./sistema/menuUsuarios.php">menu de usuarios</a></li>
    <li class="breadcrumb-item text-slate-500 hover:text-blue-600"><a href="./sistema/listadoeventos.php">Listado Eventos</a></li>

    <li class="breadcrumb-item active" aria-current="page">pagina actual</li>
  </ol>
</nav>


    <nav class="navbar">
    <div class="logo">
      <a href="#">Gestion de Eventos</a>
    </div>
    <ul>
      <li><a href="#">Inicio</a></li>
      <li><a href="#">Eventos</a></li>
      <li><a href="#">Disertantes</a></li>
      <li><a href="#">Patrocinadores</a></li>
      <li><a href="#">Consulta</a></li>
      <li><a href="#">Regístrate</a></li>
    </ul>
  </nav>
<section class="side-section">
  <h1>¿Falta algún evento?</h1>
  <p>Accede a la sección <a href="http://" target="_blank" rel="noopener noreferrer">Call for papers y envíanos tu pregunta</a></p>
  <button>REGISTRATE</button>
  <p>¿Ya estás registrado? <a href="http://" target="_blank" rel="noopener noreferrer">Acceder</a></p>
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

<section class="left-section">
  <h1>Eventos</h1>

  <?php 
  foreach($eventosListados as $eventos) {
    $contador++;
    $hora = $eventos['hora'];

    // Convertir el string a un objeto DateTime
    $fecha = DateTime::createFromFormat('H:i:s', $hora);

    // Verificar si la conversión fue exitosa
    if ($fecha === false) {
        echo "Error al convertir la hora.\n";
    } else {
        $duracionHoras = $eventos['duracion'];

        // Crear un objeto DateInterval para sumar la duración en horas
        $intervalo = new DateInterval('PT' . $duracionHoras . 'H');
        
        // Sumar el intervalo al objeto DateTime
        $fecha->add($intervalo);

        // Obtener la nueva hora formateada
        $nuevaHora = $fecha->format('H:i:s');
        $horarios = substr($hora, 0, 5) . " - " . substr($nuevaHora, 0, 5) . "<br>";
    }

    echo "<h3>" . "<br>" . $eventos['titulo'] . "</h3>";
    echo "<p>" . "<br>" . $eventos['descripcion'] . "</p>";

    if ($contador == 3) {
      break;
    }
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



<script src="/js/jquery-3.7.1.min.js"></script>
</body>
</html>