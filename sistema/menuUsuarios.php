<?php
set_include_path("../modelo");
require_once 'Db.php';
require 'persona.php';
require 'usuario.php';
require 'usuarioFilter.php';  
//creamos al UsuarioFilter y usuario
$p = new Persona();
$d = new Usuario();
$arreglosPersona = $d->getPersona();
//var_dump($arreglosPersona);
$arregloUsuarios = $d->getAllPersonasUsuarios();
$arreglo=array_merge($arreglosPersona,$arregloUsuarios);
var_dump($arreglo);
//declaramos las variables que vamos a usar
//var_dump($arregloUsuarios);


$contador = 0;
foreach ($arreglo as $subArreglo){
  $contador++;
  var_dump($subArreglo)."<br>";

  if($contador=1){
    break;
  }
}

/* 
echo $subArreglo["idPersona"];
echo $subArreglo["idUsuario"];
echo $subArreglo["nombre"];
echo $subArreglo["apellidos"];
echo $subArreglo["telefono"];
echo $subArreglo["email"];
echo $subArreglo["contraseña"];
echo $subArreglo["dni"];
echo $subArreglo["direccion"];
*/


$numeral = 0;
//var_dump($d);
// Definimos la cantidad de registros por página
$porPagina = 10;

// Obtener el número de página actual desde la URL
$paginaActual = isset($_GET['page']) ? (int)$_GET['page'] : 0;

// Calculamos el offset para la consulta según la página actual
$offset = ($paginaActual) * $porPagina;
// Llamamos al método para obtener los usuarios con paginación
$arreglo = $d->getUsuariosPaginacion($porPagina, $offset);
// Obtenemos el total de usuarios para calcular el número total de páginas
$aregloCantidad = $d->getCantidad();
$totalUsuarios = $aregloCantidad['cantidad']; 
$totalPaginas = ceil($totalUsuarios / $porPagina);

?>

<!-- nav -->
<nav class="bg-slate-50 font-serif " aria-label="breadcrumb">

  <ol class="breadcrumb">
    <li><a href="../index.php">index</a></li>
    <li><a href="./menuDisertante.php">menu de disertantes</a></li>
    <li><a target="_blank" href="http://localhost/phpmyadmin/index.php?route=/database/structure&server=1&db=eventos_db">base de datos</a></li>
    <li><a href="./menuUsuarios.php">menu de usuarios</a></li>
   

    <li class="breadcrumb-item active" aria-current="page">pagina actual</li>
  </ol>
</nav>
<!-- buscador -->
<div class="mb-4">
  <label for="searchInput">Buscar:</label>
  <input type="text" id="searchInput" >
</div>


