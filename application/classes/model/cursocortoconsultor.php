<?php
defined('SYSPATH') or die ('no tiene acceso');
//descripcion del modelo productos
class Model_Cursocortoconsultor extends ORM{
    protected $_table_names_plural = false;

    
    public function listaprcursocorto($id_consultor){
            $sql="SELECT * FROM cursocortoconsultor where `id_consultor` = '$id_consultor'";
            $cursocorto = array();

           $result = db::query(Database::SELECT, $sql)->execute();
           $i = 1;
           foreach ($result as $r) {                    
                        $cursocorto[$i] = array(
                            'id' => $r['id'],
                            'curso_corto' => $r['curso_corto'],
                            'universidad_institucion' => $r['universidad_institucion'],
                            'carga_horaria' => $r['carga_horaria'],
                        );
                        $i++;
                    }
                    
           return array_values($cursocorto); 
    }
    public function eliminacursocorto($id){
      $delete = "DELETE from cursocortoconsultor where id = '$id'";
      mysql_query($delete);
    }
    
    
}



?>
