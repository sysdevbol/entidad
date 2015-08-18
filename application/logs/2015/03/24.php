<?php defined('SYSPATH') or die('No direct script access.'); ?>

2015-03-24 17:14:28 --- ERROR: Database_Exception [ 0 ]: [1064] You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'NULL' at line 1 ( SELECT `departamentos`.* FROM `departamentos` WHERE `id` IN NULL ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2015-03-24 20:25:44 --- ERROR: Database_Exception [ 0 ]: [1064] You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'AND' at line 6 ( SELECT d.id,t.detalle as tipo, o.oficina,d.objeto, DATE_FORMAT(d.fecha_generado, '%d/%m/%Y') as emision,e.etapa, u.nombre as responsable
                FROM desembolsos d
                INNER JOIN etapas e ON d.estado = e.id
                INNER JOIN tipoplanillas t ON d.tipo_planilla = t.id
                INNER JOIN users u ON d.id_user = u.id
                INNER JOIN oficinas o ON u.id_oficina = o.id WHERE o.id = AND  ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2015-03-24 20:26:11 --- ERROR: Database_Exception [ 0 ]: [1064] You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'AND' at line 6 ( SELECT d.id,t.detalle as tipo, o.oficina,d.objeto, DATE_FORMAT(d.fecha_generado, '%d/%m/%Y') as emision,e.etapa, u.nombre as responsable
                FROM desembolsos d
                INNER JOIN etapas e ON d.estado = e.id
                INNER JOIN tipoplanillas t ON d.tipo_planilla = t.id
                INNER JOIN users u ON d.id_user = u.id
                INNER JOIN oficinas o ON u.id_oficina = o.id WHERE o.id = AND  ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2015-03-24 20:28:27 --- ERROR: Database_Exception [ 0 ]: [1064] You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'fecha_generado BETWEEN '2015-03-24' AND '2015-03-24'' at line 6 ( SELECT d.id,t.detalle as tipo, o.oficina,d.objeto, DATE_FORMAT(d.fecha_generado, '%d/%m/%Y') as emision,e.etapa, u.nombre as responsable
                FROM desembolsos d
                INNER JOIN etapas e ON d.estado = e.id
                INNER JOIN tipoplanillas t ON d.tipo_planilla = t.id
                INNER JOIN users u ON d.id_user = u.id
                INNER JOIN oficinas o ON u.id_oficina = o.id WHERE o.id = 102AND fecha_generado BETWEEN '2015-03-24' AND '2015-03-24' ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2015-03-24 20:30:46 --- ERROR: Database_Exception [ 0 ]: [1064] You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '' at line 6 ( SELECT d.id,t.detalle as tipo, o.oficina,d.objeto, DATE_FORMAT(d.fecha_generado, '%d/%m/%Y') as emision,e.etapa, u.nombre as responsable
                FROM desembolsos d
                INNER JOIN etapas e ON d.estado = e.id
                INNER JOIN tipoplanillas t ON d.tipo_planilla = t.id
                INNER JOIN users u ON d.id_user = u.id
                INNER JOIN oficinas o ON u.id_oficina = o.id WHERE o.id = 82 AND  ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]