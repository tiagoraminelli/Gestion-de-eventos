<?php
set_include_path("../modelo/");
require 'EventoFilter.php'; 
//creamos al DisertanteFilter
$evento = new EventoFilter();
$eventosListados = $evento->getEventosFilter();
 echo '<pre>';
print_r($eventosListados); 
echo '</pre>';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado Eventos</title>
</head>
<body>
    

</body>
</html>