<?php
// Establecer la ruta del include_path si es necesario
set_include_path("../modelo/");

// Incluir el archivo DisertanteFilter.php
require 'persona.php';

// Instanciar la clase DisertanteFilter
$d = new persona();

// Obtener los datos de los disertantes
$datosPersona= $d->getPersona();

// Verificar los datos obtenidos (para propósitos de depuración)
 //var_dump($array_disertante);

// Abrir el archivo para escritura
$file = fopen("personas.txt", "w") or die("No se pudo abrir el archivo.");

// Iterar sobre cada disertante y escribir sus datos en el archivo
foreach ($datosPersona as $datos) {
    // Escribir los datos de cada datos en el archivo
    fwrite($file, "ID: " . $datos['id'] . "\n");
    fwrite($file, "Nombre: " . $datos['nombre'] . "\n");
    fwrite($file, "Apellidos: " . $datos['apellidos'] . "\n");
    fwrite($file, "Teléfono: " . $datos['telefono'] . "\n");
    fwrite($file, "Email: " . $datos['email'] . "\n");

}

// Cerrar el archivo
fclose($file);

// Mensaje de éxito

// Preparar un mensaje JSON para enviar de vuelta a menudatos.php
$mensaje = array(
    'tipo' => 'exito',
    'texto' => 'La exportación de datos fue exitosa.'
);

// Devolver el mensaje en formato JSON
echo json_encode($mensaje);
exit;

?>

