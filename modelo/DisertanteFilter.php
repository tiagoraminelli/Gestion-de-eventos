<?php
require_once 'Db.php';
require_once 'Disertante.php';
Class DisertanteFilter extends Disertante{ //creamos la clase extendida 
protected $conection; //protegemos el atributo de conexion y la heredamos aca
protected $cantidad;
//en un grupo de clases con muchos de objetos te resuelve que yo pueda aplciar filtros de busqqueda y asi obtener 1 o muchos objetos con ese filtro

//NOTA: esta funcion se puede implementar de otra forma, no solo la del profe :3 []




public function arregloFilter($inicio,$final,$filtros=[]){ //iniciamos la F. ArregloFilter
$this->getDisertantes(); //llamamos a los disertantes;
$sql="SELECT * FROM ".$this->table." WHERE 1=1";
if(!empty($filtros)){ //preguntamos si es diferente de vacio


    if(isset($filtros['id'])){

        $sql.=" AND id = ".$filtros['id'];  // el .=  es una concatenacion AGREGADA que usaremos para concatenar valores a la cadena
        //die("entro"); ESTO ESTA POR LAS DUDAS PARA VER SI ENTRA
        }
    
        if(isset($filtros['nombre'])){
        $sql.=" AND nombre LIKE '%".$filtros['nombre']."%'";  // el .=  es una concatenacion AGREGADA que usaremos para concatenar valores a la cadena
    
        }
        if(isset($filtros['apellidos'])){
        $sql.=" AND apellidos LIKE '%".$filtros['apellidos']."%'";  // el .=  es una concatenacion AGREGADA que usaremos para concatenar valores a la cadena
    
        }
        if(isset($filtros['biografia'])){
        $sql.=" AND biografia LIKE '%".$filtros['biografia']."%'";  // el .=  es una concatenacion AGREGADA que usaremos para concatenar valores a la cadena
       
        }
        if(isset($filtros['telefono'])){
        $sql.=" AND telefono LIKE '%".$filtros['telefono']."%'";  // el .=  es una concatenacion AGREGADA que usaremos para concatenar valores a la cadena
            
        }
        if(isset($filtros['url'])){
        $sql.=" AND url LIKE '%".$filtros['url']."%'";  // el .=  es una concatenacion AGREGADA que usaremos para concatenar valores a la cadena
           
        }
        if(isset($filtros['email'])){
        $sql.=" AND email LIKE '%".$filtros['email']."%'";  // el .=  es una concatenacion AGREGADA que usaremos para concatenar valores a la cadena
           
        }
        if(isset($filtros['twitter'])){
        $sql.=" AND twitter LIKE '%".$filtros['twitter']."%'";  // el .=  es una concatenacion AGREGADA que usaremos para concatenar valores a la cadena
           
        }
        if(isset($filtros['linkedin'])){
        $sql.=" AND linkedin LIKE '%".$filtros['linkedin']."%'";  // el .=  es una concatenacion AGREGADA que usaremos para concatenar valores a la cadena
        }


}

  

    
    //  die($sql);
$stmt=$this->conection->prepare($sql); //metemos la cadena que armamos para armar la consulta
$stmt->execute();//aca metemos todos los valores al ? pero tenemos que tener en cuenta el ORDEN
$resul = $stmt->fetchAll(); //retorno de todos los resultados de la consulta original
return $resul;
    
if(isset($inicio) && isset($final)){
    $sql.= " LIMIT $inicio OFFSET $final ";
    //$sql.= " LIMIT $inicio,$final";
}
$stmt=$this->conection->prepare($sql); //metemos la cadena que armamos para armar la consulta
$stmt->execute();//aca metemos todos los valores al ? pero tenemos que tener en cuenta el ORDEN
$resul = $stmt->fetchAll(PDO::FETCH_ASSOC); //retorno de todos los resultados de la consulta original
return $resul;

}//termino la F. ArregloFilter


public function getDisertanteDetalle(){
    $array_disertante = [];
    $c = 0;
    $inicio = ($page*$perpage)-$perpage;
    $final = ($perpage);
    $array_disertante = $this->arregloFilter($inicio,$final,$filtros);
    return $array_disertante;
}


}//fin de la clase extendida



//echo "<br>"."empazamos php filter"."<br>" ;

/* // Crear una instancia de DisertanteFilter en lugar de Disertante
$filter = new DisertanteFilter();
$filtros = ['nombre' => 'a']; //hace los cambios aca y lo pegas despues arriba
// Llamar al método arregloFilter en la instancia de DisertanteFilter
$resultados = $filter->arregloFilter(0,5,$filtros); //['apellidos' => 'Ramos', 'nombre' => 'a']

var_dump($resultados)."<br>";

//vemos si anda la funcion getcantidad
$resultadosCantidad = $filter->getCantidad();
var_dump($resultadosCantidad['cantidad'])."<br>";
$numeroPaginas = ($resultadosCantidad['cantidad']/10);
echo $numeroPaginas."<br>";
 */

?>

