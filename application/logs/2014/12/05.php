<?php defined('SYSPATH') or die('No direct script access.'); ?>

2014-12-05 19:18:22 --- ERROR: Database_Exception [ 0 ]: [1267] Illegal mix of collations (latin1_swedish_ci,IMPLICIT) and (utf8_general_ci,COERCIBLE) for operation '=' ( SELECT `documentos`.* FROM `documentos` WHERE `cite_original` = 'NOT/AEV/URH Nº 0030/2014' LIMIT 1 ) ~ MODPATH/database/classes/kohana/database/mysql.php [ 181 ]
2014-12-05 19:30:55 --- ERROR: Kohana_Exception [ 0 ]: Cannot delete archivados model because it is not loaded. ~ MODPATH/orm/classes/kohana/orm.php [ 1383 ]