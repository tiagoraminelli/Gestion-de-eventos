<?php
// Establecer la ruta del include_path si es necesario
set_include_path("../modelo/");

// Incluir el archivo DisertanteFilter.php
require 'disertanteFilter.php';

// Instanciar la clase DisertanteFilter
$d = new DisertanteFilter();

// Obtener los datos de los disertantes
$datosDisertantes= $d->getDisertantes();

// Verificar los datos obtenidos (para propósitos de depuración)
 //var_dump($array_disertante);

// Abrir el archivo para escritura
$file = fopen("archivo.txt", "w") or die("No se pudo abrir el archivo.");

// Iterar sobre cada disertante y escribir sus datos en el archivo
foreach ($datosDisertantes as $disertante) {
    // Escribir los datos de cada disertante en el archivo
    fwrite($file, "ID: " . $disertante['id'] . "\n");
    fwrite($file, "Nombre: " . $disertante['nombre'] . "\n");
    fwrite($file, "Apellidos: " . $disertante['apellidos'] . "\n");
    //fwrite($file, "Biografía: " . $disertante['']. "\n");
    fwrite($file, "Teléfono: " . $disertante['telefono'] . "\n");
    fwrite($file, "URL: " . $disertante['url'] . "\n");
    fwrite($file, "Email: " . $disertante['email'] . "\n");
    fwrite($file, "Twitter: " . $disertante['twitter'] . "\n");
    fwrite($file, "LinkedIn: " . $disertante['linkedin'] . "\n\n");
}

// Cerrar el archivo
fclose($file);

// Mensaje de éxito

// Preparar un mensaje JSON para enviar de vuelta a menuDisertante.php
$mensaje = array(
    'tipo' => 'exito',
    'texto' => 'La exportación de disertantes fue exitosa.'
);

// Devolver el mensaje en formato JSON
echo json_encode($mensaje);
exit;

?>

