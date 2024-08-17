<?php
require_once 'Db.php';
//include '../lib/GeneradorDatos.php';
require_once 'Persona.php'; // Importamos la clase Persona para poder extenderla
Class Usuario extends Persona{
    protected $table = "usuario"; //creamos la tabla usuario
protected $conection; //protegemos el atributo de conexion;
protected $cantidad; //protegemos la cantidad de disertantes

private $Dni;
private $Direccion;
private $Password;

function getConection(){ //creamos la conexion con la base de datos;
    $db= new Db; //crea un nuevo objeto basededatos
    $this->conection=$db->conection; //le asigna el valor a conexion a la basededatos
}

//GETS

public function getDni(){
     return $this->Dni;
}

public function getDireccion(){
     return $this->Direccion;
}

public function getPassword(){
     return $this->Password;
}


// SETS

public function setDni(){
     return $this->Dni;
}
public function setDireccion(){
     return $this->Direccion;
}

public function setPassword(){
     return $this->Password;
} 


public function __construct($Dni = "",$Direccion = "",$Password = ""){ //$Nombre,$Apellidos
    $this->Dni = $Dni;
    $this->Direccion = $Direccion;
    $this->Password = $Password;
    return $this;
}

//DEVUELVE EL LIST DE TODOS LOS DISERTANTES 

public function getUsuarios(){ //creamos la conexion a la tabla
    $this->getConection(); //ejecuta un metodo de la clase que gestiona la conexion a la base de datos
    $sql="SELECT * FROM ".$this->table; //armamos la cadena sql 
    $stmt=$this->conection->prepare($sql); //metemos la cadena que armamos para armar la consulta
    $stmt->execute(); //ejecutamos la consulta
    return $stmt->fetchAll(PDO::FETCH_ASSOC); //retorno de todos los resultados de la consulta

}

//ARMAMOS LA FUNCION DE INVOCAR LOS DATOS POR ID

public function getUsuariosById($Id){
    $this->getConection(); //EXACTAMENTE LO MISMO QUE LO ANTERIOR
    $sql="SELECT * FROM ".$this->table." WHERE id = ?"; //consulta sql generica, ese signo ? es un valor
    $stmt=$this->conection->prepare($sql); //metemos la cadena que armamos para armar la consulta
    $stmt->execute([$Id]);//aca metemos todos los valores al ? pero tenemos que tener en cuenta el ORDEN
    return $stmt->fetch(PDO::FETCH_ASSOC);//te manda solo 1 linea

}

//ARMAMOS LA FUNCION DE INVOCAR LOS DATOS POR NOMBRE

public function getUsuariosByNombre($Nombre){
    $this->getConection(); //EXACTAMENTE LO MISMO QUE LO ANTERIOR
    $sql="SELECT * FROM ".$this->table." WHERE nombre = ?"; //consulta sql generica, ese signo ? es un valor
    $stmt=$this->conection->prepare($sql); //metemos la cadena que armamos para armar la consulta
    $stmt->execute([$Nombre]);//aca metemos todos los valores al ? pero tenemos que tener en cuenta el ORDEN
    return $stmt->fetch(PDO::FETCH_ASSOC);//te manda solo 1 linea

}

//ARMAMOS LA FUNCION DE INVOCAR LOS DATOS POR APELLIDOS

public function getUsuariosByApellidos($Apellidos){
    $this->getConection(); //EXACTAMENTE LO MISMO QUE LO ANTERIOR
    $sql="SELECT * FROM ".$this->table." WHERE Apellidos = ?"; //consulta sql generica, ese signo ? es un valor
    $stmt=$this->conection->prepare($sql); //metemos la cadena que armamos para armar la consulta
    $stmt->execute([$Apellidos]);//aca metemos todos los valores al ? pero tenemos que tener en cuenta el ORDEN
    return $stmt->fetch(PDO::FETCH_ASSOC); //te manda solo 1 linea 

}

public function getUsuariosByDni($Dni){
    $this->getConection(); //EXACTAMENTE LO MISMO QUE LO ANTERIOR
    $sql="SELECT * FROM ".$this->table." WHERE dni = ?"; //consulta sql generica, ese signo ? es un valor
    $stmt=$this->conection->prepare($sql); //metemos la cadena que armamos para armar la consulta
    $stmt->execute([$Dni]);//aca metemos todos los valores al ? pero tenemos que tener en cuenta el ORDEN
    return $stmt->fetch(PDO::FETCH_ASSOC); //te manda solo 1 linea 

}

public function getUsuariosByDireccion($Direccion){
    $this->getConection(); //EXACTAMENTE LO MISMO QUE LO ANTERIOR
    $sql="SELECT * FROM ".$this->table." WHERE direccion = ?"; //consulta sql generica, ese signo ? es un valor
    $stmt=$this->conection->prepare($sql); //metemos la cadena que armamos para armar la consulta
    $stmt->execute([$Direccion]);//aca metemos todos los valores al ? pero tenemos que tener en cuenta el ORDEN
    return $stmt->fetch(PDO::FETCH_ASSOC); //te manda solo 1 linea 

}
public function getUsuariosByEmail($Email){
    $this->getConection(); //EXACTAMENTE LO MISMO QUE LO ANTERIOR
    $sql="SELECT * FROM ".$this->table." WHERE email = ?"; //consulta sql generica, ese signo ? es un valor
    $stmt=$this->conection->prepare($sql); //metemos la cadena que armamos para armar la consulta
    $stmt->execute([$Email]);//aca metemos todos los valores al ? pero tenemos que tener en cuenta el ORDEN
    return $stmt->fetch(PDO::FETCH_ASSOC); //te manda solo 1 linea 

}


//funcion para sacar la cantidad;

public function getUsuariosPaginacion($porPagina, $offset) {
    try {
        $stmt = $this->conection->prepare("SELECT * FROM usuario LIMIT :porPagina OFFSET :offset");
        $stmt->bindParam(':porPagina', $porPagina, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        $arregloUsuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $arregloUsuarios;
    } catch (PDOException $e) {
        echo 'Error al obtener usuarios paginados: ' . $e->getMessage();
        return []; // En caso de error, retornar un arreglo vacío o manejar el error según tu aplicación
    }
}

public function getCantidad(){
    $this->getConection(); //EXACTAMENTE LO MISMO QUE LO ANTERIOR
    $sql="SELECT count(*) as cantidad FROM ".$this->table; //consulta sql generica, ese signo ? es un valor
    $stmt=$this->conection->prepare($sql); //metemos la cadena que armamos para armar la consulta
    $stmt->execute();//aca metemos todos los valores al ? pero tenemos que tener en cuenta el ORDEN
    return $stmt->fetch(PDO::FETCH_ASSOC); //te manda solo 1 linea 

}

public function save($param){ //creamos la funcion y le mandamos 1 ARREGLO ASOCIATIVO
    $this->getConection(); //nos conectamos a la base de datos
    /*
set default values    
    */

    //$id=$Nombre=$Apellidos=$Biografia=$Telefono=$Url=$Email=$Twitter=$Linkedin=""; //CREAMOS TODOS LOS ATRIBUTOS DE CLARADOS EN VACIO

    //check if exists
    $exists = FALSE;
    if(isset($param['id']) && ($param['id'] != "")){ //si esta creado el id y es diferente de vacio
        $ActualInstancia = $this->getUsuariosById($param['id']); //se guarda el arreglo segun el id


    
    if($ActualInstancia['id']){ //si existe un ID se setean los valores para UPDATE
            $exists = TRUE; //existe el id
            $this->id = $ActualInstancia['id'];
            $this->Nombre = $ActualInstancia['nombre']; // empezamos a setear valores
            $this->Apellidos = $ActualInstancia['apellidos'];
            $this->Dni = $ActualInstancia['dni'];
            $this->Direccion = $ActualInstancia['direccion'];
            $this->Telefono = $ActualInstancia['telefono'];
            $this->Email = $ActualInstancia['email'];
            $this->Password = $ActualInstancia['password'];
        }
    }

//valores recibidos

if(isset($param['id'])){
    $this->id = $param['id'];

} //fin del isset


if(isset($param['nombre'])){
    $this->Nombre = $param['nombre'];

} //fin del isset

if(isset($param['apellidos'])){
    $this->Apellidos = $param['apellidos'];

} //fin del isset

if(isset($param['dni'])){                             
    $this->Dni = $param['dni'];

} //fin del isset

if(isset($param['direccion'])){
    $this->Direccion = $param['direccion'];

} //fin del isset

if(isset($param['telefono'])){
    $this->Telefono = $param['telefono'];

} //fin del isset


if(isset($param['email'])){
    $this->Email = $param['email'];

} //fin del isset

if(isset($param['password'])){
    $this->Password = $param['password'];
    
} //fin 


if ($exists){
    $sql = "UPDATE `usuario` SET `nombre` = ?, `apellidos` = ?, `dni` = ?, `direccion` = ?, `telefono` = ?, `email` = ?, `password` = ? WHERE `id` = ?";
    $stmt=$this->conection->prepare($sql); //metemos la cadena que armamos para armar la consulta
    $stmt->execute([
        $this->Nombre, $this->Apellidos, $this->Dni, $this->Direccion, $this->Telefono, $this->Email, $this->Password, $this->id
    ]);

}else {
    // INSERT
    $sql = "INSERT INTO `usuario` (`id`, `nombre`, `apellidos`, `dni`, `direccion`, `telefono`, `email`, `password`) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $this->conection->prepare($sql);
    $stmt->execute([
        $this->Nombre, $this->Apellidos, $this->Dni, $this->Direccion, $this->Telefono, $this->Email, $this->Password
    ]);
    $this->id = $this->conection->lastInsertId(); // Obtener el ID generado automáticamente
}
return $this->id;

//var_dump($param,$exists);
} // fin de la funcion

public function deleteUsuariosById($id){ //empieza la funtion
    $this->getConection(); //ejecuta un metodo de la clase que gestiona la conexion a la base de datos
    $sql="DELETE FROM ".$this->table." WHERE `id` = ? "; //armamos la cadena sql 
    $stmt=$this->conection->prepare($sql); //metemos la cadena que armamos para armar la consulta
    return $stmt->execute([$id]); //ejecutamos la consulta
}


public function cargaPrueba(){ //creamos la funcion para cargar
    for ($i = 1; $i <= 25; $i++){ //definimos un rango de datos para cargar
 //datos del telefono a crear
$caracteristicas = generadorDatos::caracteristicaAleatoria(); 
$numeroTelefonico = generadorDatos::numeroTelefonicoAleatorio($caracteristicas);
$telefonoFormateado = $caracteristicas." ".$numeroTelefonico;

//

 $Nombre = generadorDatos::nombreAleatorio(); //invocamos los metodos
 $Apellidos = generadorDatos::apellidosAleatorios(); 
 $Dni = generadorDatos::dniAleatorio();
 $Direccion =  generadorDatos::direccionAleatorio();
 $Telefono = generadorDatos::caracteristicaAleatoria();
 $Email = generadorDatos::emailAleatorio($Nombre,$Apellidos); //invocamos los metodos y les metemos valores
 $Password = generadorDatos::passwordAleatoria(); //invocamos los metodos y les metemos valores
 
/* echo "<br>"."nombres generados: " . $Nombre;
echo "<br>"."apellidos generados: " . $Apellidos;
echo "<br>"."dni generados: " .$Dni;
echo "<br>"."direccion generado: " . $Direccion;
echo "<br>"."telefono formateado: " . $telefonoFormateado;
echo "<br>"."emails generados: " . $Email;
echo "<br>"."Contraseña generados: " . $Password;   */

     $this->save(
        [
            'nombre' => $Nombre,
            'apellidos' => $Apellidos,
            'dni' => $Dni,
            'telefono' => $telefonoFormateado,
            'direccion' => $Direccion,
            'email' => $Email,
            'password' => $Password
        ]); 

//}
/*      VARIABLES A MANO
        ['id'];
        ['nombre'];
        ['apellidos'];
        ['dni'];
        ['direccion'];
        ['telefono'];
        ['email'];
        ['password'];
        id =
        Nombre =
        Apellidos = 
        Dni = 
        Direccion = //CREAR
        Telefono =
        Email = 
        Password = 
        INSERT INTO `usuario` (`id`, `nombre`, `apellido`, `dni`, `direccion`, `telefono`, `email`, `password`) VALUES (NULL, 'root', 'root', '43766375', 'root', '3408-430891', 'root@gmail.com', 'root');
*/
    }
}
/* getUsuarios()
getUsuariosById($Id)
getUsuariosByNombre($Nombre)
getUsuariosByApellidos($Apellidos)
getCantidad()
deleteUsuariosById($id) */

}//fin de la clase

//echo "<br>"."nueva persona";

//$idToDelete = 21;
//$deleted = $u->deletePersonAndUsuarioById($idToDelete);

//$datos = $p->save(['nombre' => 'tiago','apellido' => 'raminelli']);
//var_dump($datos);
  // Guardar o actualizar al usuario en la base de datos
//   $idUsuario = $u->save([
//     'id' => $usuario->getId(),
//     'nombre' => $usuario->getNombre(),
//     'apellidos' => $usuario->getApellidos(),
//     'dni' => $usuario->getDni(),
//     'direccion' => $usuario->getDireccion(),
//     'telefono' => $usuario->getTelefono(),
//     'email' => $usuario->getEmail(),
//     'password' => $usuario->getPassword()
// ]);

// if ($deleted) {
//     echo "Registros de Persona y usuario con ID $idToDelete eliminados correctamente.<br>";
// } else {
//     echo "Error al eliminar registros de Persona y usuario con ID $idToDelete.<br>";
// }


?>
