<?php
defined('SYSPATH') or die ('no tiene acceso');
//descripcion del modelo productos
class Model_Municipios extends ORM{
    protected $_table_names_plural = false;    
    public function listamuni($iddepto){
            $sql="SELECT * FROM municipios where departamento_id = '$iddepto'";
            $munis = array();

           $result = db::query(Database::SELECT, $sql)->execute();
           $i = 1;
           foreach ($result as $r) {                    
                        $munis[$i] = array(
                            'id' => $r['id'],
                            'municipio' => $r['municipio'],
                        );
                        $i++;
                    }
                    
           return array_values($munis); 
    }
    
}

?>
