<?php
defined('SYSPATH') or die ('no tiene acceso');
//descripcion del modelo productos
class Model_Historybusqueda extends ORM{
    protected $_table_names_plural = false;
    public function datoscodigo($idcodigo){
            $sql="SELECT * FROM historybusqueda where id = $idcodigo";
            $datos = array();

           $result = db::query(Database::SELECT, $sql)->execute();
           $i = 1;
           foreach ($result as $r) {                    
                        $datos[$i] = array(
                            'id' => $r['id'],
                            'user' => $r['user'],
                            'criterios' => $r['criterios'],
                            'resultado' => $r['resultado'],
                            'fecha' => $r['fecha'],
                        );
                        $i++;
                    }
                    
           return array_values($datos); 
    }
}



?>