<!-- clases de la libreria de vale = table table-striped -->
<table class="hover:border-spacing-2 min-w-full divide-y divide-gray-200 mt-8" id="example">
    <tbody>
        <thead>
            <tr>
            <th class="mb-auto" name="numeral" id="numeral"># <i class="ri-account-circle-line"></i></th>
                <th><input type="checkbox" name= "inputIdAllUsuarios" id="inputIdAllUsuarios" ><i class="ri-reply-all-line"></i></th>
                <th>id <i class="ri-account-circle-line"></i></th>
                <th>nombre<i class="ri-account-box-line"></i></th>
                <th>apellidos<i class="ri-user-line"></i></th>
                <th>dni <i class="ri-links-line"></i></th>
                <th>direccion <i class="ri-links-line"></i></th>
                <th>telefono<i class="ri-phone-line"></i></th>
                <th>email <i class="ri-links-line"></i></th>
                <th>password<i class="ri-links-line"></i></th>   
                <th>acciones<i class="ri-links-line"></i></th>   
            </tr>
        </thead>

        <?php //abrimos llave 
        if(empty($arreglo)){ //en el caso que no existan elementos 
        ?> 
        <tr>
            <td>NO EXISTEN DATOS</td>
        </tr>
        <?php //abrimos llave 
        }
        ?> 

        <?php //abrimos llave 
        foreach ($arreglo as $subArreglo) { //el FOREACH del arreglo de disertantes y cada sub arreglo dentro
        //var_dump($subArreglo) ;
        $contador++; //contador para limitar los elementos en pantalla
        ?> 
 <tr class="user-row">
            <td><?=$numeral++;?></td>
            <td><input class="check" id="checkItem" name="inputIdUsuarios[]" value="<?=$subArreglo['id']; //elemento del arreglo, el checked tiene [] pq es un arreglo?>" type="checkbox"></td>
            <td class="user-id" id="inputId" data-id="<?=$subArreglo['idUsuario'];?>" ><strong><?=$subArreglo['idUsuario']; //elemento del arreglo ?>
            </strong></td>
            <td class="user-nombre" data-nombre="<?=$subArreglo['nombre'];?>" ><?=$subArreglo['nombre']; //elemento del arreglo ?></td>
            <td class="user-nombre" data-nombre="<?=$subArreglo['apellidos'];?>" ><?=$subArreglo['apellidos']; //elemento del arreglo ?></td>
            <td class="user-url" data-dni="<?=$subArreglo['dni'];?>" ><?=$subArreglo['dni']; //elemento del arreglo ?></td>
            <td class="user-direccion" data-direccion="<?=$subArreglo['direccion'];?>" ><?=$subArreglo['direccion']; //elemento del arreglo ?></td>
            <td class="user-telefono" data-telefono="<?=$subArreglo['telefono'];?>"><?=$subArreglo['telefono']; //elemento del arreglo ?></td>
            <td class="user-email" data-email="<?=$subArreglo['email'];?>" ><?=$subArreglo['email']; //elemento del arreglo ?></td>
            <td class="user-password" data-password="<?=$subArreglo['password'];?>" ><?=$subArreglo['password']; //elemento del arreglo ?></td>

            
            <td>
                <button onclick="usuarioEliminar(<?=$subArreglo['id'];?>)">eliminar</button>
                <button >editar</button>
                <button >ver</button>  
            </tr>


</tr>



        <?php //abrimos llave 
        if($contador == 10){ //llave del break
        break; //termina
        }
        }
        ?> 
    </tbody>
</table>


<div id="mensaje">
    
</div>


<!-- Navegación de paginación -->
<div class="pagination">
  <ul class="pagination-list">
    <!-- Botón anterior -->
    <?php if ($paginaActual > 0): ?>
      <a class="pagination-link" href="?page=<?= ($paginaActual - 1) ?>">Anterior</a>
    <?php endif; ?>

    <!-- Enlaces de páginas -->
    <?php
    // Calculamos el rango de páginas a mostrar (3 a la izquierda y 3 a la derecha de la página actual)
    $start = max(0, $paginaActual - 2);
    $end = min($totalPaginas - 1, $paginaActual + 2);

    // Ajustamos el inicio y fin para siempre mostrar 3 páginas
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

<!-- /Navegación de paginación -->

 <!-- Agrega esto en tu sección head o antes del cierre del body -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
//funciona al ras de las 10 primeras muestras
$(document).ready(function() {
  $('#searchInput').on('input', function() {
    var searchText = $(this).val().toLowerCase();
    $('.user-row').each(function() {
      var id = $(this).find('.user-id').text().toLowerCase();
      var nombre = $(this).find('.user-nombre').text().toLowerCase();
      var apellidos = $(this).find('.user-apellidos').text().toLowerCase();
      var dni = $(this).find('.user-dni').text().toLowerCase();
      var direccion = $(this).find('.user-direccion').text().toLowerCase();
      var telefono = $(this).find('.user-telefono').text().toLowerCase();
      var email = $(this).find('.user-email').text().toLowerCase();
      var password = $(this).find('.user-password').text().toLowerCase();
      
      if (id.includes(searchText) || nombre.includes(searchText) || apellidos.includes(searchText) ||
          dni.includes(searchText) || direccion.includes(searchText) || telefono.includes(searchText) ||
          email.includes(searchText) || password.includes(searchText)) {
        $(this).show();
      } else {
        $(this).hide();
      }
    });
  });
});

function usuarioEliminar(id){
    // Crear objeto con el ID del disertante a eliminar
    let parametros = { "inputIdUsuario": id };

    if (confirm("¿Estás seguro de eliminar este usuario?")) {
        $.post('./funciones/usuarioEliminar.php', parametros, function(funcion) {
            $('#mensaje').html('<div class="alert alert-success" role="alert">¡Usuario eliminado exitosamente!</div>'); 
           cargarContenido(); 
        }, "json");
    } else {
        $('#mensaje').html('<div class="alert alert-danger" role="alert">Se ha cancelado la operación</div>');
    }
}

</script>