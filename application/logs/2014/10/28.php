<?php defined('SYSPATH') or die('No direct script access.'); ?>

2014-10-28 19:12:03 --- ERROR: Database_Exception [ 0 ]: [1267] Illegal mix of collations (latin1_swedish_ci,IMPLICIT) and (utf8_general_ci,COERCIBLE) for operation '=' ( SELECT `documentos`.* FROM `documentos` WHERE `cite_original` = 'INF/AEV/DIR.LPZ N� 0047/2014' LIMIT 1 ) ~ MODPATH/database/classes/kohana/database/mysql.php [ 181 ]