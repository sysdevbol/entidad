<?php defined('SYSPATH') or die('No direct script access.'); ?>

2014-11-05 15:49:51 --- ERROR: Database_Exception [ 0 ]: [1062] Duplicate entry 'E-2014-00001' for key 'codigo' ( INSERT INTO `documentos` (`codigo`, `cite_original`, `id_tipo`, `nombre_destinatario`, `cargo_destinatario`, `institucion_destinatario`, `nombre_remitente`, `cargo_remitente`, `institucion_remitente`, `referencia`, `adjuntos`, `original`, `hojas`, `fecha_creacion`, `id_user`, `id_oficina`, `id_proceso`, `id_entidad`) VALUES ('E-2014-00001', 'S/C', 6, 'Leo Wilson Otazo Zubieta', 'DIRECTOR DEPARTAMENTAL POTOSI', 'AGENCIA ESTATAL DE VIVIENDA', 'Ladislao Flores Sanchez', 'JEFE DE EMS COURIER', 'ECOBOL', 'Nota de débito correspondiente al mes de octubre 2014', 'Guías', 1, '3', '2014-11-05 15:49:51', '375', '99', 4, '13') ) ~ MODPATH/database/classes/kohana/database/mysql.php [ 181 ]
2014-11-05 19:40:13 --- ERROR: Database_Exception [ 0 ]: [1064] You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '%'
        or nur like '%E--2014-00042'%'
        or referencia like '%E--2014-0' at line 3 ( SELECT COUNT(*) as count FROM documentos d,
        ( SELECT id  FROM documentos
        WHERE cite_original like '%E--2014-00042'%'
        or nur like '%E--2014-00042'%'
        or referencia like '%E--2014-00042'%' ) as x
        WHERE x.id=d.id
        and d.id_entidad='13' ) ~ MODPATH/database/classes/kohana/database/mysql.php [ 181 ]