<?php
require_once 'Db.php';
//include '../lib/GeneradorDatos.php'; comentamos la clase de generar datos ya que ya cargamos
//creamos la clase disertante con sus atributos
require_once 'Persona.php'; // Importamos la clase Persona para poder extenderla
Class Disertante extends Persona {
protected $table = "disertante"; //creamos la tabla
protected $conection; //protegemos el atributo de conexion;
protected $cantidad; //protegemos la cantidad de disertantes

private $Biografia;
private $Url;
private $Twitter;
private $Linkedin;



function getConection(){ //creamos la conexion con la base de datos;
    $db= new Db; //crea un nuevo objeto basededatos
    $this->conection=$db->conection; //le asigna el valor a conexion a la basededatos
}


//GETS
public function getId(){
    return $this->Id;
}
public function getNombre(){
    return $this->Nombre;
}
public function getApellidos(){
    return $this->Apellidos;
}
public function getBiografia(){
    return $this->Biografia;
}
public function getTelefono(){
    return $this->Telefono;
}
public function getUrl(){
    return $this->Url;
}
public function getEmail(){
    return $this->Email;
}
public function getTwitter(){
    return $this->Twitter;
}
public function getLinkedin(){
    return $this->Linkedin;
}

// SETS
public function setId(){
    return $this->Id;
}
public function setNombre(){
    return $this->Nombre;
}
public function setApellidos(){
    return $this->Apellidos;
}
public function setBiografia(){
    return $this->Biografia;
}
public function setTelefono(){
    return $this->Telefono;
}
public function setUrl(){
    return $this->Url;
}
public function setEmail(){
    return $this->Email;
}
public function setTwitter(){
    return $this->Twitter;
}
public function setLinkedin(){
    return $this->Linkedin;
}


//funcion de conectar a la base de datos con los datos

//INVOCAMOS TODA LA TABLA

//constructor 

public function __construct($Nombre = "",$Apellidos = ""){ //$Nombre,$Apellidos
    $this->Apellidos = $Apellidos;
    $this->Nombre = $Nombre;
    return $this;
}


//DEVUELVE EL LIST DE TODOS LOS DISERTANTES 

public function getDisertantes(){ //creamos la conexion a la tabla
    $this->getConection(); //ejecuta un metodo de la clase que gestiona la conexion a la base de datos
    $sql="SELECT * FROM ".$this->table; //armamos la cadena sql 
    $stmt=$this->conection->prepare($sql); //metemos la cadena que armamos para armar la consulta
    $stmt->execute(); //ejecutamos la consulta
    return $stmt->fetchAll(PDO::FETCH_ASSOC); //retorno de todos los resultados de la consulta

}

//ARMAMOS LA FUNCION DE INVOCAR LOS DATOS POR ID

public function getDisertantesById($Id){
    $this->getConection(); //EXACTAMENTE LO MISMO QUE LO ANTERIOR
    $sql="SELECT * FROM ".$this->table." WHERE id = ?"; //consulta sql generica, ese signo ? es un valor
    $stmt=$this->conection->prepare($sql); //metemos la cadena que armamos para armar la consulta
    $stmt->execute([$Id]);//aca metemos todos los valores al ? pero tenemos que tener en cuenta el ORDEN
    return $stmt->fetch(PDO::FETCH_ASSOC);//te manda solo 1 linea

}

//ARMAMOS LA FUNCION DE INVOCAR LOS DATOS POR NOMBRE

public function getDisertantesByNombre($Nombre){
    $this->getConection(); //EXACTAMENTE LO MISMO QUE LO ANTERIOR
    $sql="SELECT * FROM ".$this->table." WHERE nombre = ?"; //consulta sql generica, ese signo ? es un valor
    $stmt=$this->conection->prepare($sql); //metemos la cadena que armamos para armar la consulta
    $stmt->execute([$Nombre]);//aca metemos todos los valores al ? pero tenemos que tener en cuenta el ORDEN
    return $stmt->fetch(PDO::FETCH_ASSOC);//te manda solo 1 linea

}

//ARMAMOS LA FUNCION DE INVOCAR LOS DATOS POR APELLIDOS

public function getDisertantesByApellidos($Apellidos){
    $this->getConection(); //EXACTAMENTE LO MISMO QUE LO ANTERIOR
    $sql="SELECT * FROM ".$this->table." WHERE Apellidos = ?"; //consulta sql generica, ese signo ? es un valor
    $stmt=$this->conection->prepare($sql); //metemos la cadena que armamos para armar la consulta
    $stmt->execute([$Apellidos]);//aca metemos todos los valores al ? pero tenemos que tener en cuenta el ORDEN
    return $stmt->fetch(PDO::FETCH_ASSOC); //te manda solo 1 linea 

}

//funcion para sacar la cantidad;

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
        $ActualInstancia = $this->getDisertantesById($param['id']); //se guarda el arreglo segun el id
        //current values
        if($ActualInstancia['id']){ //si existe un ID se setean los valores para UPDATE
            $exists = TRUE; //existe el id
            $this->id = $ActualInstancia['id'];
            $this->Nombre = $ActualInstancia['nombre']; // empezamos a setear valores
            $this->Apellidos = $ActualInstancia['apellidos'];
            $this->Biografia = $ActualInstancia['biografia'];
            $this->Telefono = $ActualInstancia['telefono'];
            $this->Url = $ActualInstancia['url'];
            $this->Email = $ActualInstancia['email'];
            $this->Twitter = $ActualInstancia['twitter'];
            $this->Linkedin = $ActualInstancia['linkedin'];
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

if(isset($param['biografia'])){
    $this->Biografia = $param['biografia'];

} //fin del isset

if(isset($param['telefono'])){
    $this->Telefono = $param['telefono'];

} //fin del isset

if(isset($param['url'])){
    $this->Url = $param['url'];

} //fin del isset

if(isset($param['email'])){
    $this->Email = $param['email'];

} //fin del isset

if(isset($param['twitter'])){
    $this->Twitter = $param['twitter'];

} //fin del isset

if(isset($param['linkedin'])){
    $this->Linkedin = $param['linkedin'];

} //fin del isset

if ($exists){
    $sql="UPDATE `disertante` SET `nombre` = ?,`apellidos` = ?,`biografia`=?,`telefono`=?,`url`=?,`email`=?,`twitter`=?,`linkedin` = ? WHERE `id` = ?"; //armamos la cadena sql 
    $stmt=$this->conection->prepare($sql); //metemos la cadena que armamos para armar la consulta
    $stmt->execute([
        $this->Nombre,$this->Apellidos,$this->Biografia,$this->Telefono,$this->Url,$this->Email,$this->Twitter,$this->Linkedin,$this->id
    ]); //ejecutamos la consulta

}else{  //INSERTAR DATOS
    $this->id=$this->conection->lastInsertId();
    $sql="INSERT INTO `disertante` (`id`, `nombre`, `apellidos`, `biografia`, `telefono`, `url`, `email`, `twitter`, `linkedin`) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?)"; //armamos la cadena sql 
    $stmt=$this->conection->prepare($sql); //metemos la cadena que armamos para armar la consulta
    $stmt->execute([
        $this->Nombre,$this->Apellidos,$this->Biografia,$this->Telefono,$this->Url,$this->Email,$this->Twitter,$this->Linkedin
    ]); //ejecutamos la consulta

//echo $Nombre,$Apellidos,$Biografia,$Telefono,$Url,$Email,$Twitter,$Linkedin,$id;
}
return $this->id;

//var_dump($param,$exists);
} // fin de la funcion

public function deleteDisertanteById($id){ //empieza la funtion
    $this->getConection(); //ejecuta un metodo de la clase que gestiona la conexion a la base de datos
    $sql="DELETE FROM ".$this->table." WHERE `id` = ? "; //armamos la cadena sql 
    $stmt=$this->conection->prepare($sql); //metemos la cadena que armamos para armar la consulta
    return $stmt->execute([$id]); //ejecutamos la consulta
}


public function cargaPrueba(){ //creamos la funcion para cargar
    for ($i = 1; $i <= 100; $i++){ //definimos un rango de datos para cargar
 //datos del telefono a crear
$caracteristicas = generadorDatos::caracteristicaAleatoria(); 
$numeroTelefonico = generadorDatos::numeroTelefonicoAleatorio($caracteristicas);
$telefonoFormateado = $caracteristicas." ".$numeroTelefonico;

 //

 $Nombre = generadorDatos::nombreAleatorio(); //invocamos los metodos
 $Apellidos = generadorDatos::apellidosAleatorios(); 
 $Biografia = generadorDatos::loremAleatorio(1);
 $Telefono = generadorDatos::caracteristicaAleatoria();
 $Url = generadorDatos::urlAleatorio($Nombre); //invocamos los metodos y les metemos valores
 $Email = generadorDatos::emailAleatorio($Nombre,$Apellidos); //invocamos los metodos y les metemos valores
 $Twitter = generadorDatos::twitterAleatorio($Nombre,$Apellidos); //invocamos los metodos y les metemos valores
 $Linkedin = generadorDatos::linkedinAleatorio($Nombre,$Apellidos); //invocamos los metodos y les metemos valores
 
/* echo "<br>"."nombres generados: " . $Nombre;
echo "<br>"."apellidos generados: " . $Apellidos;
echo "<br>"."biografia generados: " .$Biografia;
echo "<br>"."telefono formateado: " . $telefonoFormateado;
echo "<br>"."url generados: " . $Url;
echo "<br>"."emails generados: " . $Email;
echo "<br>"."x generados: " . $Twitter; 
echo "<br>"."linkedin generados: " . $Linkedin;  */

    $this->save(
        [
            'nombre' => $Nombre,
            'apellidos' => $Apellidos,
            'biografia' => $Biografia,
            'telefono' => $telefonoFormateado,
            'url' => $Url,
            'email' => $Email,
            'twitter' => $Twitter,
            'linkedin' => $Linkedin
        ]);

}


}

}//fin de clase
/* 
$objDisertante = new Disertante("leo","peralta");



$objDisertante->save([

    'nombre' => 'LEO',
    'apellidos' => 'PERALTA',
    'biografia' => 'PROFE DE INGLES CON TODA LA FURIA DEL COSMOS',
    'telefono' => '112312312331',
    'url' => 'LEOPERALTAMATERCLASS.COM',
    'email' => 'LEOOOO@gmail.com',
    'twitter' => 'x.com/XLEO97',
    'linkedin' => 'linkedin.com/XLEO97'
]); */
//var_dump($param);



//echo "<br>"."empazamos php filter"."<br>" ;
//var_dump($objDisertante->getDisertantesById("3"));

//var_dump($objDisertante->getDisertantes()) ;


//$objDisertante->cargaPrueba();

//ERRORES Y NOTICES
//Trying to access array offset on value of type null; 
//intentar acceder a valores que no existen, entras a las posiciones que no existen
//PDOStatement::execute(): SQLSTATE[HY093]: Invalid parameter number: number of bound variables does not match number of tokens in
//EL NUMERO DE VARIABLES DEL EXECUTE NO COINCIDE
//Fatal error: Uncaught Error: Call to undefined method Disertante::arregloFilter() in C:\xampp7\htdocs\sbge\modelo\DisertanteFilter.php:54 Stack trace: #0 {main} thrown in C:\xampp7\htdocs\sbge\modelo\DisertanteFilter.php on line 54   


//DISERTANTE FILTER







?>