<?php defined('SYSPATH') or die('No direct script access.'); ?>

2015-07-10 11:01:18 --- ERROR: Kohana_Exception [ 0 ]: The fecha_nacimiento property does not exist in the Model_Consultores class ~ MODPATH/orm/classes/kohana/orm.php [ 746 ]
2015-07-10 11:12:35 --- ERROR: Kohana_Exception [ 0 ]: The fecha_nacimiento property does not exist in the Model_Consultores class ~ MODPATH/orm/classes/kohana/orm.php [ 746 ]
2015-07-10 11:12:39 --- ERROR: Kohana_Exception [ 0 ]: The fecha_nacimiento property does not exist in the Model_Consultores class ~ MODPATH/orm/classes/kohana/orm.php [ 746 ]
2015-07-10 11:23:41 --- ERROR: Kohana_Exception [ 0 ]: The fecha_nacimiento property does not exist in the Model_Consultores class ~ MODPATH/orm/classes/kohana/orm.php [ 746 ]
2015-07-10 17:11:28 --- ERROR: Database_Exception [ 0 ]: [1062] Duplicate entry 'alfredo_astu@hotmail.com' for key 'uniq_username' ( INSERT INTO `users` (`username`, `password`, `nombre`, `email`, `nivel`) VALUES ('alfredo_astu@hotmail.com', '3dc525f537f722068e0da80131c41ded42211eedf5160f6493fb218333900f72', 'Alfredo Asturizaga Elena', 'alfredo_astu@hotmail.com', 2) ) ~ MODPATH/database/classes/kohana/database/mysql.php [ 181 ]
2015-07-10 17:38:03 --- ERROR: Database_Exception [ 0 ]: [1064] You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '' at line 3 ( SELECT e.*,COUNT(*) as resultado
                FROM consultores e
                WHERE e.id =  ) ~ MODPATH/database/classes/kohana/database/mysql.php [ 181 ]
2015-07-10 17:49:20 --- ERROR: Database_Exception [ 0 ]: [1062] Duplicate entry '1criscor@gmail.com' for key 'uniq_email' ( INSERT INTO `users` (`username`, `password`, `nombre`, `email`, `nivel`) VALUES ('1criscor@gmail.com', '8beb212314b8d44f1ef9682272c75f113f5c6a6bda98dd30946c387b88f3c213', 'nilstes1', '1criscor@gmail.com', 7) ) ~ MODPATH/database/classes/kohana/database/mysql.php [ 181 ]
2015-07-10 18:35:10 --- ERROR: Kohana_View_Exception [ 0 ]: You must set the file to use within your view before rendering ~ SYSPATH/classes/kohana/view.php [ 355 ]