<?php defined('SYSPATH') or die('No direct script access.'); ?>

2015-07-20 11:59:09 --- ERROR: Kohana_View_Exception [ 0 ]: You must set the file to use within your view before rendering ~ SYSPATH/classes/kohana/view.php [ 355 ]
2015-07-20 11:59:21 --- ERROR: Kohana_View_Exception [ 0 ]: You must set the file to use within your view before rendering ~ SYSPATH/classes/kohana/view.php [ 355 ]
2015-07-20 11:59:25 --- ERROR: Database_Exception [ 0 ]: [1064] You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'ORDER BY s.porcentaje_participacion DESC' at line 5 ( SELECT s.id,s.id_empresa_acc as ide,s.id_empresa_socios as ides, e.nombre_proponente,e.matricula,s.porcentaje_participacion,s.lider
                FROM empresas e
                INNER JOIN sociosaccidental s ON e.id = s.id_empresa_socios
                WHERE s.id_empresa_acc = 
                ORDER BY s.porcentaje_participacion DESC ) ~ MODPATH/database/classes/kohana/database/mysql.php [ 181 ]
2015-07-20 12:33:42 --- ERROR: Database_Exception [ 0 ]: [1062] Duplicate entry 'tejerina_y_torrez_srl@hotmail.com' for key 'uniq_username' ( INSERT INTO `users` (`username`, `password`, `nombre`, `email`, `nivel`) VALUES ('tejerina_y_torrez_srl@hotmail.com', '151aecc78f8f183b59fdd6d637f5aecef4c529c2ced061642ad267385b813b7e', 'TEJERINA Y TORREZ SRL', 'tejerina_y_torrez_srl@hotmail.com', 2) ) ~ MODPATH/database/classes/kohana/database/mysql.php [ 181 ]
2015-07-20 12:33:55 --- ERROR: Database_Exception [ 0 ]: [1062] Duplicate entry 'tejerina_y_torrez_srl@hotmail.com' for key 'uniq_username' ( INSERT INTO `users` (`username`, `password`, `nombre`, `email`, `nivel`) VALUES ('tejerina_y_torrez_srl@hotmail.com', '3fcfe975e1f083872f52850f62669154ebbc0f5beaa0105ba15cb95dafd4fd47', 'TEJERINA Y TORREZ SRL', 'tejerina_y_torrez_srl@hotmail.com', 2) ) ~ MODPATH/database/classes/kohana/database/mysql.php [ 181 ]
2015-07-20 12:34:41 --- ERROR: Database_Exception [ 0 ]: [1062] Duplicate entry 'tejerina_y_torrez_srl@hotmail.com' for key 'uniq_username' ( INSERT INTO `users` (`username`, `password`, `nombre`, `email`, `nivel`) VALUES ('tejerina_y_torrez_srl@hotmail.com', '556aa89fd3d7f343de54fc9b0d7c59e79e9d06c399519ee93a9c77f4424280dd', 'TEJERINA Y TORREZ SRL', 'tejerina_y_torrez_srl@hotmail.com', 2) ) ~ MODPATH/database/classes/kohana/database/mysql.php [ 181 ]
2015-07-20 12:35:20 --- ERROR: Database_Exception [ 0 ]: [1062] Duplicate entry 'tejerina_y_torrez_srl@hotmail.com' for key 'uniq_username' ( INSERT INTO `users` (`username`, `password`, `nombre`, `email`, `nivel`) VALUES ('tejerina_y_torrez_srl@hotmail.com', '45cf5b6c49ab5f8ef739d8435c73857353e863c8a079372210f052fe86cf34f2', 'TEJERINA Y TORREZ SRL', 'tejerina_y_torrez_srl@hotmail.com', 2) ) ~ MODPATH/database/classes/kohana/database/mysql.php [ 181 ]
2015-07-20 12:38:03 --- ERROR: Database_Exception [ 0 ]: [1062] Duplicate entry 'tejerina_y_torrez_srl@hotmail.com' for key 'uniq_username' ( INSERT INTO `users` (`username`, `password`, `nombre`, `email`, `nivel`) VALUES ('tejerina_y_torrez_srl@hotmail.com', 'e66d44e88d9698cb30e131e1786e82d6f8631efe5459f028f800f593ce6f68b8', 'TEJERINA Y TORREZ SRL', 'tejerina_y_torrez_srl@hotmail.com', 2) ) ~ MODPATH/database/classes/kohana/database/mysql.php [ 181 ]
2015-07-20 12:39:51 --- ERROR: Database_Exception [ 0 ]: [1062] Duplicate entry 'tejerina_y_torrez_srl@hotmail.com' for key 'uniq_username' ( INSERT INTO `users` (`username`, `password`, `nombre`, `email`, `nivel`) VALUES ('tejerina_y_torrez_srl@hotmail.com', '6417a035bbb5f475bb9179af16ce3f5ca4358aa7bf51706236249c5fc74a880b', 'TEJERINA Y TORREZ SRL', 'tejerina_y_torrez_srl@hotmail.com', 2) ) ~ MODPATH/database/classes/kohana/database/mysql.php [ 181 ]
2015-07-20 15:41:57 --- ERROR: Kohana_View_Exception [ 0 ]: You must set the file to use within your view before rendering ~ SYSPATH/classes/kohana/view.php [ 355 ]
2015-07-20 15:42:12 --- ERROR: Database_Exception [ 0 ]: [1064] You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'ORDER BY s.porcentaje_participacion DESC' at line 5 ( SELECT s.id,s.id_empresa_acc as ide,s.id_empresa_socios as ides, e.nombre_proponente,e.matricula,s.porcentaje_participacion,s.lider
                FROM empresas e
                INNER JOIN sociosaccidental s ON e.id = s.id_empresa_socios
                WHERE s.id_empresa_acc = 
                ORDER BY s.porcentaje_participacion DESC ) ~ MODPATH/database/classes/kohana/database/mysql.php [ 181 ]
