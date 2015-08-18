<?php defined('SYSPATH') or die('No direct script access.'); ?>

2015-07-19 16:10:48 --- ERROR: Kohana_View_Exception [ 0 ]: You must set the file to use within your view before rendering ~ SYSPATH/classes/kohana/view.php [ 355 ]
2015-07-19 16:10:58 --- ERROR: Database_Exception [ 0 ]: [1064] You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'ORDER BY s.porcentaje_participacion DESC' at line 5 ( SELECT s.id,s.id_empresa_acc as ide,s.id_empresa_socios as ides, e.nombre_proponente,e.matricula,s.porcentaje_participacion,s.lider
                FROM empresas e
                INNER JOIN sociosaccidental s ON e.id = s.id_empresa_socios
                WHERE s.id_empresa_acc = 
                ORDER BY s.porcentaje_participacion DESC ) ~ MODPATH/database/classes/kohana/database/mysql.php [ 181 ]