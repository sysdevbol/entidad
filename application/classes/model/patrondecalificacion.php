<?php
defined('SYSPATH') or die ('no tiene acceso');
//descripcion del modelo productos
class Model_Patrondecalificacion extends ORM{
    protected $_table_names_plural = false;
    
    public function califica1($montoexpgen,$clasificacion,$proyecto,$area){
    	$sql="SELECT * from patrondecalificacion where patrondecalificacion.id_areacalificaion = '$area' 
        and id_clasificacion = '$clasificacion' AND id_proyecto = '$proyecto' and (CAST(rango1 as DECIMAL(0)) <= $montoexpgen and CAST(rango2 as DECIMAL(0)) > $montoexpgen)";
    	$reg = @mysql_fetch_assoc(mysql_query($sql));
    	if(empty($reg['puntaje'])){
    		return 0;
    	}else{
    		return $reg['puntaje'];
    	}
    }
    public function califica2($tipo,$clasificacion,$proyecto,$area){
        $tipolike = '%'.$tipo.'%';
        $sql="SELECT * from patrondecalificacion where patrondecalificacion.id_areacalificaion = '$area' 
        and id_clasificacion = '$clasificacion' AND id_proyecto = '$proyecto' and rango1 like '$tipolike'";
        $reg = @mysql_fetch_assoc(mysql_query($sql));
        if(empty($reg['puntaje'])){
            return 0;
        }else{
            return $reg['puntaje'];
        }
    }
    public function califica3($exparea,$clasificacion,$proyecto,$area){
        $areain = '('.$exparea.')';
        $sql="SELECT SUM(puntaje) as 'puntajesum' from patrondecalificacion where patrondecalificacion.id_areacalificaion = '$area' 
        and id_clasificacion = '$clasificacion' AND id_proyecto = '$proyecto' and rango1 in $areain";
        $reg = @mysql_fetch_assoc(mysql_query($sql));
        if(empty($reg['puntajesum'])){
            return 0;
        }else{
            return $reg['puntajesum'];
        }
    }
}
?>
