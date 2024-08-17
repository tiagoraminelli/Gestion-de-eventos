    <?php
    set_include_path("../modelo");
    require_once 'Db.php';
    require 'persona.php';

    //creamos al UsuarioFilter y usuario
    //$d = new Usuario();
    $p = new persona();
    $arregloPersona = $p->getPersona();
    //declaramos las variables que vamos a usar
    //var_dump($$arregloPersona);
    $contador = 0;
    $numeral = 1;

    // Definimos la cantidad de registros por página
    $porPagina = 10;
    $paginaActual = isset($_GET['page']) ? (int)$_GET['page'] : 0;
    $offset = ($paginaActual) * $porPagina;
    $arregloPersona = $p->getUsuariosPaginacion($porPagina, $offset);
    $aregloCantidad = $p->getCantidad();
    $totalPersona = $aregloCantidad['cantidad']; 
    $totalPaginas = ceil($totalPersona / $porPagina);
    ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Personas</title>
    <link rel="stylesheet" href="../public/css/persona.css"> <!-- Enlace al archivo CSS -->
    
</head>
    <!-- nav -->
    <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
    <li><a target="_blank" href="../index.php">index</a></li>
    <li><a target="_blank" href="./menuDisertante.php">menu de disertantes</a></li>
    <li><a target="_blank" href="http://localhost/phpmyadmin/index.php?route=/database/structure&server=1&db=eventos_db">base de datos</a></li>
    <li><a target="_blank" href="./menuUsuarios.php">menu de usuarios</a></li>
    <li><a target="_blank" href="./listadoEventos.php">Listado de eventos </a></li>
    <li><a target="_blank" href="./listadoEventoUsuarios.php">Listado de inscriptos </a></li>
    <li><a target="_blank" href="./listadoPersonas.php">Listado de Persona </a></li>

    <li class="breadcrumb-item active" aria-current="page">pagina actual</li>
    </ol>
    </nav>

    <table class="" id="">
        <tbody>
            <thead>
                <tr>
                <th name="numeral" id="numeral">N°</i></th>
                    <th>id <i class="ri-links-line"></i></th>
                    <th>nombre<i class="ri-account-box-line"></i></th>
                    <th>telefono<i class="ri-phone-line"></i></th>
                    <th>email <i class="ri-links-line"></i></th>
                    <th>acciones <i class="ri-links-line"></i></th>
                
                </tr>
            </thead>

            <?php //abrimos llave 
            if(empty($arregloPersona)){ //en el caso que no existan elementos 
            ?> 
            <tr>
                <td>NO EXISTEN DATOS</td>
            </tr>
            <?php //abrimos llave 
            }
            ?> 

            <?php //abrimos llave 
            foreach ($arregloPersona as $datos) { //el FOREACH del arreglo de disertantes y cada sub arreglo dentro
            //var_dump($subArreglo) ;
            $contador++; //contador para limitar los elementos en pantalla
        
            ?>  
            <tr class="user-row"> 
                <td><?=$numeral++;?></td>
                <td><?=$datos['idPersona']; //elemento del arreglo ?></td>
                <td><?=$datos['nombre']." ".$datos['apellidos']; //elemento del arreglo ?></td>
                <td><?=$datos['telefono']; //elemento del arreglo ?></td>
                <td><?=$datos['email']; //elemento del arreglo ?></td>
                <td class="botones-container">
                  <button class="btn editar">Editar</button>
                  <button class="btn borrar" onclick="eliminarPersona(<?=$datos['id'];?>)">Borrar</button>
                  <button class="btn ver">Ver</button>
                </td> 
                
            </tr>
            <?php //abrimos llave 

        if($contador == 10){ //llave del break
        break; //termina
        }
        }//fin foreach
            ?> 
    </tbody>
    <table>
    <button id="btnExportarCSV" class="btn exportar-csv">Exportar a CSV</button>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

$('#btnExportarCSV').click(function(){
    $.post('../export/exportPersona.php', function(data) {
        // Procesar la respuesta JSON
        let mensaje = JSON.parse(data);
        if (mensaje.tipo === 'exito') {
            // Mostrar un mensaje de alerta
            alert(mensaje.texto);
        } else {
            // Manejar otros tipos de respuesta si es necesario
            alert('Hubo un problema al exportar las persona.');
        }
    });
});

function eliminarPersona(id) {
    // Crear objeto con el ID del disertante a eliminar
    let parametros = { "inputIdPersona": id };

    if (confirm("¿Estás seguro de eliminar esta persona?")) {
        $.post('./funciones/eliminarPersona.php', parametros, function(arregloResultado) {
            $('#mensaje').html('<div class="alert alert-success" role="alert">¡Persona eliminado exitosamente!</div>'); 
 
        }, "json");
    } else {
        $('#mensaje').html('<div class="alert alert-danger" role="alert">Se ha cancelado la operación</div>');
    }
}

</script>
