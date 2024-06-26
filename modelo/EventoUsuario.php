<?php
require_once 'Db.php';
include '../lib/GeneradorDatos.php';
//llamamos a las librerias

Class EventoUsuario {
protected $table = "evento_usuario"; //creamos la tabla usuario
protected $conection; //protegemos el atributo de conexion;
protected $cantidad; //protegemos la cantidad de disertantes
private $EventoId;
private $UsuarioId;

//get
public function getEventoId(){
    return $this->EventoId;
}
public function getUsuarioId(){
    return $this->UsuarioId;
}

//set
public function SetEventoId(){
    return $this->EventoId;
}
public function SetUsuarioId(){
    return $this->UsuarioId;
}

function getConection(){ //creamos la conexion con la base de datos;
    $db= new Db; //crea un nuevo objeto basededatos
    $this->conection=$db->conection; //le asigna el valor a conexion a la basededatos
}



public function getEventosUsuarios(){ //creamos la conexion a la tabla
    $this->getConection(); //ejecuta un metodo de la clase que gestiona la conexion a la base de datos
    $sql="SELECT * FROM ".$this->table; //armamos la cadena sql 
    $stmt=$this->conection->prepare($sql); //metemos la cadena que armamos para armar la consulta
    $stmt->execute(); //ejecutamos la consulta
    return $stmt->fetchAll(PDO::FETCH_ASSOC); //retorno de todos los resultados de la consulta

}

public function getEventosUsuariosByIds($IdE,$IdU){ //empieza la funtion
    $this->getConection(); //ejecuta un metodo de la clase que gestiona la conexion a la base de datos
    $sql="SELECT FROM ".$this->table." WHERE Evento_id = ? && Usuario_id  = ? "; //armamos la cadena sql 
    $stmt=$this->conection->prepare($sql); //metemos la cadena que armamos para armar la consulta
    return $stmt->execute([$IdE,$IdU]); //ejecutamos la consulta
}

public function getEventosUsuariosByEventos($id){ //creamos la conexion a la tabla
    $this->getConection(); //ejecuta un metodo de la clase que gestiona la conexion a la base de datos
    $sql="SELECT * FROM ".$this->table." WHERE Evento_id = ?"; //armamos la cadena sql 
    $stmt=$this->conection->prepare($sql); //metemos la cadena que armamos para armar la consulta
    $stmt->execute([$id]); //ejecutamos la consulta
    return $stmt->fetchAll(PDO::FETCH_ASSOC); //retorno de todos los resultados de la consulta

}

public function getEventosUsuariosByUsuarios($id){ //creamos la conexion a la tabla
    $this->getConection(); //ejecuta un metodo de la clase que gestiona la conexion a la base de datos
    $sql="SELECT * FROM ".$this->table." WHERE Usuario_id  = ?"; //armamos la cadena sql 
    $stmt=$this->conection->prepare($sql); //metemos la cadena que armamos para armar la consulta
    $stmt->execute([$id]); //ejecutamos la consulta
    return $stmt->fetchAll(PDO::FETCH_ASSOC); //retorno de todos los resultados de la consulta

}
// funciones especificas 

public function getCantidadEventosUsuario($id) {
    $this->getConection();
    $sql = "SELECT COUNT(Usuario_id) as Cantidad FROM " . $this->table . " WHERE Evento_id = ?";
    $stmt = $this->conection->prepare($sql);
    $stmt->execute([$id]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['Cantidad'];
}

public function deleteEventosUsuariosByIds($IdE,$IdU){ //empieza la funtion
    $this->getConection(); //ejecuta un metodo de la clase que gestiona la conexion a la base de datos
    $sql="DELETE FROM ".$this->table." WHERE Evento_id = ? && Usuario_id  = ? "; //armamos la cadena sql 
    $stmt=$this->conection->prepare($sql); //metemos la cadena que armamos para armar la consulta
    return $stmt->execute([$IdE,$IdU]); //ejecutamos la consulta
}


public function save($param) {
    $this->getConection(); // Conectarse a la base de datos

    // Verificar si existe la instancia
    $exists = false;
    if (isset($param['ide']) && isset($param['idu']) && $param['ide'] != "" && $param['idu'] != "") {
        $ActualInstancia = $this->getEventosUsuariosByIds($param['ide'], $param['idu']);
        //var_dump($ActualInstancia);
        if ($ActualInstancia) {
            // Si existe un ID, establecer valores para UPDATE
            $exists = true;
            $this->EventoId = $ActualInstancia['ide'];
            $this->UsuarioId = $ActualInstancia['idu']; // Aquí debes corregir si es necesario, asumiendo que 'nombre' es el nombre de la columna correcto
        }
    }

    // Establecer los valores del arreglo asociativo
    if (isset($param['ide'])) {
        $this->EventoId = $param['ide'];
    }
    if (isset($param['idu'])) {
        $this->UsuarioId = $param['idu'];
    }

    // Ejecutar la consulta SQL adecuada según si existe o no
    if ($exists) {
        // UPDATE
        $sql = "UPDATE `evento_usuario` SET `Evento_id` = ?, `Usuario_id` = ? WHERE Evento_id = ? AND Usuario_id = ?";
        $stmt = $this->conection->prepare($sql);
        $stmt->execute([$this->EventoId, $this->UsuarioId, $this->EventoId, $this->UsuarioId]);
    } else {
        // INSERT
        $sql = "INSERT INTO `evento_usuario` (`Evento_id`, `Usuario_id`) VALUES (?, ?)";
        $stmt = $this->conection->prepare($sql);
        $stmt->execute([$this->EventoId, $this->UsuarioId]);
        $this->EventoId = $this->conection->lastInsertId(); // Obtener el ID generado automáticamente
    }

    // Retornar los IDs actualizados o insertados
    return [$this->EventoId, $this->UsuarioId];
}






//INSERT INTO `evento_usuario` (`Evento_id`, `Usuario_id`) VALUES ('1', '3');
} //fin de la clase


$eu = new EventoUsuario();
//$eu -> deleteEventosUsuariosByIds(1,1); mandamos ambos ids


echo '<pre>'; 

print_r($eu->getEventosUsuarios());

echo '</pre>';

$param = ['ide' => 10, 'idu' => 2];
echo '<pre>'; 

echo "cargue datos para el usuario eventos";
//var_dump($param);
$eu-> save($param);

echo '</pre>';

?>