2015-07-20 15:43:56 --- ERROR: Kohana_View_Exception [ 0 ]: You must set the file to use within your view before rendering ~ SYSPATH/classes/kohana/view.php [ 355 ]
2015-07-20 16:03:07 --- ERROR: Kohana_View_Exception [ 0 ]: You must set the file to use within your view before rendering ~ SYSPATH/classes/kohana/view.php [ 355 ]
2015-07-20 16:04:38 --- ERROR: Kohana_View_Exception [ 0 ]: You must set the file to use within your view before rendering ~ SYSPATH/classes/kohana/view.php [ 355 ]
2015-07-20 16:04:46 --- ERROR: Kohana_View_Exception [ 0 ]: You must set the file to use within your view before rendering ~ SYSPATH/classes/kohana/view.php [ 355 ]
2015-07-20 16:04:55 --- ERROR: Kohana_View_Exception [ 0 ]: You must set the file to use within your view before rendering ~ SYSPATH/classes/kohana/view.php [ 355 ]
2015-07-20 16:04:58 --- ERROR: Database_Exception [ 0 ]: [1064] You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'ORDER BY s.porcentaje_participacion DESC' at line 5 ( SELECT s.id,s.id_empresa_acc as ide,s.id_empresa_socios as ides, e.nombre_proponente,e.matricula,s.porcentaje_participacion,s.lider
                FROM empresas e
                INNER JOIN sociosaccidental s ON e.id = s.id_empresa_socios
                WHERE s.id_empresa_acc = 
                ORDER BY s.porcentaje_participacion DESC ) ~ MODPATH/database/classes/kohana/database/mysql.php [ 181 ]
2015-07-20 16:05:00 --- ERROR: Kohana_View_Exception [ 0 ]: You must set the file to use within your view before rendering ~ SYSPATH/classes/kohana/view.php [ 355 ]
2015-07-20 16:05:26 --- ERROR: Kohana_View_Exception [ 0 ]: You must set the file to use within your view before rendering ~ SYSPATH/classes/kohana/view.php [ 355 ]
2015-07-20 16:05:39 --- ERROR: Database_Exception [ 0 ]: [1064] You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'ORDER BY s.porcentaje_participacion DESC' at line 5 ( SELECT s.id,s.id_empresa_acc as ide,s.id_empresa_socios as ides, e.nombre_proponente,e.matricula,s.porcentaje_participacion,s.lider
                FROM empresas e
                INNER JOIN sociosaccidental s ON e.id = s.id_empresa_socios
                WHERE s.id_empresa_acc = 
                ORDER BY s.porcentaje_participacion DESC ) ~ MODPATH/database/classes/kohana/database/mysql.php [ 181 ]
