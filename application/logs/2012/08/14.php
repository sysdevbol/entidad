<?php defined('SYSPATH') or die('No direct script access.'); ?>

2012-08-14 09:48:59 --- ERROR: Database_Exception [ 0 ]: [1064] You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ')' at line 5 ( SELECT s.nur, s.a_oficina,s.nombre_receptor,cargo_receptor,s.fecha_emision,s.oficial,d.cite_original, d.referencia,s.proveido FROM seguimiento s 
    INNER JOIN nurs_documentos n ON s.nur=n.nur
    INNER JOIN documentos d ON n.id_documento=d.id
    WHERE d.original='1'
    AND  s.id IN) ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2012-08-14 10:16:03 --- ERROR: Kohana_View_Exception [ 0 ]: The requested view admin/error.php could not be found ~ SYSPATH\classes\kohana\view.php [ 268 ]