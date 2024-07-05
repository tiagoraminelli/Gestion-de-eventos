<?php

require_once 'Db.php';
require_once 'Exportar.php';
//include '../lib/GeneradorDatos.php';
class Persona {
    protected $table = "persona";       // Nombre de la tabla en la base de datos
    protected $conection;  // Conexión a la base de datos
    protected $cantidad;    // Cantidad de disertantes (parece un contador)

    private $Id;
    private $Nombre;
    private $Apellidos;
    private $Email;
    private $Telefono;

    function getConection(){ //creamos la conexion con la base de datos;
        $db= new Db; //crea un nuevo objeto basededatos
        $this->conection=$db->conection; //le asigna el valor a conexion a la basededatos
    }
    
    // Constructor
    public function __construct($Id = "", $Nombre ="", $Apellidos="", $Email="", $Telefono=""){
        $this->Id = $Id;
        $this->Nombre = $Nombre;
        $this->Apellidos = $Apellidos;
        $this->Email = $Email;
        $this->Telefono = $Telefono;
    }

    // Métodos getters y setters (ejemplo de uno para cada atributo)
    public function getId() {
        return $this->Id;
    }

    public function getNombre(){
        return $this->Nombre;
    }

    public function getApellidos(){
        return $this->Apellidos;
    }

    public function getTelefono(){
        return $this->Telefono;
    }

    public function getEmail(){
        return $this->Email;
    }


    //setters
    public function setId($Id) {
        $this->Id = $Id;
    }

    public function setNombre(){
        return $this->Nombre;
    }

    public function setApellidos(){
        return $this->Apellidos;
    }

    public function setTelefono(){
        return $this->Telefono;
    }

    public function setEmail(){
        return $this->Email;
    }

    // Otros métodos comunes relacionados con la persona podrían ir aquí

    public function getPersona(){ //creamos la conexion a la tabla
        $this->getConection(); //ejecuta un metodo de la clase que gestiona la conexion a la base de datos
        $sql="SELECT * FROM ".$this->table; //armamos la cadena sql 
        $stmt=$this->conection->prepare($sql); //metemos la cadena que armamos para armar la consulta
        $stmt->execute(); //ejecutamos la consulta
        return $stmt->fetchAll(PDO::FETCH_ASSOC); //retorno de todos los resultados de la consulta
    
    }

    public function getPersonaById($Id){
        $this->getConection(); //EXACTAMENTE LO MISMO QUE LO ANTERIOR
        $sql="SELECT * FROM ".$this->table." WHERE id = ?"; //consulta sql generica, ese signo ? es un valor
        $stmt=$this->conection->prepare($sql); //metemos la cadena que armamos para armar la consulta
        $stmt->execute([$Id]);//aca metemos todos los valores al ? pero tenemos que tener en cuenta el ORDEN
        return $stmt->fetch(PDO::FETCH_ASSOC);//te manda solo 1 linea
    }

    public function getPersonaByNombre($Nombre){
        $this->getConection(); //EXACTAMENTE LO MISMO QUE LO ANTERIOR
        $sql="SELECT * FROM ".$this->table." WHERE nombre = ?"; //consulta sql generica, ese signo ? es un valor
        $stmt=$this->conection->prepare($sql); //metemos la cadena que armamos para armar la consulta
        $stmt->execute([$Nombre]);//aca metemos todos los valores al ? pero tenemos que tener en cuenta el ORDEN
        return $stmt->fetch(PDO::FETCH_ASSOC);//te manda solo 1 linea
    
    }

    public function getPersonaByApellidos($Apellidos){
        $this->getConection(); //EXACTAMENTE LO MISMO QUE LO ANTERIOR
        $sql="SELECT * FROM ".$this->table." WHERE Apellidos = ?"; //consulta sql generica, ese signo ? es un valor
        $stmt=$this->conection->prepare($sql); //metemos la cadena que armamos para armar la consulta
        $stmt->execute([$Apellidos]);//aca metemos todos los valores al ? pero tenemos que tener en cuenta el ORDEN
        return $stmt->fetch(PDO::FETCH_ASSOC); //te manda solo 1 linea 
    
    }
    
    public function getPersonaByEmail($Email){
        $this->getConection(); //EXACTAMENTE LO MISMO QUE LO ANTERIOR
        $sql="SELECT * FROM ".$this->table." WHERE email = ?"; //consulta sql generica, ese signo ? es un valor
        $stmt=$this->conection->prepare($sql); //metemos la cadena que armamos para armar la consulta
        $stmt->execute([$Email]);//aca metemos todos los valores al ? pero tenemos que tener en cuenta el ORDEN
        return $stmt->fetch(PDO::FETCH_ASSOC); //te manda solo 1 linea 
    
    }

