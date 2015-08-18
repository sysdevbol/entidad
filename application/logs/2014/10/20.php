<?php defined('SYSPATH') or die('No direct script access.'); ?>

2014-10-20 10:24:22 --- ERROR: Kohana_Exception [ 0 ]: Cannot delete destinatarios model because it is not loaded. ~ MODPATH/orm/classes/kohana/orm.php [ 1383 ]
2014-10-20 10:24:22 --- ERROR: Kohana_Exception [ 0 ]: Cannot delete destinatarios model because it is not loaded. ~ MODPATH/orm/classes/kohana/orm.php [ 1383 ]
2014-10-20 10:24:30 --- ERROR: Kohana_Exception [ 0 ]: Cannot delete destinatarios model because it is not loaded. ~ MODPATH/orm/classes/kohana/orm.php [ 1383 ]
2014-10-20 14:23:08 --- ERROR: Database_Exception [ 0 ]: [1064] You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'i-2014-01507'%'
        or nur like '%'i-2014-01507'%'
        or referencia lik' at line 3 ( SELECT COUNT(*) as count FROM documentos d,
        ( SELECT id  FROM documentos
        WHERE cite_original like '%'i-2014-01507'%'
        or nur like '%'i-2014-01507'%'
        or referencia like '%'i-2014-01507'%' ) as x
        WHERE x.id=d.id
        and d.id_entidad='13' ) ~ MODPATH/database/classes/kohana/database/mysql.php [ 181 ]
2014-10-20 20:50:58 --- ERROR: Database_Exception [ 0 ]: [1065] Query was empty (  ) ~ MODPATH/database/classes/kohana/database/mysql.php [ 181 ]