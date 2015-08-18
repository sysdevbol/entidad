<?php defined('SYSPATH') or die('No direct script access.'); ?>

2015-06-25 15:48:33 --- ERROR: Database_Exception [ 0 ]: [1062] Duplicate entry 'cflores@aevivienda.gob.bo' for key 'uniq_username' ( INSERT INTO `users` (`username`, `password`, `nombre`, `email`, `nivel`) VALUES ('cflores@aevivienda.gob.bo', '8cc23d8f1be2c46ccf75307d858e24f4223bba7391431631e986e8d27796d7b7', 'CRISTHIAN MARCELOI FLORES LOPEZ', 'cflores@aevivienda.gob.bo', 2) ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2015-06-25 16:55:58 --- ERROR: Database_Exception [ 0 ]: [1064] You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '' at line 3 ( SELECT e.*,COUNT(*) as resultado
                FROM empresas e
                WHERE e.id =  ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]