    //funciones especiales

    
public function getCantidad(){
    $this->getConection(); //EXACTAMENTE LO MISMO QUE LO ANTERIOR
    $sql="SELECT count(*) as cantidad FROM ".$this->table; //consulta sql generica, ese signo ? es un valor
    $stmt=$this->conection->prepare($sql); //metemos la cadena que armamos para armar la consulta
    $stmt->execute();//aca metemos todos los valores al ? pero tenemos que tener en cuenta el ORDEN
    return $stmt->fetch(PDO::FETCH_ASSOC); //te manda solo 1 linea 

}

public function deletePersonaById($id){ //empieza la funtion
    $this->getConection(); //ejecuta un metodo de la clase que gestiona la conexion a la base de datos
    $sql="DELETE FROM ".$this->table." WHERE persona.`id` = ? "; //armamos la cadena sql 
    $stmt=$this->conection->prepare($sql); //metemos la cadena que armamos para armar la consulta
    return $stmt->execute([$id]); //ejecutamos la consulta


}

public function deletePersonAndDisertanteById($id) {
    try {
        $this->getConection(); //ejecuta un metodo de la clase que gestiona la conexion a la base de datos
        $sql="DELETE FROM persona WHERE persona.`id` = ? "; //armamos la cadena sql 
        $stmt=$this->conection->prepare($sql); //metemos la cadena que armamos para armar la consulta
        $stmt->execute([$id]);

        $sql="DELETE FROM disertante WHERE disertante.`id` = ? "; //armamos la cadena sql 
        $stmt=$this->conection->prepare($sql); //metemos la cadena que armamos para armar la consulta
        $stmt->execute([$id]);
        return $stmt->execute();
    } catch (PDOException $e) {
        // Revertir la transacción si hubo algún error
        $conection->rollBack();
        echo 'Error al eliminar registros: ' . $e->getMessage();
        return false; // Indicar fallo
    }
}

public function deletePersonAndUsuarioById($id) {
    try {
        $this->getConection(); //ejecuta un metodo de la clase que gestiona la conexion a la base de datos
        $sql="DELETE FROM persona WHERE persona.`id` = ? "; //armamos la cadena sql 
        $stmt=$this->conection->prepare($sql); //metemos la cadena que armamos para armar la consulta
        $stmt->execute([$id]);

        $sql="DELETE FROM usuario WHERE usuario.`id` = ? "; //armamos la cadena sql 
        $stmt=$this->conection->prepare($sql); //metemos la cadena que armamos para armar la consulta
        $stmt->execute([$id]);
        return $stmt->execute();
    } catch (PDOException $e) {
        // Revertir la transacción si hubo algún error
        $conection->rollBack();
        echo 'Error al eliminar registros: ' . $e->getMessage();
        return false; // Indicar fallo
    }
}





public function getUsuariosPaginacion($porPagina, $offset) {
    try {
        $stmt = $this->conection->prepare("SELECT * FROM ".$this->table." LIMIT :porPagina OFFSET :offset");
        $stmt->bindParam(':porPagina', $porPagina, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        $arregloPersona = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $arregloPersona;
    } catch (PDOException $e) {
        echo 'Error al obtener usuarios paginados: ' . $e->getMessage();
        return []; // En caso de error, retornar un arreglo vacío o manejar el error según tu aplicación
    }
}

//save;

public function save($param){ //creamos la funcion y le mandamos 1 ARREGLO ASOCIATIVO
    $this->getConection(); //nos conectamos a la base de datos

    //check if exists
    $exists = FALSE;
    if(isset($param['id']) && ($param['id'] != "")){ //si esta creado el id y es diferente de vacio
        $ActualInstancia = $this->getPersonaById($param['id']); //se guarda el arreglo segun el id

        if($ActualInstancia['id']){ //si existe un ID se setean los valores para UPDATE
            $exists = TRUE; //existe el id
            $this->id = $ActualInstancia['id'];
            $this->Nombre = $ActualInstancia['nombre']; // empezamos a setear valores
            $this->Apellidos = $ActualInstancia['apellidos'];
            $this->Telefono = $ActualInstancia['telefono'];
            $this->Email = $ActualInstancia['email'];
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


if(isset($param['telefono'])){
    $this->Telefono = $param['telefono'];

} //fin del isset


if(isset($param['email'])){
    $this->Email = $param['email'];

} //fin del isset

if ($exists){
    $sql = "UPDATE ".$this->table." SET `nombre` = ?, `apellidos` = ?, `telefono` = ?, `email` = ? WHERE `id` = ?";
    echo $sql;
    $stmt=$this->conection->prepare($sql); //metemos la cadena que armamos para armar la consulta
    $stmt->execute([
        $this->Nombre, $this->Apellidos, $this->Telefono, $this->Email, $this->id
    ]);

}else {
    // INSERT
    $sql = "INSERT INTO ".$this->table." (`id`, `nombre`, `apellidos`,`telefono`, `email`) VALUES (NULL, ?, ?, ?, ?)";
    echo $sql;
    $stmt = $this->conection->prepare($sql);
    $stmt->execute([
        $this->Nombre, $this->Apellidos, $this->Telefono, $this->Email
    ]);
    $this->id = $this->conection->lastInsertId(); // Obtener el ID generado automáticamente
}
return $this->id;

//var_dump($param,$exists);
} // fin de la funcion


public function cargaPrueba(){ //creamos la funcion para cargar
    for ($i = 1; $i <= 100; $i++){ //definimos un rango de datos para cargar
 //datos del telefono a crear
$caracteristicas = generadorDatos::caracteristicaAleatoria(); 
$numeroTelefonico = generadorDatos::numeroTelefonicoAleatorio($caracteristicas);
$telefonoFormateado = $caracteristicas."-".$numeroTelefonico;

//

 $Nombre = generadorDatos::nombreAleatorio(); //invocamos los metodos
 $Apellidos = generadorDatos::apellidosAleatorios(); 
 $Telefono = generadorDatos::caracteristicaAleatoria();
 $Email = generadorDatos::emailAleatorio($Nombre,$Apellidos); //invocamos los metodos y les metemos valores
 
echo "<br>"."nombres generados: " . $Nombre;
echo "<br>"."apellidos generados: " . $Apellidos;
echo "<br>"."telefono formateado: " . $telefonoFormateado;
echo "<br>"."emails generados: " . $Email;


    $this->save(
        [
            'nombre' => $Nombre,
            'apellidos' => $Apellidos,
            'telefono' => $telefonoFormateado,
            'email' => $Email
        ]); 


} //fin del for
}//fin de la funcion

    
} //fin de la clase


//$file =Exportar::exportarDatos();


?>