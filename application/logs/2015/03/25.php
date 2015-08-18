<?php defined('SYSPATH') or die('No direct script access.'); ?>

2015-03-25 11:55:48 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 'o.departamento' in 'field list' ( SELECT o.departamento 
                FROM users u
                INNER JOIN oficinas o ON u.id_oficina = o.id
                WHERE u.id = 127 ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]