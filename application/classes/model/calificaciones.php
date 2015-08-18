<?php
defined('SYSPATH') or die ('no tiene acceso');
//descripcion del modelo productos
class Model_Calificaciones extends ORM{
    protected $_table_names_plural = false;
    //protected $_sorting = array('fecha_publicacion' => 'DESC');
    public function recunotas($idempresa){
    	/*
    	$sql = "(SELECT 'Sistema','',comentario, calificacion, fecha_registro from calificaciones where id_empresa = '$idempresa' and id_clasificacion = '1' 
    	and comentario LIKE '%(GENERADO POR EL SISTEMA)%' order by id desc limit 2) UNION ALL (SELECT 'Supervisor',(SELECT username from users 
    		where users.id = id_user),comentario, calificacion, fecha_registro from calificaciones where id_empresa = '$idempresa' and id_clasificacion = '1' 
    	and comentario NOT LIKE '%(GENERADO POR EL SISTEMA)%' order by id desc limit 1)";
		*/
		$sql = "(SELECT 'Sistema','' as 'Usuario',comentario as 'Comentario', calificacion as 'Calificacion', fecha_registro as 'Fecha' from calificaciones where id_empresa = '$idempresa' and id_clasificacion = '1' 
    	and comentario LIKE '%(GENERADO POR EL SISTEMA)%' order by id desc limit 2) UNION ALL (SELECT 'Supervisor',(SELECT username from users 
    		where users.id = id_user) as 'Usuario',comentario as 'Comentario', calificacion as 'Calificacion', fecha_registro as 'Fecha' from calificaciones where id_empresa = '$idempresa' and id_clasificacion = '1' 
    	and comentario NOT LIKE '%(GENERADO POR EL SISTEMA)%' order by id desc limit 1)";
    	return db::query(Database::SELECT, $sql)->execute();
    }
    public function listaprcalificaciones(){
          $sql="SELECT tb1.id_empresa,tb1.nombre_proponente, tb1.tipo, tb1.departamento, 
(CASE WHEN((SELECT calificacion from calificaciones where id_empresa = tb1.id_empresa and id_clasificacion = '1' and comentario LIKE '%PMAR (GENERADO POR EL SISTEMA)%' order by calificaciones.id desc limit 1) is null) then '0.00' else (SELECT calificacion from calificaciones where id_empresa = tb1.id_empresa and id_clasificacion = '1' and comentario LIKE '%PMAR (GENERADO POR EL SISTEMA)%' order by calificaciones.id desc limit 1) end) as 'PtsPMAR',
(CASE WHEN((SELECT calificacion from calificaciones where id_empresa = tb1.id_empresa and id_clasificacion = '1' and comentario LIKE '%Vivienda Nueva (GENERADO POR EL SISTEMA)%' order by calificaciones.id desc limit 1) is null) then '0.00' else (SELECT calificacion from calificaciones where id_empresa = tb1.id_empresa and id_clasificacion = '1' and comentario LIKE '%Vivienda Nueva (GENERADO POR EL SISTEMA)%' order by calificaciones.id desc limit 1) end) as 'PtsViviendaNueva',
(CASE WHEN((SELECT calificacion from calificaciones where id_empresa = tb1.id_empresa and id_clasificacion = '1' and comentario NOT LIKE '%(GENERADO POR EL SISTEMA)%' order by calificaciones.id desc limit 1) is null) then '0.00' else (SELECT calificacion from calificaciones where id_empresa = tb1.id_empresa and id_clasificacion = '1' and comentario NOT LIKE '%(GENERADO POR EL SISTEMA)%' order by calificaciones.id desc limit 1) end) as 'PtsSupervisor' 
from (SELECT calificaciones.id,calificaciones.id_empresa, empresas.nombre_proponente, 
    tipoclasificacion.tipo, 
    departamentos.departamento
FROM calificaciones INNER JOIN empresas ON calificaciones.id_empresa = empresas.id
     INNER JOIN tipoclasificacion ON empresas.tipo = tipoclasificacion.id
     INNER JOIN departamentos ON empresas.ciudad = departamentos.id where id_clasificacion = '1' group by nombre_proponente) as tb1";
           $calificaciones = array();
           $result = db::query(Database::SELECT, $sql)->execute();
           $i = 1;
           foreach ($result as $r) {                    
                        $calificaciones[$r['id_empresa']] = array(
                            'id_empresa' => $r['id_empresa'],
                            'nombre_proponente' => $r['nombre_proponente'],
                            'tipo' => $r['tipo'],
                            'departamento' => $r['departamento'],
                            'PtsPMAR' => $r['PtsPMAR'],
                            'PtsViviendaNueva' => $r['PtsViviendaNueva'],
                            'PtsSupervisor' => $r['PtsSupervisor'],
                            'suma'=>$i,                
                        );
                        $i++;
                    }
           return array_values($calificaciones); 
    }
    public function listaprcalificacionescons(){
          $sql="SELECT tb1.id_empresa,tb1.nombre_completo as 'nombre_proponente', tb1.tipo, tb1.procedencia as 'departamento', 
(CASE WHEN((SELECT calificacion from calificaciones where id_empresa = tb1.id_empresa and id_clasificacion = '3' and comentario LIKE '%PMAR (GENERADO POR EL SISTEMA)%' order by calificaciones.id desc limit 1) is null) then '0.00' else (SELECT calificacion from calificaciones where id_empresa = tb1.id_empresa and id_clasificacion = '3' and comentario LIKE '%PMAR (GENERADO POR EL SISTEMA)%' order by calificaciones.id desc limit 1) end) as 'PtsPMAR',
(CASE WHEN((SELECT calificacion from calificaciones where id_empresa = tb1.id_empresa and id_clasificacion = '3' and comentario LIKE '%Vivienda Nueva (GENERADO POR EL SISTEMA)%' order by calificaciones.id desc limit 1) is null) then '0.00' else (SELECT calificacion from calificaciones where id_empresa = tb1.id_empresa and id_clasificacion = '3' and comentario LIKE '%Vivienda Nueva (GENERADO POR EL SISTEMA)%' order by calificaciones.id desc limit 1) end) as 'PtsViviendaNueva',
(CASE WHEN((SELECT calificacion from calificaciones where id_empresa = tb1.id_empresa and id_clasificacion = '3' and comentario NOT LIKE '%(GENERADO POR EL SISTEMA)%' order by calificaciones.id desc limit 1) is null) then '0.00' else (SELECT calificacion from calificaciones where id_empresa = tb1.id_empresa and id_clasificacion = '3' and comentario NOT LIKE '%(GENERADO POR EL SISTEMA)%' order by calificaciones.id desc limit 1) end) as 'PtsSupervisor' 
from (SELECT calificaciones.id,calificaciones.id_empresa, consultores.nombre_completo, 
    tipoclasificacion.tipo, 
    consultores.procedencia
FROM calificaciones INNER JOIN consultores ON calificaciones.id_empresa = consultores.id
     INNER JOIN tipoclasificacion ON consultores.tipo = tipoclasificacion.id where id_clasificacion = '3' group by nombre_completo) as tb1";
           $calificaciones = array();
           $result = db::query(Database::SELECT, $sql)->execute();
           $i = 1;
           foreach ($result as $r) {                    
                        $calificaciones[$r['id_empresa']] = array(
                            'id_empresa' => $r['id_empresa'],
                            'nombre_proponente' => $r['nombre_proponente'],
                            'tipo' => $r['tipo'],
                            'departamento' => $r['departamento'],
                            'PtsPMAR' => $r['PtsPMAR'],
                            'PtsViviendaNueva' => $r['PtsViviendaNueva'],
                            'PtsSupervisor' => $r['PtsSupervisor'],
                            'suma'=>$i,                
                        );
                        $i++;
                    }
           return array_values($calificaciones); 
    }

}
?>
