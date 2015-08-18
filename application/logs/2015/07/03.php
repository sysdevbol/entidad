<?php defined('SYSPATH') or die('No direct script access.'); ?>

2015-07-03 08:45:04 --- ERROR: Kohana_View_Exception [ 0 ]: You must set the file to use within your view before rendering ~ SYSPATH/classes/kohana/view.php [ 355 ]
2015-07-03 09:05:54 --- ERROR: Database_Exception [ 0 ]: [1064] You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'ORDER BY e.id DESC' at line 8 ( SELECT e.id,e.id_entidad, e.contratante, e.objeto_contrato, e.ubicacion, e.monto_contrato, 
                date_format(e.fecha_ini_contrato,'%d/%m/%Y') as fecha_ini,
                date_format(e.fecha_fin_contrato,'%d/%m/%Y') as fecha_fin,
                e.porcentaje_asociacion, e.nombre_socios,t.tipo
                FROM experienciaentidad e
                INNER JOIN tipoexperiencia t ON e.tipo = t.id
                WHERE id_entidad = 
                ORDER BY e.id DESC ) ~ MODPATH/database/classes/kohana/database/mysql.php [ 181 ]
2015-07-03 09:06:05 --- ERROR: Database_Exception [ 0 ]: [1064] You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'ORDER BY e.id DESC' at line 8 ( SELECT e.id,e.id_entidad, e.contratante, e.objeto_contrato, e.ubicacion, e.monto_contrato, 
                date_format(e.fecha_ini_contrato,'%d/%m/%Y') as fecha_ini,
                date_format(e.fecha_fin_contrato,'%d/%m/%Y') as fecha_fin,
                e.porcentaje_asociacion, e.nombre_socios,t.tipo
                FROM experienciaentidad e
                INNER JOIN tipoexperiencia t ON e.tipo = t.id
                WHERE id_entidad = 
                ORDER BY e.id DESC ) ~ MODPATH/database/classes/kohana/database/mysql.php [ 181 ]
2015-07-03 09:07:36 --- ERROR: Database_Exception [ 0 ]: [1064] You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'ORDER BY e.id DESC' at line 8 ( SELECT e.id,e.id_entidad, e.contratante, e.objeto_contrato, e.ubicacion, e.monto_contrato, 
                date_format(e.fecha_ini_contrato,'%d/%m/%Y') as fecha_ini,
                date_format(e.fecha_fin_contrato,'%d/%m/%Y') as fecha_fin,
                e.porcentaje_asociacion, e.nombre_socios,t.tipo
                FROM experienciaentidad e
                INNER JOIN tipoexperiencia t ON e.tipo = t.id
                WHERE id_entidad = 
                ORDER BY e.id DESC ) ~ MODPATH/database/classes/kohana/database/mysql.php [ 181 ]
2015-07-03 09:31:37 --- ERROR: Database_Exception [ 0 ]: [1064] You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'ORDER BY s.porcentaje_participacion DESC' at line 5 ( SELECT s.id,s.id_empresa_acc as ide,s.id_empresa_socios as ides, e.nombre_proponente,e.matricula,s.porcentaje_participacion,s.lider
                FROM empresas e
                INNER JOIN sociosaccidental s ON e.id = s.id_empresa_socios
                WHERE s.id_empresa_acc = 
                ORDER BY s.porcentaje_participacion DESC ) ~ MODPATH/database/classes/kohana/database/mysql.php [ 181 ]
2015-07-03 09:31:48 --- ERROR: Database_Exception [ 0 ]: [1064] You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'ORDER BY s.porcentaje_participacion DESC' at line 5 ( SELECT s.id,s.id_empresa_acc as ide,s.id_empresa_socios as ides, e.nombre_proponente,e.matricula,s.porcentaje_participacion,s.lider
                FROM empresas e
                INNER JOIN sociosaccidental s ON e.id = s.id_empresa_socios
                WHERE s.id_empresa_acc = 
                ORDER BY s.porcentaje_participacion DESC ) ~ MODPATH/database/classes/kohana/database/mysql.php [ 181 ]
2015-07-03 09:32:43 --- ERROR: Database_Exception [ 0 ]: [1064] You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'ORDER BY s.porcentaje_participacion DESC' at line 5 ( SELECT s.id,s.id_empresa_acc as ide,s.id_empresa_socios as ides, e.nombre_proponente,e.matricula,s.porcentaje_participacion,s.lider
                FROM empresas e
                INNER JOIN sociosaccidental s ON e.id = s.id_empresa_socios
                WHERE s.id_empresa_acc = 
                ORDER BY s.porcentaje_participacion DESC ) ~ MODPATH/database/classes/kohana/database/mysql.php [ 181 ]
2015-07-03 15:38:38 --- ERROR: Database_Exception [ 0 ]: []  ~ MODPATH/database/classes/kohana/database/mysql.php [ 96 ]