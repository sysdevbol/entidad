<?php defined('SYSPATH') or die('No direct script access.'); ?>

2015-06-26 10:25:26 --- ERROR: Kohana_Exception [ 0 ]: View variable is not set: errors ~ SYSPATH\classes\kohana\view.php [ 171 ]
2015-06-26 10:29:48 --- ERROR: Kohana_View_Exception [ 0 ]: The requested view registroempresas/selecciontipo.php could not be found ~ SYSPATH\classes\kohana\view.php [ 268 ]
2015-06-26 10:30:24 --- ERROR: Kohana_View_Exception [ 0 ]: The requested view registroempresas/seleccionar_tipo.php could not be found ~ SYSPATH\classes\kohana\view.php [ 268 ]
2015-06-26 10:31:19 --- ERROR: Kohana_Exception [ 0 ]: View variable is not set: errors ~ SYSPATH\classes\kohana\view.php [ 171 ]
2015-06-26 10:33:48 --- ERROR: Kohana_Exception [ 0 ]: View variable is not set: errors ~ SYSPATH\classes\kohana\view.php [ 171 ]
2015-06-26 10:35:57 --- ERROR: Kohana_Exception [ 0 ]: View variable is not set: errors ~ SYSPATH\classes\kohana\view.php [ 171 ]
2015-06-26 11:50:43 --- ERROR: Database_Exception [ 0 ]: [1064] You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '?w?F??' at line 3 ( SELECT e.*,COUNT(*) as resultado
                FROM empresas e
                WHERE e.id = ãwåF­¥ ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2015-06-26 11:51:25 --- ERROR: Database_Exception [ 0 ]: [1300] Invalid utf8 character string: '\xF0' ( SELECT e.*,COUNT(*) as resultado
                FROM empresas e
                WHERE e.id = ð½Í‚V” ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2015-06-26 12:30:16 --- ERROR: Database_Exception [ 0 ]: [1064] You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '' at line 3 ( SELECT e.*,COUNT(*) as resultado
                FROM empresas e
                WHERE e.id =  ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2015-06-26 12:30:47 --- ERROR: Database_Exception [ 0 ]: [1064] You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '' at line 3 ( SELECT e.*,COUNT(*) as resultado
                FROM empresas e
                WHERE e.id =  ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2015-06-26 12:48:29 --- ERROR: Kohana_View_Exception [ 0 ]: The requested view sipago/index.php could not be found ~ SYSPATH\classes\kohana\view.php [ 268 ]
2015-06-26 12:51:30 --- ERROR: Database_Exception [ 0 ]: [1062] Duplicate entry 'parametrica@hotmail.com' for key 'uniq_username' ( INSERT INTO `users` (`username`, `password`, `nombre`, `email`, `nivel`) VALUES ('parametrica@hotmail.com', 'b3841a834ca48bd82dd4c64860fff00e84edf416170a8d065fdca0c8d465aa5e', 'PARAMETRICA S.R.L.', 'parametrica@hotmail.com', 2) ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]