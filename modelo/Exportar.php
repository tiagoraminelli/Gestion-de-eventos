<?php

require_once 'Db.php';
require_once 'Persona.php'; // Importamos la clase Persona para poder extenderla
abstract class Exportar{


static public function exportarDatos(){
  
$d = new persona();
$datosPersona= $d->getPersona();
$file = fopen("personas.txt", "w") or die("No se pudo abrir el archivo.");
foreach ($datosPersona as $datos) {
    // Escribir los datos de cada datos en el archivo
    fwrite($file, "ID: " . $datos['id'] . "\n");
    fwrite($file, "Nombre: " . $datos['nombre'] . "\n");
    fwrite($file, "Apellidos: " . $datos['apellidos'] . "\n");
    fwrite($file, "Teléfono: " . $datos['telefono'] . "\n");
    fwrite($file, "Email: " . $datos['email'] . "\n");

}
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
} //fin del metodo


} //fin de la clase


?>