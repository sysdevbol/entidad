<?php
defined('SYSPATH') or die ('no tiene acceso');
//descripcion del modelo productos
class Model_Departamentosinteres extends ORM{
    protected $_table_names_plural = false;

    
    public function listaprdeptosinteres($id_empresa,$tipo){
            $sql="SELECT * FROM departamentosinteres where `id_empresas` = '$id_empresa' and tipo = '$tipo'";
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
    public function guardardeptosinteres2($arraydeptos,$id_empresa){
        $delete = "DELETE from departamentosinteres where id_empresas = '$id_empresa' and tipo = 'Consultor'";
        mysql_query($delete);
        for($i=0;$i<=count($arraydeptos)-1;$i++){
            $iddeptos = $arraydeptos[$i];
            $insert = "INSERT into departamentosinteres(`id_empresas`,`id_departamentos`,`tipo`) values('$id_empresa','$iddeptos','Consultor') ";
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
    public function cantregdeptosinteres($deptoid){
        $sql = "SELECT COUNT(departamentosinteres.id_empresas) as cant 
            FROM departamentosinteres INNER JOIN empresas ON departamentosinteres.id_empresas = empresas.id
            where empresas.estado = 4 and empresas.tipo <> 9 and empresas.tipo <> 19 and departamentosinteres.id_departamentos = $deptoid";
        $reg = @mysql_fetch_assoc(mysql_query($sql));
        if(!empty($reg['cant'])){
            return $reg['cant'];
        }else{
            return 0;
        }    
    } 
    
}



?>
