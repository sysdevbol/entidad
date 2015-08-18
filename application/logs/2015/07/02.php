<?php defined('SYSPATH') or die('No direct script access.'); ?>

2015-07-02 14:08:34 --- ERROR: Database_Exception [ 0 ]: [1064] You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '@aevivienda.gob.bo' at line 6 ( SELECT id,id_entidad, contratante, objeto_contrato, ubicacion, monto_contrato, 
                date_format(fecha_ini_contrato,'%d/%m/%Y') as fecha_ini,
                date_format(fecha_fin_contrato,'%d/%m/%Y') as fecha_fin,
                porcentaje_asociacion, nombre_socios
                FROM experienciaentidad
                WHERE id_entidad = cflores@aevivienda.gob.bo ) ~ MODPATH/database/classes/kohana/database/mysql.php [ 181 ]
2015-07-02 14:12:27 --- ERROR: Database_Exception [ 0 ]: [1064] You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '@aevivienda.gob.bo' at line 6 ( SELECT id,id_entidad, contratante, objeto_contrato, ubicacion, monto_contrato, 
                date_format(fecha_ini_contrato,'%d/%m/%Y') as fecha_ini,
                date_format(fecha_fin_contrato,'%d/%m/%Y') as fecha_fin,
                porcentaje_asociacion, nombre_socios
                FROM experienciaentidad
                WHERE id_entidad = cflores@aevivienda.gob.bo ) ~ MODPATH/database/classes/kohana/database/mysql.php [ 181 ]
2015-07-02 14:53:33 --- ERROR: Database_Exception [ 0 ]: [1064] You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '.fecha_ini,
                date_format(fecha_fin_contrato,'%d/%m/%Y') as e.fec' at line 2 ( SELECT e.id,e.id_entidad, e.contratante, e.objeto_contrato, e.ubicacion, e.monto_contrato, 
                date_format(fecha_ini_contrato,'%d/%m/%Y') as e.fecha_ini,
                date_format(fecha_fin_contrato,'%d/%m/%Y') as e.fecha_fin,
                e.porcentaje_asociacion, e.nombre_socios,t.tipo
                FROM experienciaentidad e
                INNER JOIN tipoexperiencia t ON e.tipo = t.id
                WHERE id_entidad = 439 ) ~ MODPATH/database/classes/kohana/database/mysql.php [ 181 ]
2015-07-02 15:02:59 --- ERROR: Database_Exception [ 0 ]: [1064] You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '' at line 7 ( SELECT e.id,e.id_entidad, e.contratante, e.objeto_contrato, e.ubicacion, e.monto_contrato, 
                date_format(e.fecha_ini_contrato,'%d/%m/%Y') as fecha_ini,
                date_format(e.fecha_fin_contrato,'%d/%m/%Y') as fecha_fin,
                e.porcentaje_asociacion, e.nombre_socios,t.tipo
                FROM experienciaentidad e
                INNER JOIN tipoexperiencia t ON e.tipo = t.id
                WHERE id_entidad =  ) ~ MODPATH/database/classes/kohana/database/mysql.php [ 181 ]
2015-07-02 15:43:22 --- ERROR: Kohana_View_Exception [ 0 ]: The requested view .php could not be found ~ SYSPATH/classes/kohana/view.php [ 268 ]
2015-07-02 15:46:05 --- ERROR: Kohana_View_Exception [ 0 ]: The requested view .php could not be found ~ SYSPATH/classes/kohana/view.php [ 268 ]
2015-07-02 15:48:37 --- ERROR: Kohana_View_Exception [ 0 ]: The requested view .php could not be found ~ SYSPATH/classes/kohana/view.php [ 268 ]
2015-07-02 19:28:09 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 't.tipo' in 'field list' ( SELECT e.id,e.id_entidad, e.contratante, e.objeto_contrato, e.ubicacion, e.monto_contrato, 
                date_format(e.fecha_ini_contrato,'%d/%m/%Y') as fecha_ini,
                date_format(e.fecha_fin_contrato,'%d/%m/%Y') as fecha_fin,
                e.porcentaje_asociacion, e.nombre_socios,t.tipo
                FROM experienciaentidad e
                WHERE e.id = 249 ) ~ MODPATH/database/classes/kohana/database/mysql.php [ 181 ]
2015-07-02 20:39:19 --- ERROR: Kohana_View_Exception [ 0 ]: The requested view seguimiento/datosgenerales.php could not be found ~ SYSPATH/classes/kohana/view.php [ 268 ]
2015-07-02 20:40:46 --- ERROR: Kohana_View_Exception [ 0 ]: The requested view seguimiento/datosgenerales.php could not be found ~ SYSPATH/classes/kohana/view.php [ 268 ]