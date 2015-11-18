<?php
defined('SYSPATH') or die ('no tiene acceso');
//descripcion del modelo productos
class Model_Formacionconsultor extends ORM{
    protected $_table_names_plural = false;

    
    public function listaprformacion($id_consultor){
            $sql="SELECT * FROM formacionconsultor where `id_consultor` = '$id_consultor'";
            $formacionconsultor = array();

           $result = db::query(Database::SELECT, $sql)->execute();
           $i = 1;
           foreach ($result as $r) {                    
                        $formacionconsultor[$i] = array(
                            'id' => $r['id'],
                            'titulo' => $r['titulo'],
                            'universidad_institucion' => $r['universidad_institucion'],
                            'fecha_diplomaconclusion' => $r['fecha_diplomaconclusion'],
                            'tipo' => $r['tipo'],
                        );
                        $i++;
                    }
                    
           return array_values($formacionconsultor); 
    }
    public function eliminaformacion($id){
      $delete = "DELETE from formacionconsultor where id = '$id'";
      mysql_query($delete);
    }
    public function verificatpn($id){
      $sql = "SELECT * from formacionconsultor where id_consultor = '$id' and fecha_diplomaconclusion > '0000-00-00'";
      $reg = @mysql_fetch_assoc(mysql_query($sql));
      if(empty($reg['id'])){
        return '0';
      }else{
        return 'SiTPN';
      }
    }
    
    
}



?>
