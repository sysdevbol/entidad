<?php defined('SYSPATH') or die('No direct script access.'); ?>

2015-04-07 12:17:55 --- ERROR: Database_Exception [ 0 ]: [1064] You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near ''6,1,2,3,7,8'' at line 1 ( SELECT `etapas`.* FROM `etapas` WHERE `id` IN '6,1,2,3,7,8' ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2015-04-07 12:19:27 --- ERROR: Kohana_Exception [ 0 ]: The modalidad property does not exist in the Model_Etapas class ~ MODPATH\orm\classes\kohana\orm.php [ 682 ]
2015-04-07 12:25:45 --- ERROR: Database_Exception [ 0 ]: [1146] Table 'sipago.tipos' doesn't exist ( SHOW FULL COLUMNS FROM `tipos` ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]