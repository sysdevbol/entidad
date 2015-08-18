<?php defined('SYSPATH') or die('No direct script access.'); ?>

2015-05-19 19:15:11 --- ERROR: Database_Exception [ 0 ]: [1064] You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '' at line 4 ( SELECT o.departamento 
                FROM users u
                INNER JOIN oficinas o ON u.id_oficina = o.id
                WHERE u.id =  ) ~ MODPATH/database/classes/kohana/database/mysql.php [ 181 ]
2015-05-19 19:15:40 --- ERROR: Database_Exception [ 0 ]: [1064] You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '' at line 4 ( SELECT o.departamento 
                FROM users u
                INNER JOIN oficinas o ON u.id_oficina = o.id
                WHERE u.id =  ) ~ MODPATH/database/classes/kohana/database/mysql.php [ 181 ]