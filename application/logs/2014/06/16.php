<?php defined('SYSPATH') or die('No direct script access.'); ?>

2014-06-16 09:59:16 --- ERROR: Database_Exception [ 0 ]: [1062] Duplicate entry 'I-2014-00001' for key 'PRIMARY' ( INSERT INTO `nurs` (`nur`, `id_user`, `fecha_creacion`, `username`) VALUES ('I-2014-00001', '118', '2014-06-16 09:59:16', 'Santos Eddy Aduviri Pérez') ) ~ MODPATH/database/classes/kohana/database/mysql.php [ 181 ]
2014-06-16 10:00:18 --- ERROR: Database_Exception [ 0 ]: [1062] Duplicate entry 'INF/AEV/DEG/US Nº 0001/2014' for key 'codigo' ( INSERT INTO `documentos` (`id_user`, `id_tipo`, `id_proceso`, `id_oficina`, `codigo`, `cite_original`, `nombre_destinatario`, `cargo_destinatario`, `institucion_destinatario`, `nombre_remitente`, `cargo_remitente`, `mosca_remitente`, `referencia`, `contenido`, `fecha_creacion`, `adjuntos`, `hojas`, `copias`, `nombre_via`, `cargo_via`, `titulo`, `id_entidad`) VALUES ('118', '3', '2', '76', 'INF/AEV/DEG/US Nº 0001/2014', 'INF/AEV/DEG/US Nº 0001/2014', 'Edgar Jhonny Pinto Machicado', 'TECNICO I EN REDES Y SOPORTE TECNICO', '', 'Santos Eddy Aduviri Pérez', 'PROFESIONAL EN DISEÑO Y DESARROLLO DE SISTEMAS', 'SAP', 'informe de viaje', '', '2014-06-16 10:00:18', '', '0', '', '', '', '', '76') ) ~ MODPATH/database/classes/kohana/database/mysql.php [ 181 ]
2014-06-16 10:00:53 --- ERROR: Database_Exception [ 0 ]: [1062] Duplicate entry 'I-2014-00001' for key 'PRIMARY' ( INSERT INTO `nurs` (`nur`, `id_user`, `fecha_creacion`, `username`) VALUES ('I-2014-00001', '118', '2014-06-16 10:00:52', 'Santos Eddy Aduviri Pérez') ) ~ MODPATH/database/classes/kohana/database/mysql.php [ 181 ]
2014-06-16 10:06:15 --- ERROR: Database_Exception [ 0 ]: [1146] Table 'paperwordsts.correlativo' doesn't exist ( SHOW FULL COLUMNS FROM `correlativo` ) ~ MODPATH/database/classes/kohana/database/mysql.php [ 181 ]