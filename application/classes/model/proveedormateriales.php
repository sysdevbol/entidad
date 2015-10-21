<?php
defined('SYSPATH') or die ('no tiene acceso');
//descripcion del modelo productos
class Model_Proveedormateriales extends ORM{
    protected $_table_names_plural = false;
    
    public function listarmaterialesproveedor($ide) {
        $sql = "SELECT mr.id as idm,descripcion, unidad,orden,pm.id as idp,empresa_id,material_id,departamentos,municipios 
                FROM materialesrequeridos mr
                LEFT JOIN proveedormateriales pm ON mr.id = pm.material_id AND pm.empresa_id = $ide
                ORDER BY orden ASC";
        return db::query(Database::SELECT, $sql)->execute()->as_array();
    }
    public function listarinsumosproveedor($ide) {
        $sql = "SELECT mr.id as idm,descripcion, unidad,orden,pm.id as idp,empresa_id,material_id,departamentos,municipios 
                FROM insumosrequeridos mr
                LEFT JOIN proveedormateriales pm ON mr.id = pm.material_id AND pm.empresa_id = $ide
                ORDER BY orden ASC";
        return db::query(Database::SELECT, $sql)->execute()->as_array();
    }
    
    public function deleteByMateriales($ide)	{
			$sql="DELETE FROM proveedormateriales WHERE empresa_id=$ide ";
			$response = db::query(Database::DELETE, $sql)->execute();
			
			return 1;
		}
    public function verificamat($ide){
    	$sql="SELECT * from proveedormateriales where empresa_id = $ide";
    	$reg = @mysql_fetch_assoc(mysql_query($sql));
    	if(!empty($reg['id'])){
    		return "ok";
    	}else{
    		return "incompleto";
    	}
    }
    public function cantreg($item,$deptoid){
        $search = '%'.$deptoid.'%';
        $sql = "SELECT COUNT(empresas.id) as cant FROM proveedormateriales INNER JOIN empresas on proveedormateriales.empresa_id = empresas.id 
        where proveedormateriales.material_id = '$item' and proveedormateriales.departamentos LIKE '$search' and empresas.estado and empresas.estado = '4' and (empresas.tipo = 9 or empresas.estado = 19)";
        $reg = @mysql_fetch_assoc(mysql_query($sql));
        if(!empty($reg['cant'])){
            return $reg['cant'];
        }else{
            return 0;
        }
    }
    public function cantregmuni($item,$deptoid,$muniid){
        $search = '%'.$deptoid.'%';
        $search2 = '%'.$muniid.'%';
        $sql="SELECT COUNT(empresas.id) as cant FROM proveedormateriales INNER JOIN empresas on proveedormateriales.empresa_id = empresas.id 
        where proveedormateriales.material_id = '$item' and proveedormateriales.departamentos LIKE '$search' and proveedormateriales.municipios LIKE '$search2' and empresas.estado = '4' and (empresas.tipo = 9 or empresas.estado = 19)";   
        $reg = @mysql_fetch_assoc(mysql_query($sql));
        if(!empty($reg['cant'])){
            return $reg['cant'];
        }else{
            return 0;
        }
    }
}
?>
