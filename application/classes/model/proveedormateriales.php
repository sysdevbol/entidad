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
}
?>
