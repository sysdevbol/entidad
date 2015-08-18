<?php
defined('SYSPATH') or die ('no tiene acceso');
//descripcion del modelo productos
class Model_Postgradoconsultor extends ORM{
    protected $_table_names_plural = false;

    
    public function listaprpostgrado($id_consultor){
            $sql="SELECT postgradoconsultor.id,postgradoconsultor.curso_postgrado,postgradoconsultor.numero_horas,
postgradoconsultor.fecha_diplomaconclusion, postgradoconsultor.universidad_institucion, tipopostgrado.nombre 
FROM postgradoconsultor left join tipopostgrado on id_tipopostgrado = tipopostgrado.id where `id_consultor` = '$id_consultor'";
            $postgrado = array();

           $result = db::query(Database::SELECT, $sql)->execute();
           $i = 1;
           foreach ($result as $r) {                    
                        $postgrado[$i] = array(
                            'id' => $r['id'],
                            'curso_postgrado' => $r['curso_postgrado'],
                            'numero_horas' => $r['numero_horas'],
                            'fecha_diplomaconclusion' => $r['fecha_diplomaconclusion'],
                            'universidad_institucion' => $r['universidad_institucion'],
                            'nombre' => $r['nombre'],
                        );
                        $i++;
                    }
                    
           return array_values($postgrado); 
    }
    public function eliminapostgrado($id){
      $delete = "DELETE from postgradoconsultor where id = '$id'";
      mysql_query($delete);
    }
    public function verificadiplomado($id){
      $sql = "SELECT * from postgradoconsultor where `id_consultor` = '$id' and id_tipopostgrado = '1' and numero_horas >= 200";
      $reg = @mysql_fetch_assoc(mysql_query($sql));
      if(empty($reg['id'])){
        return '0';
      }else{
        return 'SiD';
      }
    }
    public function verificamaestria($id){
      $sql = "SELECT * from postgradoconsultor where `id_consultor` = '$id' and id_tipopostgrado = '2'";
      $reg = @mysql_fetch_assoc(mysql_query($sql));
      if(empty($reg['id'])){
        return '0';
      }else{
        return 'SiMD';
      }
    }
    
    
}



?>
