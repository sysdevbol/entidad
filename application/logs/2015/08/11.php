<?php defined('SYSPATH') or die('No direct script access.'); ?>

2015-08-11 05:24:06 --- ERROR: Database_Exception [ 0 ]: [1062] Duplicate entry 'renequimo1@gmail.com' for key 'uniq_username' ( INSERT INTO `users` (`username`, `password`, `nombre`, `email`, `nivel`) VALUES ('renequimo1@gmail.com', 'd9acdc7aa352acd729536e3028bdf493035bcf8fabb44c66d42c7d94ea04bfa2', 'KITSUNEGAS CONSTRUCCIONES', 'renequimo1@gmail.com', 2) ) ~ MODPATH/database/classes/kohana/database/mysql.php [ 181 ]
2015-08-11 05:24:35 --- ERROR: Database_Exception [ 0 ]: [1062] Duplicate entry 'renequimo1@gmail.com' for key 'uniq_username' ( INSERT INTO `users` (`username`, `password`, `nombre`, `email`, `nivel`) VALUES ('renequimo1@gmail.com', '7118fc06e9e4eb10317843c76bd52a68519a7867c492fd21bc136d9b6a0a2dc2', 'KITSUNEGAS CONSTRUCCIONES', 'renequimo1@gmail.com', 2) ) ~ MODPATH/database/classes/kohana/database/mysql.php [ 181 ]
2015-08-11 05:25:01 --- ERROR: Database_Exception [ 0 ]: [1062] Duplicate entry 'renequimo1@gmail.com' for key 'uniq_username' ( INSERT INTO `users` (`username`, `password`, `nombre`, `email`, `nivel`) VALUES ('renequimo1@gmail.com', '6213a9b97e606fd3378b6ea6265bae24e4ab97442fa906e500d54f435056d931', 'KITSUNEGAS CONSTRUCCIONES', 'renequimo1@gmail.com', 2) ) ~ MODPATH/database/classes/kohana/database/mysql.php [ 181 ]
2015-08-11 05:27:36 --- ERROR: Database_Exception [ 0 ]: [1062] Duplicate entry 'renequimo1@gmail.com' for key 'uniq_username' ( INSERT INTO `users` (`username`, `password`, `nombre`, `email`, `nivel`) VALUES ('renequimo1@gmail.com', 'a92ae24db2ab5653f1242df7d085e1b99bc307fc0b156c5cb6ffc72151cff666', 'KITSUNEGAS CONSTRUCCIONES', 'renequimo1@gmail.com', 2) ) ~ MODPATH/database/classes/kohana/database/mysql.php [ 181 ]
2015-08-11 05:29:40 --- ERROR: Database_Exception [ 0 ]: [1062] Duplicate entry 'renequimo1@gmail.com' for key 'uniq_username' ( INSERT INTO `users` (`username`, `password`, `nombre`, `email`, `nivel`) VALUES ('renequimo1@gmail.com', '857bbc167a83b8102ae04370faa7bfc76bc8c4961839f9302a088aa6a7366a78', 'KITSUNEGAS CONSTRUCCIONES', 'renequimo1@gmail.com', 2) ) ~ MODPATH/database/classes/kohana/database/mysql.php [ 181 ]
2015-08-11 05:30:03 --- ERROR: Database_Exception [ 0 ]: [1062] Duplicate entry 'renequimo1@gmail.com' for key 'uniq_username' ( INSERT INTO `users` (`username`, `password`, `nombre`, `email`, `nivel`) VALUES ('renequimo1@gmail.com', '8fe0cea683b21fe1b7c06778a8adb37f3ba2752b9462c407c30579c8facba71e', 'KITSUNEGAS CONSTRUCCIONES', 'renequimo1@gmail.com', 2) ) ~ MODPATH/database/classes/kohana/database/mysql.php [ 181 ]
2015-08-11 05:31:57 --- ERROR: Database_Exception [ 0 ]: [1062] Duplicate entry 'renequimo1@gmail.com' for key 'uniq_username' ( INSERT INTO `users` (`username`, `password`, `nombre`, `email`, `nivel`) VALUES ('renequimo1@gmail.com', '8881215ec68f37fea452a0286d2bb5b524e8ebbc4850ed0882953ef17185c973', 'KITSUNEGAS CONSTRUCCIONES', 'renequimo1@gmail.com', 2) ) ~ MODPATH/database/classes/kohana/database/mysql.php [ 181 ]
2015-08-11 16:29:36 --- ERROR: Database_Exception [ 0 ]: [1062] Duplicate entry 'renequimo1@gmail.com' for key 'uniq_username' ( INSERT INTO `users` (`username`, `password`, `nombre`, `email`, `nivel`) VALUES ('renequimo1@gmail.com', '35e27f71e717ac0c8e6427f37e8a4bbc1feb9a516c180696cb59f0f1bf8514c7', 'KITSUNEGAS CONSTRUCCIONES', 'renequimo1@gmail.com', 2) ) ~ MODPATH/database/classes/kohana/database/mysql.php [ 181 ]
2015-08-11 16:49:41 --- ERROR: Database_Exception [ 0 ]: [1062] Duplicate entry 'percyepp@hotmail.com' for key 'uniq_username' ( INSERT INTO `users` (`username`, `password`, `nombre`, `email`, `nivel`) VALUES ('percyepp@hotmail.com', 'd15834b38475f26eba9f3e1a601038bfafc266fbad9a44d2318370550346e566', 'ERNESTO PERCY POZO PEREZ', 'percyepp@hotmail.com', 7) ) ~ MODPATH/database/classes/kohana/database/mysql.php [ 181 ]
2015-08-11 16:49:54 --- ERROR: Database_Exception [ 0 ]: [1062] Duplicate entry 'percyepp@hotmail.com' for key 'uniq_username' ( INSERT INTO `users` (`username`, `password`, `nombre`, `email`, `nivel`) VALUES ('percyepp@hotmail.com', '1f8e07fc0248b74f5076157a3f78a0b42658bd84bdaff2885d23641f020256e7', 'ERNESTO PERCY POZO PEREZ', 'percyepp@hotmail.com', 7) ) ~ MODPATH/database/classes/kohana/database/mysql.php [ 181 ]
2015-08-11 18:54:58 --- ERROR: Database_Exception [ 0 ]: [1064] You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'ORDER BY orden ASC' at line 4 ( SELECT mr.id as idm,descripcion, unidad,orden,pm.id as idp,empresa_id,material_id,departamentos,municipios 
                FROM materialesrequeridos mr
                LEFT JOIN proveedormateriales pm ON mr.id = pm.material_id AND pm.empresa_id = 
                ORDER BY orden ASC ) ~ MODPATH/database/classes/kohana/database/mysql.php [ 181 ]
2015-08-11 23:31:11 --- ERROR: Database_Exception [ 0 ]: [1062] Duplicate entry 'renequimo1@gmail.com' for key 'uniq_username' ( INSERT INTO `users` (`username`, `password`, `nombre`, `email`, `nivel`) VALUES ('renequimo1@gmail.com', '529cbf203fd7f2b809f2fd42c074973b4ca3e53a4637c6a4ecb25b9923656bab', 'KITSUNEGAS CONSTRUCCIONES', 'renequimo1@gmail.com', 2) ) ~ MODPATH/database/classes/kohana/database/mysql.php [ 181 ]