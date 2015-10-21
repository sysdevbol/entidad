<?php
defined('SYSPATH') or die ('no tiene acceso');
//descripcion del modelo productos
class Model_Departamentos extends ORM{
    protected $_table_names_plural = false;
    public function listadepto(){
            $sql="SELECT * FROM departamentos";
            $deptos = array();

           $result = db::query(Database::SELECT, $sql)->execute();
           $i = 1;
           foreach ($result as $r) {                    
                        $deptos[$i] = array(
                            'id' => $r['id'],
                            'departamento' => $r['departamento'],
                        );
                        $i++;
                    }
                    
           return array_values($deptos); 
    }
}



?>
