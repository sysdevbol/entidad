<?php
defined('SYSPATH') or die ('no tiene acceso');
//descripcion del modelo productos
class Model_Experienciaentidad extends ORM{
    protected $_table_names_plural = false;
    
    public function verificaexp($idempresa){
    	$sql="SELECT * from experienciaentidad where id_entidad = '$idempresa'";
    	$reg = @mysql_fetch_assoc(mysql_query($sql));
    	if(!empty($reg['id'])){
    		return "ok";
    	}else{
    		return "incompleto";
    	}
    }
    public function montoexp($idempresa){
        $sql = "SELECT SUM(experienciaentidad.monto_contrato) as 'monto' from experienciaentidad where id_entidad = '$idempresa'";
        $reg = @mysql_fetch_assoc(mysql_query($sql));
        if(empty($reg['monto'])){
            return 0;
        }else{
            return $reg['monto'];   
        }
    }
    public function cantaniosexp($idempresa){
        $date = date('Y');
        $date10 = ($date-10)."-01-01";
        $sql = "SELECT round((SUM(round(((to_days(`experienciaentidad`.`fecha_fin_contrato`) - to_days(`experienciaentidad`.`fecha_ini_contrato`)) / 30),2))/12),2) AS 'anios' 
        from experienciaentidad where id_entidad = '$idempresa' and fecha_ini_contrato > '$date10' and tipo = '1'";
        $reg = @mysql_fetch_assoc(mysql_query($sql));
        if(empty($reg['anios'])){
            return 0;
        }else{
            return $reg['anios'];   
        }
    }
    public function porcentajeconestado($idempresa){
        $sql = "SELECT round((((SELECT COUNT(id) from experienciaentidad where id_entidad = '$idempresa' and tipo = '1' and relacion_estado = 'SI')*100)/(SELECT COUNT(id) from experienciaentidad where id_entidad = '$idempresa' and tipo = '1')),2) as 'totalporcentaje'";
        $reg = @mysql_fetch_assoc(mysql_query($sql));
        if(empty($reg['totalporcentaje'])){
            return 0;
        }else{
            return $reg['totalporcentaje'];   
        }
    }
    public function porcentajepordepto($idempresa,$depto){
        $sql = "SELECT round((((SELECT COUNT(id) from experienciaentidad where id_entidad = '$idempresa' and tipo = '1' and id_departamento = '$depto')*100)/(SELECT COUNT(id) from experienciaentidad where id_entidad = '$idempresa' and tipo = '1')),2) as 'totalporcentaje'";
        $reg = @mysql_fetch_assoc(mysql_query($sql));
        if(empty($reg['totalporcentaje'])){
            return 0;
        }else{
            return $reg['totalporcentaje'];   
        }
    }
    public function entidadtipo($idempresa){
        $sql = "SELECT em.tipo as 'tipoentidad'
    FROM experienciaentidad ex INNER JOIN empresas em ON ex.id_entidad = em.id
    where ex.id_entidad = '$idempresa' group by ex.id_entidad";
        $reg = @mysql_fetch_assoc(mysql_query($sql));
        if(empty($reg['tipoentidad'])){
            return 0;
        }else{
            return $reg['tipoentidad'];   
        }
    }
    public function areaexp($idempresa){
        $sql = "SELECT GROUP_CONCAT(id_area) as 'areas' from experienciaentidad 
        where experienciaentidad.id_entidad = '$idempresa' and id_area <> '0' group by id_entidad";
        $reg = @mysql_fetch_assoc(mysql_query($sql));
        if(empty($reg['areas'])){
            return 0;
        }else{
            return $reg['areas'];   
        }
    }
}
?>
