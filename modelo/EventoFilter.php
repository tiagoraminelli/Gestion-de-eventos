<?php
require_once 'Db.php';
require_once 'Evento.php';
Class EventoFilter extends Evento{
    protected $conection; //protegemos el atributo de conexion y la heredamos aca
    protected $cantidad;

    public function getEventosFilter($filtros=[]){
        $this->getEventos(); //llamamos a los disertantes;

        $sql="SELECT evento.*,disertante.* FROM ".$this->table.",disertante WHERE (evento.disertante_id = disertante.id) and 1=1";
        //echo $sql; mi mejor amigo
        if(!empty($filtros)){
            //creamos los campos
            if(isset($filtros['id'])){
                $sql.=" AND id = ".$filtros['id'];  
                //echo "<br>".$filtros['id'];
                //die("<br>"."entro"); //ESTO ESTA POR LAS DUDAS PARA VER SI ENTRA MI MEJOR AMIGO
            }

            if(isset($filtros['titulo'])){
                $sql.=" AND titulo LIKE '%".$filtros['titulo']."%'";  // el .=  es una concatenacion AGREGADA que usaremos para concatenar valores a la cadena
            }

            if(isset($filtros['descripcion'])){
                $sql.=" AND descripcion LIKE '%".$filtros['descripcion']."%'";  // el .=  es una concatenacion AGREGADA que usaremos para concatenar valores a la cadena
            }

            if(isset($filtros['fecha'])){
                $sql.=" AND fecha LIKE '%".$filtros['fecha']."%'";  // el .=  es una concatenacion AGREGADA que usaremos para concatenar valores a la cadena
            }

            if(isset($filtros['hora'])){
                $sql.=" AND hora LIKE '%".$filtros['hora']."%'";  // el .=  es una concatenacion AGREGADA que usaremos para concatenar valores a la cadena
            }

            if(isset($filtros['duracion'])){
                $sql.=" AND duracion LIKE '%".$filtros['duracion']."%'";  // el .=  es una concatenacion AGREGADA que usaremos para concatenar valores a la cadena
            }

            if(isset($filtros['idioma'])){
                $sql.=" AND idioma LIKE '%".$filtros['idioma']."%'";  // el .=  es una concatenacion AGREGADA que usaremos para concatenar valores a la cadena
            }

            if(isset($filtros['disertante_id'])){
                $sql.=" AND disertante_id LIKE '%".$filtros['disertante_id']."%'";  // el .=  es una concatenacion AGREGADA que usaremos para concatenar valores a la cadena
            }



            
            
                

            }// fin de los campos



            $stmt=$this->conection->prepare($sql); //metemos la cadena que armamos para armar la consulta
            $stmt->execute();//aca metemos todos los valores al ? pero tenemos que tener en cuenta el ORDEN
            $resul = $stmt->fetchAll(PDO::FETCH_ASSOC); //retorno de todos los resultados de la consulta original
            return $resul;
           
            
        } //fin del IF EMPTY


}//FIN DE LA CLASE

/* echo "Filtro de Eventos";

$f = new EventoFilter();

$filtros=[]; */

/*'fecha' => '2024-06-05',
'hora' => '12:00:00',
'duracion' => 10,
'idioma' => 'Ingles',
'disertante_id' => '336'*/
/* echo '<pre>';
print_r($f->getEventosFilter($filtros)); 
echo '</pre>';
 
echo '<pre>';
echo "arreglo de filtro"."<br>";
print_r($filtros);
echo '</pre>'; */









?>