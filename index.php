<?php
set_include_path("../public");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <link rel="stylesheet" href="./public/css/nav.css">
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

<script src="/js/jquery-3.7.1.min.js"></script>
</body>
</html>