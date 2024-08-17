<?php
require_once 'Db.php';
//include '../lib/GeneradorDatos.php';

//llamamos a las librerias

Class Evento {
    protected $table = "evento"; //creamos la tabla evento
protected $conection; //protegemos el atributo de conexion;
protected $cantidad; //protegemos la cantidad de eventos
private $Id;
private $Titulo;
private $Descripcion;
private $Fecha;
private $Hora;
private $Duracion;
private $Idioma;
private $DisertanteEventoId;
function getConection(){ //creamos la conexion con la base de datos;
    $db= new Db; //crea un nuevo objeto basededatos
    $this->conection=$db->conection; //le asigna el valor a conexion a la basededatos
}

//S
public function getTitulo(){
    return $this->Titulo;
}
public function getDescripcion(){
    return $this->Descripcion;
}
public function getFecha(){
    return $this->Fecha;
}
public function getHora(){
     return $this->Hora;
}
public function getDuracion(){
     return $this->Duracion;
}
public function getIdioma(){
     return $this->Idioma;
}
public function getDisertanteEventoId(){
     return $this->DisertanteEventoId;
}



// SetS
public function SetTitulo(){
    return $this->Titulo;
}
public function SetDescripcion(){
    return $this->Descripcion;
}
public function SetFecha(){
    return $this->Fecha;
}
public function SetHora(){
     return $this->Hora;
}
public function SetDuracion(){
     return $this->Duracion;
}
public function SetIdioma(){
     return $this->Idioma;
}
public function SetDisertanteEventoId(){
     return $this->DisertanteEventoId;
}

//creamos la funcion para obtener los datos de los eventos

public function getEventos(){ //creamos la conexion a la tabla
    $this->getConection(); //ejecuta un metodo de la clase que gestiona la conexion a la base de datos
    $sql="SELECT * FROM ".$this->table; //armamos la cadena sql 
    $stmt=$this->conection->prepare($sql); //metemos la cadena que armamos para armar la consulta
    $stmt->execute(); //ejecutamos la consulta
    return $stmt->fetchAll(PDO::FETCH_ASSOC); //retorno de todos los resultados de la consulta

}

//creamos la funcion para obtener los datos de los eventos y los disertantes

public function getEventosDisertantes(){ //creamos la conexion a la tabla
    $this->getConection(); //ejecuta un metodo de la clase que gestiona la conexion a la base de datos
    //SELECT * FROM `evento`
    $sql="SELECT * FROM ".$this->table." ,disertante WHERE evento.disertante_id = disertante.id"; //armamos la cadena sql 
    $stmt=$this->conection->prepare($sql); //metemos la cadena que armamos para armar la consulta
    $stmt->execute(); //ejecutamos la consulta
    return $stmt->fetchAll(PDO::FETCH_ASSOC); //retorno de todos los resultados de la consulta

}

//creamos la funcion para obtener los datos por medio del ID

public function getEventosById($Id){
    $this->getConection(); //EXACTAMENTE LO MISMO QUE LO ANTERIOR
    $sql="SELECT * FROM ".$this->table." WHERE id = ?"; //consulta sql generica, ese signo ? es un valor
    $stmt=$this->conection->prepare($sql); //metemos la cadena que armamos para armar la consulta
    $stmt->execute([$Id]);//aca metemos todos los valores al ? pero tenemos que tener en cuenta el ORDEN
    return $stmt->fetch(PDO::FETCH_ASSOC);//te manda solo 1 linea
}

//creamos la funcion para obtener los datos por medio del titulo

public function getEventosByTitulo($Titulo){
    $this->getConection(); //EXACTAMENTE LO MISMO QUE LO ANTERIOR
    $sql="SELECT * FROM ".$this->table." WHERE titulo = ?"; //consulta sql generica, ese signo ? es un valor
    $stmt=$this->conection->prepare($sql); //metemos la cadena que armamos para armar la consulta
    $stmt->execute([$Titulo]);//aca metemos todos los valores al ? pero tenemos que tener en cuenta el ORDEN
    return $stmt->fetch(PDO::FETCH_ASSOC);//te manda solo 1 linea
}

//creamos la funcion para obtener los datos por medio del descripcion??

public function getEventosByDescrip($Descripcion){
    $this->getConection(); //EXACTAMENTE LO MISMO QUE LO ANTERIOR
    $sql="SELECT * FROM ".$this->table." WHERE descripcion = ?"; //consulta sql generica, ese signo ? es un valor
    $stmt=$this->conection->prepare($sql); //metemos la cadena que armamos para armar la consulta
    $stmt->execute([$Descripcion]);//aca metemos todos los valores al ? pero tenemos que tener en cuenta el ORDEN
    return $stmt->fetch(PDO::FETCH_ASSOC);//te manda solo 1 linea
}

//creamos la funcion para obtener los datos por medio del 

public function getEventosByFecha($Fecha){
    $this->getConection(); //EXACTAMENTE LO MISMO QUE LO ANTERIOR
    $sql="SELECT * FROM ".$this->table." WHERE fecha = ?"; //consulta sql generica, ese signo ? es un valor
    $stmt=$this->conection->prepare($sql); //metemos la cadena que armamos para armar la consulta
    $stmt->execute([$Fecha]);//aca metemos todos los valores al ? pero tenemos que tener en cuenta el ORDEN
    return $stmt->fetch(PDO::FETCH_ASSOC);//te manda solo 1 linea
}

//creamos la funcion para obtener los datos por medio de la hora

public function getEventosByHora($Hora){
    $this->getConection(); //EXACTAMENTE LO MISMO QUE LO ANTERIOR
    $sql="SELECT * FROM ".$this->table." WHERE hora = ?"; //consulta sql generica, ese signo ? es un valor
    $stmt=$this->conection->prepare($sql); //metemos la cadena que armamos para armar la consulta
    $stmt->execute([$Hora]);//aca metemos todos los valores al ? pero tenemos que tener en cuenta el ORDEN
    return $stmt->fetch(PDO::FETCH_ASSOC);//te manda solo 1 linea
}

//creamos la funcion para obtener los datos por medio de la duracion

public function getEventosByDuracion($Duracion){
    $this->getConection(); //EXACTAMENTE LO MISMO QUE LO ANTERIOR
    $sql="SELECT * FROM ".$this->table." WHERE duracion = ?"; //consulta sql generica, ese signo ? es un valor
    $stmt=$this->conection->prepare($sql); //metemos la cadena que armamos para armar la consulta
    $stmt->execute([$Duracion]);//aca metemos todos los valores al ? pero tenemos que tener en cuenta el ORDEN
    return $stmt->fetch(PDO::FETCH_ASSOC);//te manda solo 1 linea
}


//creamos la funcion para obtener los datos por medio del idioma

public function getEventosByIdioma($Idioma){
    $this->getConection(); //EXACTAMENTE LO MISMO QUE LO ANTERIOR
    $sql="SELECT * FROM ".$this->table." WHERE idioma = ?"; //consulta sql generica, ese signo ? es un valor
    $stmt=$this->conection->prepare($sql); //metemos la cadena que armamos para armar la consulta
    $stmt->execute([$Idioma]);//aca metemos todos los valores al ? pero tenemos que tener en cuenta el ORDEN
    return $stmt->fetch(PDO::FETCH_ASSOC);//te manda solo 1 linea
}


//creamos la funcion para obtener los datos por medio del disertante

public function getEventosByDisertante($DisertanteEventoId){
    $this->getConection(); //EXACTAMENTE LO MISMO QUE LO ANTERIOR
    $sql="SELECT * FROM ".$this->table." WHERE disertante_id = ?"; //consulta sql generica, ese signo ? es un valor
    $stmt=$this->conection->prepare($sql); //metemos la cadena que armamos para armar la consulta
    $stmt->execute([$DisertanteEventoId]);//aca metemos todos los valores al ? pero tenemos que tener en cuenta el ORDEN
    return $stmt->fetch(PDO::FETCH_ASSOC);//te manda solo 1 linea
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////  FUNCIONES ESPECIALES //////////////////////////////////////////////////////////////

public function getEventosPaginacion($porPagina, $offset) {
    try {
        $stmt = $this->conection->prepare("SELECT * FROM evento LIMIT :porPagina OFFSET :offset");
        $stmt->bindParam(':porPagina', $porPagina, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        $arregloEventos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $arregloEventos;
    } catch (PDOException $e) {
        echo 'Error al obtener usuarios paginados: ' . $e->getMessage();
        return []; // En caso de error, retornar un arreglo vacío o manejar el error según tu aplicación
    }
}

public function getCantidadEventos(){
    $this->getConection(); //EXACTAMENTE LO MISMO QUE LO ANTERIOR
    $sql="SELECT count(*) as cantidad FROM ".$this->table; //consulta sql generica, ese signo ? es un valor
    $stmt=$this->conection->prepare($sql); //metemos la cadena que armamos para armar la consulta
    $stmt->execute();//aca metemos todos los valores al ? pero tenemos que tener en cuenta el ORDEN
    return $stmt->fetch(PDO::FETCH_ASSOC); //te manda solo 1 linea 

}

public function getDatosDisertanteByEventos(){
    $this->getConection(); //EXACTAMENTE LO MISMO QUE LO ANTERIOR
    $sql="SELECT * FROM ".$this->table. ",disertante WHERE evento.disertante_id = disertante.id"; //consulta sql generica, ese signo ? es un valor
    $stmt=$this->conection->prepare($sql); //metemos la cadena que armamos para armar la consulta
    $stmt->execute();//aca metemos todos los valores al ? pero tenemos que tener en cuenta el ORDEN
    return $stmt->fetchAll(PDO::FETCH_ASSOC); //te manda solo 1 linea 

}

public function deleteEventosById($Id){ //empieza la funtion
    $this->getConection(); //ejecuta un metodo de la clase que gestiona la conexion a la base de datos
    $sql="DELETE FROM ".$this->table." WHERE `id` = ? "; //armamos la cadena sql 
    $stmt=$this->conection->prepare($sql); //metemos la cadena que armamos para armar la consulta
    return $stmt->execute([$Id]); //ejecutamos la consulta
}

public function getPaginasPorEventos($porPagina, $offset) {
    try {
        $stmt = $this->conection->prepare("SELECT * FROM evento LIMIT :porPagina OFFSET :offset");
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

public function save($param){ //creamos la funcion y le mandamos 1 ARREGLO ASOCIATIVO
    $this->getConection(); //nos conectamos a la base de datos
    //check if exists
    $exists = FALSE;
    if(isset($param['id']) && ($param['id'] != "")){ //si esta creado el id y es diferente de vacio
        $ActualInstancia = $this->getEventosById($param['id']); //se guarda el arreglo segun el id
        //current values

        if($ActualInstancia['id']){ //si existe un ID se setean los valores para UPDATE
            $exists = TRUE; //existe el id
            $this->Id = $ActualInstancia['id'];
            $this->Titulo = $ActualInstancia['titulo']; // empezamos a setear valores
            $this->Descripcion = $ActualInstancia['descripcion'];
            $this->Fecha = $ActualInstancia['fecha'];
            $this->Hora = $ActualInstancia['hora'];
            $this->Duracion = $ActualInstancia['duracion'];
            $this->Idioma = $ActualInstancia['idioma'];
            $this->DisertanteEventoId = $ActualInstancia['disertante_id'];
        }
    }

//valores recibidos


if(isset($param['id'])){
    $this->Id = $param['id'];

} //fin del isset


if(isset($param['titulo'])){
    $this->Titulo = $param['titulo'];

} //fin del isset

if(isset($param['descripcion'])){
    $this->Descripcion = $param['descripcion'];

} //fin del isset

if(isset($param['fecha'])){                             
    $this->Fecha = $param['fecha'];

} //fin del isset

if(isset($param['hora'])){
    $this->Hora = $param['hora'];

} //fin del isset

if(isset($param['duracion'])){
    $this->Duracion = $param['duracion'];

} //fin del isset


if(isset($param['idioma'])){
    $this->Idioma = $param['idioma'];

} //fin del isset

if(isset($param['disertante_id'])){
    $this->DisertanteEventoId = $param['disertante_id'];
    
} //fin 


if ($exists){ 
    //actualizar
    $sql = "UPDATE `evento` SET `titulo` = ?, `descripcion` = ?, `fecha` = ?, `hora` = ?, `duracion` = ?, `idioma` = ?, `disertante_id` = ? WHERE `id` = ?";    
    $stmt=$this->conection->prepare($sql); //metemos la cadena que armamos para armar la consulta
    $stmt->execute([
        $this->Titulo, $this->Descripcion, $this->Fecha, $this->Hora, $this->Duracion, $this->Idioma, $this->DisertanteEventoId, $this->Id
    ]);

}else { 
    // INSERT
    $sql = "INSERT INTO `evento` (`id`, `titulo`, `descripcion`, `fecha`, `hora`, `duracion`, `idioma`, `disertante_id`) VALUES (NULL, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $this->conection->prepare($sql);
    $stmt->execute([
        $this->Titulo, $this->Descripcion, $this->Fecha, $this->Hora, $this->Duracion, $this->Idioma, $this->DisertanteEventoId
    ]);
    $this->Id = $this->conection->lastInsertId(); // Obtener el ID generado automáticamente
}

return $this->Id;

//var_dump($param,$exists);
} // fin de la funcion


public function cargaPrueba(){ //creamos la funcion para cargar
    for ($i = 1; $i <= 1; $i++){ //definimos un rango de datos para cargar
        
           
    //echo "espeamos la carga de prueba"."<br>";
        //$id	
         $titulo = generadorDatos::titulosAleatorios();
         $descripcion = generadorDatos::loremAleatorio();
         $fecha = generadorDatos::dateAleatoria();
         $hora = generadorDatos::horaAleatoria();;
         $duracion = generadorDatos::timeAleatoria();
         $idioma = generadorDatos::idiomasAleatorios();
         $disertanteId = generadorDatos::numeroAleatorio();

         echo "<br>".$titulo;
         echo "<br>".$descripcion;
         echo "<br>".$fecha;
         echo "<br>".$hora;
         echo "<br>".$duracion;
         echo "<br>".$idioma;
         echo "<br>".$disertanteId;

     $this->save([
         `titulo` => $titulo,
         `descripcion` => $descripcion,
         `fecha` => $fecha,
         `hora` => $hora,
         `duracion` => $duracion,
         `idioma` => $idioma,
         `disertante_id`=> $disertanteId
         ]); 
     //echo "<br>".$disertanteId."<br>"; 
    }
}


//lo usare mas tarde
//INSERT INTO `evento` (`id`, `titulo`, `descripcion`, `fecha`, `hora`, `duracion`, `idioma`, `disertante_id`) VALUES (NULL, 'Preparación para la gestión de eventos', 'Es una catedra donde estudiamos las formas en las que creamos Sotfware para eventos', '2024-06-10', '16:00:00', '5', 'Español', '451');


} //fin de la clase evento

//$e = new evento();

// $resultados = $e -> getEventos(); //getEventos
/* 
$param = [
'titulo' => 'desarrollo de Sotfware Gestion de Eventos n° ',
'descripcion' => 'Es una catedra donde estudiamos las formas en las que creamos Sotfware ',
'fecha' => '2024-06-12',
'hora' => '18:00:00',
'duracion' => 1,
'idioma' => 'español',
'disertante_id' => '51'];
*/

// $param = [
//     'id' => 1,
//     'titulo' => 'Gestion de Proyectos',
//     'descripcion' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Expedita unde est debitis veritatis nobis culpa consequatur, optio similique quae sint! Tempore necessitatibus quaerat dolorum, optio officia exercitationem error expedita nemo!'
// ]; 
    

// $e -> save($param);
// if(empty($resultados)){
//     $resultados = ['datos' => 'no existen'];
// }



// echo '<pre>'; 
// //print_r($resultados);
// //print_r($param);
// echo '</pre>'; 
 //$e -> cargaPrueba();




?>