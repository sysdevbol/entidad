<?php defined('SYSPATH') or die('No direct script access.'); ?>

2014-09-23 17:54:46 --- ERROR: Database_Exception [ 0 ]: [1064] You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 's%'
        or nur like '%AFP's%'
        or referencia like '%AFP's%' ) as x
  ' at line 3 ( SELECT COUNT(*) as count FROM documentos d,
        ( SELECT id  FROM documentos
        WHERE cite_original like '%AFP's%'
        or nur like '%AFP's%'
        or referencia like '%AFP's%' ) as x
        WHERE x.id=d.id
        and d.id_entidad='13' ) ~ MODPATH/database/classes/kohana/database/mysql.php [ 181 ]