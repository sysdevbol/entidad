<?php defined('SYSPATH') or die('No direct script access.'); ?>

2015-04-30 11:00:46 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 'd.user_id' in 'where clause' ( SELECT tp.detalle,tp.id as idtipo,e.etapa,DATE_FORMAT(d.fecha_generado,'%d/%m/%Y') as fechagenerado,DATE_FORMAT(d.fecha_banco,'%d/%m/%Y') as fechabanco,d.* 
                FROM desembolsos d
                INNER JOIN tipoplanillas tp ON d.tipo_planilla = tp.id
                INNER JOIN etapas e ON d.estado = e.id
                WHERE tp.id_tipo = 4
                 AND d.user_id =119 
                ORDER BY d.id DESC ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2015-04-30 15:25:59 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 'd.user_id' in 'where clause' ( SELECT tp.detalle,tp.id as idtipo,e.etapa,DATE_FORMAT(d.fecha_generado,'%d/%m/%Y') as fechagenerado,DATE_FORMAT(d.fecha_banco,'%d/%m/%Y') as fechabanco,d.* 
                FROM desembolsos d
                INNER JOIN tipoplanillas tp ON d.tipo_planilla = tp.id
                INNER JOIN etapas e ON d.estado = e.id
                WHERE tp.id_tipo = 4
                 AND d.user_id =119 
                ORDER BY d.id DESC ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2015-04-30 15:26:06 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 'd.user_id' in 'where clause' ( SELECT tp.detalle,tp.id as idtipo,e.etapa,DATE_FORMAT(d.fecha_generado,'%d/%m/%Y') as fechagenerado,DATE_FORMAT(d.fecha_banco,'%d/%m/%Y') as fechabanco,d.* 
                FROM desembolsos d
                INNER JOIN tipoplanillas tp ON d.tipo_planilla = tp.id
                INNER JOIN etapas e ON d.estado = e.id
                WHERE tp.id_tipo = 4
                 AND d.user_id =119 
                ORDER BY d.id DESC ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2015-04-30 15:26:21 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 'd.user_id' in 'where clause' ( SELECT tp.detalle,tp.id as idtipo,e.etapa,DATE_FORMAT(d.fecha_generado,'%d/%m/%Y') as fechagenerado,DATE_FORMAT(d.fecha_banco,'%d/%m/%Y') as fechabanco,d.* 
                FROM desembolsos d
                INNER JOIN tipoplanillas tp ON d.tipo_planilla = tp.id
                INNER JOIN etapas e ON d.estado = e.id
                WHERE tp.id_tipo = 4
                 AND d.user_id =119 
                ORDER BY d.id DESC ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]