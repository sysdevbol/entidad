<?php
defined('SYSPATH') or die ('no tiene acceso');
//descripcion del modelo productos
class Model_Departamentosinteres extends ORM{
    protected $_table_names_plural = false;

    
    public function listaprdeptosinteres($id_empresa){
            $sql="SELECT * FROM departamentosinteres where `id_empresas` = '$id_empresa'";
            $deptosinteres = array();

           $result = db::query(Database::SELECT, $sql)->execute();
           $i = 1;
           foreach ($result as $r) {                    
                        $deptosinteres[$i] = array(
                            'id' => $r['id'],
                            'id_empresa' => $r['id_empresas'],
                            'id_departamentos' => $r['id_departamentos'],
                        );
                        $i++;
                    }
                    
           return array_values($deptosinteres); 
    }
    public function guardardeptosinteres($arraydeptos,$id_empresa){
        $delete = "DELETE from departamentosinteres where id_empresas = '$id_empresa'";
        mysql_query($delete);
        for($i=0;$i<=count($arraydeptos)-1;$i++){
            $iddeptos = $arraydeptos[$i];
            $insert = "INSERT into departamentosinteres(`id_empresas`,`id_departamentos`) values('$id_empresa','$iddeptos') ";
            mysql_query($insert);
        }
    } 
    public function verificadint($idempresa){
        $sql = "SELECT * from departamentosinteres where `id_empresas` = $idempresa";
        $reg = @mysql_fetch_assoc(mysql_query($sql));
        if(!empty($reg['id'])){
            return "ok";
        }else{
            return "incompleto";
        }
    } 
    
}



?>
