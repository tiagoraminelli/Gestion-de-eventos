<?php
set_include_path("../../modelo/");
require_once 'Db.php';
include 'Evento.php';

$e = new Evento(); // Asegúrate de que 'Evento' sea la clase correcta o esté incluida correctamente

if (isset($_POST['id'])) {
    $idEvento = $_POST['id'];
    $evento = $e->getEventosById($idEvento);

    // Verificamos si se encontró el evento
    if ($evento) {
        // Preparamos un array asociativo con los datos del evento
        $datosEvento = [
            'id' => $evento['id'],
            'titulo' => $evento['titulo'],
            'descripcion' => $evento['descripcion'],
            'fecha' => $evento['fecha'],
            'hora' => $evento['hora'],
            'duracion' => $evento['duracion'],
            'idioma' => $evento['idioma'],
            'disertante_id' => $evento['disertante_id']
        ];

        // Enviamos la respuesta como JSON
        header('Content-Type: application/json');
        echo json_encode($datosEvento);
    } else {
        echo json_encode(['error' => 'No se encontró el evento con el ID proporcionado']);
    }
} else {
    echo json_encode(['error' => 'No se recibió el ID del evento']);
}
?>
