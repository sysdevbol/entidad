<?php
defined('SYSPATH') or die ('no tiene acceso');
//descripcion del modelo productos
class Model_Materialesrequeridos extends ORM{    
    protected $_table_names_plural = false;
    public function listamateriales(){
            $sql="SELECT * FROM materialesrequeridos";
            $materiales = array();

           $result = db::query(Database::SELECT, $sql)->execute();
           $i = 1;
           foreach ($result as $r) {                    
                        $materiales[$i] = array(
                            'id' => $r['id'],
                            'descripcion' => $r['descripcion'],
                        );
                        $i++;
                    }
                    
           return array_values($materiales); 
    }
    
}



?>
