<?php

require_once 'Db.php';
require_once 'Exportar.php';
include '../lib/GeneradorDatos.php';
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

    public function setNombre($Nombre) {
        $this->Nombre = $Nombre;
    }
    
    public function setApellidos($Apellidos) {
        $this->Apellidos = $Apellidos;
    }
    
    public function setTelefono($Telefono) {
        $this->Telefono = $Telefono;
    }
    
    public function setEmail($Email) {
        $this->Email = $Email;
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

//Cantidad de Registros numericamente
    
public function getCantidad(){
    $this->getConection(); //EXACTAMENTE LO MISMO QUE LO ANTERIOR
    $sql="SELECT count(*) as cantidad FROM ".$this->table; //consulta sql generica, ese signo ? es un valor
    $stmt=$this->conection->prepare($sql); //metemos la cadena que armamos para armar la consulta
    $stmt->execute();//aca metemos todos los valores al ? pero tenemos que tener en cuenta el ORDEN
    return $stmt->fetch(PDO::FETCH_ASSOC); //te manda solo 1 linea 

}

//Todas las persona registradas como usuario

public function getAllPersonasUsuarios(){
    $this->getConection(); //EXACTAMENTE LO MISMO QUE LO ANTERIOR
    $sql="SELECT * FROM persona,usuario WHERE persona.idPersona = usuario.idUsuario";
    $stmt=$this->conection->prepare($sql); //metemos la cadena que armamos para armar la consulta
    $stmt->execute();//aca metemos todos los valores al ? pero tenemos que tener en cuenta el ORDEN
    return $stmt->fetch(PDO::FETCH_ASSOC); //te manda solo 1 linea 

}

//Todas las persona registradas como usuario por Id

public function getAllPersonasUsuariosById($Id){
    $this->getConection(); //EXACTAMENTE LO MISMO QUE LO ANTERIOR
    $sql="SELECT * FROM persona,usuario WHERE persona.idPersona = ? and usuario.idUsuario = ?";
    $stmt=$this->conection->prepare($sql); //metemos la cadena que armamos para armar la consulta
    $stmt->execute([$Id,$Id]);//aca metemos todos los valores al ? pero tenemos que tener en cuenta el ORDEN
    return $stmt->fetchAll(PDO::FETCH_ASSOC); //te manda solo 1 linea 

}

//Elimina las persona registradas como usuario por Id

public function deletePersonAndUsuarioById($id) {
    try {
        $this->getConection(); // Ejecuta un método de la clase que gestiona la conexión a la base de datos
        
        // Inicia una transacción
        $this->conection->beginTransaction();

        // Prepara y ejecuta la eliminación en la tabla `usuario`
        $sql = "DELETE FROM usuario WHERE idUsuario = ?";
        $stmt = $this->conection->prepare($sql);
        $stmt->execute([$id]);

        // Prepara y ejecuta la eliminación en la tabla `persona`
        $sql = "DELETE FROM persona WHERE idPersona = ?";
        $stmt = $this->conection->prepare($sql);
        $stmt->execute([$id]);

        // Confirma la transacción
        $this->conection->commit();

        return true; // Indicar éxito
    } catch (PDOException $e) {
        // Revierte la transacción si hubo algún error
        $this->conection->rollBack();
        echo 'Error al eliminar registros: ' . $e->getMessage();
        return false; // Indicar fallo
    }
}

//Borra la persona por Id

public function deletePersonaById($id){ //empieza la funtion
    $this->getConection(); //ejecuta un metodo de la clase que gestiona la conexion a la base de datos
    $sql="DELETE FROM ".$this->table." WHERE persona.`id` = ? "; //armamos la cadena sql 
    $stmt=$this->conection->prepare($sql); //metemos la cadena que armamos para armar la consulta
    return $stmt->execute([$id]); //ejecutamos la consulta


}




//Paginacion::
public function getPersonaPaginacion($porPagina, $offset) {
    try {
        $sql = "SELECT * FROM ".$this->table." LIMIT :porPagina OFFSET :offset";
        $stmt = $this->conection->prepare($sql);
        $stmt->bindValue(':porPagina', (int) $porPagina, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo 'Error al obtener usuarios paginados: ' . $e->getMessage();
        return [];
    }
}

//Fin de paginacion::

//save;

public function save($param) {
    $this->getConection();

    $exists = FALSE;
    if (isset($param['id']) && ($param['id'] != "")) {
        $ActualInstancia = $this->getPersonaById($param['id']);

        if ($ActualInstancia) {
            $exists = TRUE;
            $this->Id = $ActualInstancia['id'];
            $this->Nombre = $ActualInstancia['nombre'];
            $this->Apellidos = $ActualInstancia['apellidos'];
            $this->Telefono = $ActualInstancia['telefono'];
            $this->Email = $ActualInstancia['email'];
        }
    }

    if (isset($param['id'])) {
        $this->Id = $param['id'];
    }

    if (isset($param['nombre'])) {
        $this->Nombre = $param['nombre'];
    }

    if (isset($param['apellidos'])) {
        $this->Apellidos = $param['apellidos'];
    }

    if (isset($param['telefono'])) {
        $this->Telefono = $param['telefono'];
    }

    if (isset($param['email'])) {
        $this->Email = $param['email'];
    }

    if ($exists) {
        $sql = "UPDATE ".$this->table." SET `nombre` = ?, `apellidos` = ?, `telefono` = ?, `email` = ? WHERE `id` = ?";
        $stmt = $this->conection->prepare($sql);
        $stmt->execute([
            $this->Nombre, $this->Apellidos, $this->Telefono, $this->Email, $this->Id
        ]);
    } else {
        $sql = "INSERT INTO ".$this->table." (`nombre`, `apellidos`, `telefono`, `email`) VALUES (?, ?, ?, ?)";
        $stmt = $this->conection->prepare($sql);
        $stmt->execute([
            $this->Nombre, $this->Apellidos, $this->Telefono, $this->Email
        ]);
        $this->Id = $this->conection->lastInsertId();
    }
    return $this->Id;
}


public function cargaPrueba(){ //creamos la funcion para cargar
    for ($i = 1; $i <= 4; $i++){ //definimos un rango de datos para cargar
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
$p = new Persona();

$p->save(
    [
        'nombre' => 'LEO',
        'apellidos' => 'PERALTA',
        'telefono' => '112312312331',
        'email' => 'LEOOOO@gmail.com'
    ]); 

//var_dump($p);
//$file =Exportar::exportarDatos();
echo "hola"."<br>";
echo "prueba de git";
//var_dump($p->getAllPersonasUsuarios());

?>