2015-07-20 16:05:45 --- ERROR: Kohana_View_Exception [ 0 ]: You must set the file to use within your view before rendering ~ SYSPATH/classes/kohana/view.php [ 355 ]
2015-07-20 16:08:22 --- ERROR: Kohana_View_Exception [ 0 ]: You must set the file to use within your view before rendering ~ SYSPATH/classes/kohana/view.php [ 355 ]
2015-07-20 16:08:33 --- ERROR: Kohana_View_Exception [ 0 ]: You must set the file to use within your view before rendering ~ SYSPATH/classes/kohana/view.php [ 355 ]
2015-07-20 16:09:00 --- ERROR: Kohana_View_Exception [ 0 ]: You must set the file to use within your view before rendering ~ SYSPATH/classes/kohana/view.php [ 355 ]
2015-07-20 16:09:19 --- ERROR: Kohana_View_Exception [ 0 ]: You must set the file to use within your view before rendering ~ SYSPATH/classes/kohana/view.php [ 355 ]
2015-07-20 16:09:23 --- ERROR: Database_Exception [ 0 ]: [1064] You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'ORDER BY s.porcentaje_participacion DESC' at line 5 ( SELECT s.id,s.id_empresa_acc as ide,s.id_empresa_socios as ides, e.nombre_proponente,e.matricula,s.porcentaje_participacion,s.lider
                FROM empresas e
                INNER JOIN sociosaccidental s ON e.id = s.id_empresa_socios
                WHERE s.id_empresa_acc = 
                ORDER BY s.porcentaje_participacion DESC ) ~ MODPATH/database/classes/kohana/database/mysql.php [ 181 ]
2015-07-20 16:09:24 --- ERROR: Kohana_View_Exception [ 0 ]: You must set the file to use within your view before rendering ~ SYSPATH/classes/kohana/view.php [ 355 ]
2015-07-20 16:21:21 --- ERROR: Kohana_View_Exception [ 0 ]: You must set the file to use within your view before rendering ~ SYSPATH/classes/kohana/view.php [ 355 ]
2015-07-20 16:29:21 --- ERROR: Database_Exception [ 0 ]: [1062] Duplicate entry 'maomclva@hotmail.com' for key 'uniq_username' ( INSERT INTO `users` (`username`, `password`, `nombre`, `email`, `nivel`) VALUES ('maomclva@hotmail.com', '22051e39702fd7134d210eeae9a3c05b783af22eac196bf86d1a2ad3e16dadfe', 'CONSTRUCTORA CLAROSVA', 'maomclva@hotmail.com', 2) ) ~ MODPATH/database/classes/kohana/database/mysql.php [ 181 ]
2015-07-20 17:59:45 --- ERROR: Kohana_Exception [ 0 ]: Invalid method pinsocio called in Model_Empresas ~ MODPATH/orm/classes/kohana/orm.php [ 606 ]
2015-07-20 17:59:58 --- ERROR: Kohana_Exception [ 0 ]: Invalid method pinsocio called in Model_Empresas ~ MODPATH/orm/classes/kohana/orm.php [ 606 ]
2015-07-20 18:01:20 --- ERROR: Kohana_Exception [ 0 ]: Invalid method pinsocio called in Model_Empresas ~ MODPATH/orm/classes/kohana/orm.php [ 606 ]
2015-07-20 22:38:55 --- ERROR: Database_Exception [ 0 ]: [1062] Duplicate entry 'bazoluis@hotmail.com' for key 'uniq_username' ( INSERT INTO `users` (`username`, `password`, `nombre`, `email`, `nivel`) VALUES ('bazoluis@hotmail.com', '086f7de4dd2001e83e5f681282476ff7e65beb29ddfc882ba86ef8d5a52b1e9d', 'EMPRESA CONSTRUCTORA \"OSWALT\"', 'bazoluis@hotmail.com', 2) ) ~ MODPATH/database/classes/kohana/database/mysql.php [ 181 ]
2015-07-20 22:44:20 --- ERROR: Database_Exception [ 0 ]: [1062] Duplicate entry 'bazoluis@hotmail.com' for key 'uniq_username' ( INSERT INTO `users` (`username`, `password`, `nombre`, `email`, `nivel`) VALUES ('bazoluis@hotmail.com', '4da295aebe4cd2dc67db51bd1dd20f48260288f295be20e118333c84e7a83719', 'EMPRESA CONSTRUCTORA \"OSWALT\"', 'bazoluis@hotmail.com', 2) ) ~ MODPATH/database/classes/kohana/database/mysql.php [ 181 ]