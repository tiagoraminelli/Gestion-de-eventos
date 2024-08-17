<?php
require_once 'Db.php';

require_once 'Usuario.php';
Class UsuarioFilter extends Usuario{ //creamos la clase extendida 
protected $conection; //protegemos el atributo de conexion y la heredamos aca
protected $cantidad;
//en un grupo de clases con muchos de objetos te resuelve que yo pueda aplciar filtros de busqqueda y asi obtener 1 o muchos objetos con ese filtro

//NOTA: esta funcion se puede implementar de otra forma, no solo la del profe :3 []

public function getUsuarioFilter($filtros=[]){ //iniciamos la F. ArregloFilter
$this->getUsuarios(); //llamamos a los disertantes;
$sql="SELECT * FROM ".$this->table." WHERE 1=1";
if(!empty($filtros)){ //preguntamos si es diferente de vacio

/*
['id'];
        ['nombre'];
        ['apellidos'];
        ['dni'];
        ['direccion'];
        ['telefono'];
        ['email'];
        ['password'];
 */
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
        if(isset($filtros['dni'])){
        $sql.=" AND dni LIKE '%".$filtros['dni']."%'";  // el .=  es una concatenacion AGREGADA que usaremos para concatenar valores a la cadena
       
        }
    
        if(isset($filtros['direccion'])){
        $sql.=" AND direccion LIKE '%".$filtros['direccion']."%'";  // el .=  es una concatenacion AGREGADA que usaremos para concatenar valores a la cadena
           
        }

        if(isset($filtros['telefono'])){
            $sql.=" AND telefono LIKE '%".$filtros['telefono']."%'";  // el .=  es una concatenacion AGREGADA que usaremos para concatenar valores a la cadena
                
        }

        if(isset($filtros['email'])){
        $sql.=" AND email LIKE '%".$filtros['email']."%'";  // el .=  es una concatenacion AGREGADA que usaremos para concatenar valores a la cadena
           
        }
        if(isset($filtros['password'])){
        $sql.=" AND password LIKE '%".$filtros['password']."%'";  // el .=  es una concatenacion AGREGADA que usaremos para concatenar valores a la cadena
           
        }
      


}

  

    // die($sql); MI MEJOR AMIGO

$stmt=$this->conection->prepare($sql); //metemos la cadena que armamos para armar la consulta
$stmt->execute();//aca metemos todos los valores al ? pero tenemos que tener en cuenta el ORDEN
$resul = $stmt->fetchAll(PDO::FETCH_ASSOC); //retorno de todos los resultados de la consulta original
return $resul;

}//termino la F. ArregloFilter



}//fin de la clase extendida



//echo "<br>"."empazamos php filter"."<br>" ;

// Crear una instancia de Usuario
//$filter = new UsuarioFilter();
//$filtros = ['nombre' => 'al','apellidos' => 'a', 'direccion' => 'a']; //hace los cambios aca y lo pegas despues arriba
// Llamar al método arregloFilter en la instancia 
//resultados = $filter->getUsuarioFilter(); //['apellido' => 'Ramos', 'nombre' => 'a']

echo '<pre>'; //asi da gusto
//print_r($resultados);
echo '</pre>';



?>


