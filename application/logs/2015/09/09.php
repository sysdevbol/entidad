<?php defined('SYSPATH') or die('No direct script access.'); ?>

2015-09-09 11:04:15 --- ERROR: Database_Exception [ 0 ]: [1064] You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'SELECT GROUP_CONCAT(dtos.departamento) from departamentosinteres inner join depa' at line 3 ( SELECT consultores.id,consultores.nombre_completo,tipoclasificacion.tipo,consultores.procedencia,departamentos.departamento,consultores.profesion,consultores.ci,
          consultores.telefonos,consultores.celular,consultores.mail,estados.estado 
          (SELECT GROUP_CONCAT(dtos.departamento) from departamentosinteres inner join departamentos dtos on departamentosinteres.id_departamentos = dtos.id where departamentosinteres.id_empresas = e.id) as 'deptosinteres',
          (SELECT dpts.departamento from verificaobservaciones left JOIN users on verificaobservaciones.id_user = users.id left JOIN departamentos dpts on users.id_departamento = dpts.id where verificaobservaciones.id_empresa = e.id  order by verificaobservaciones.id DESC LIMIT 0,1) as 'verificadoen' 
          FROM consultores 
          INNER JOIN estados on consultores.estado = estados.id
          LEFT JOIN departamentos on consultores.id_departamento = departamentos.id
          INNER JOIN tipoclasificacion on consultores.tipo = tipoclasificacion.id ) ~ MODPATH/database/classes/kohana/database/mysql.php [ 181 ]
2015-09-09 11:05:04 --- ERROR: Database_Exception [ 0 ]: [1064] You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'SELECT GROUP_CONCAT(dtos.departamento) from departamentosinteres inner join depa' at line 3 ( SELECT consultores.id,consultores.nombre_completo,tipoclasificacion.tipo,consultores.procedencia,departamentos.departamento,consultores.profesion,consultores.ci,
          consultores.telefonos,consultores.celular,consultores.mail,estados.estado 
          (SELECT GROUP_CONCAT(dtos.departamento) from departamentosinteres inner join departamentos dtos on departamentosinteres.id_departamentos = dtos.id where departamentosinteres.id_empresas = consultores.id) as 'deptosinteres',
          (SELECT dpts.departamento from verificaobservaciones left JOIN users on verificaobservaciones.id_user = users.id left JOIN departamentos dpts on users.id_departamento = dpts.id where verificaobservaciones.id_empresa = consultores.id  order by verificaobservaciones.id DESC LIMIT 0,1) as 'verificadoen' 
          FROM consultores 
          INNER JOIN estados on consultores.estado = estados.id
          LEFT JOIN departamentos on consultores.id_departamento = departamentos.id
          INNER JOIN tipoclasificacion on consultores.tipo = tipoclasificacion.id ) ~ MODPATH/database/classes/kohana/database/mysql.php [ 181 ]
2015-09-09 11:10:55 --- ERROR: Database_Exception [ 0 ]: [1064] You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'SELECT GROUP_CONCAT(dtos.departamento) from departamentosinteres inner join depa' at line 3 ( SELECT consultores.id,consultores.nombre_completo,tipoclasificacion.tipo,consultores.procedencia,departamentos.departamento,consultores.profesion,consultores.ci,
          consultores.telefonos,consultores.celular,consultores.mail,estados.estado 
          (SELECT GROUP_CONCAT(dtos.departamento) from departamentosinteres inner join departamentos dtos on departamentosinteres.id_departamentos = dtos.id where departamentosinteres.id_empresas = consultores.id) as 'deptosinteres',
          (SELECT dpts.departamento from verificaobservaciones left JOIN users on verificaobservaciones.id_user = users.id left JOIN departamentos dpts on users.id_departamento = dpts.id where verificaobservaciones.id_empresa = consultores.id  order by verificaobservaciones.id DESC LIMIT 0,1) as 'verificadoen' 
          FROM consultores 
          INNER JOIN estados on consultores.estado = estados.id
          LEFT JOIN departamentos on consultores.id_departamento = departamentos.id
          INNER JOIN tipoclasificacion on consultores.tipo = tipoclasificacion.id ) ~ MODPATH/database/classes/kohana/database/mysql.php [ 181 ]
2015-09-09 11:16:49 --- ERROR: Database_Exception [ 0 ]: [1064] You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'SELECT dpts.departamento from verificaobservaciones left JOIN users on verificao' at line 3 ( SELECT consultores.id,consultores.nombre_completo,tipoclasificacion.tipo,consultores.procedencia,departamentos.departamento,consultores.profesion,consultores.ci,
          consultores.telefonos,consultores.celular,consultores.mail,estados.estado 
          (SELECT dpts.departamento from verificaobservaciones left JOIN users on verificaobservaciones.id_user = users.id left JOIN departamentos dpts on users.id_departamento = dpts.id where verificaobservaciones.id_empresa = consultores.id  order by verificaobservaciones.id DESC LIMIT 0,1) as 'verificadoen' 
          FROM consultores 
          INNER JOIN estados on consultores.estado = estados.id
          LEFT JOIN departamentos on consultores.id_departamento = departamentos.id
          INNER JOIN tipoclasificacion on consultores.tipo = tipoclasificacion.id ) ~ MODPATH/database/classes/kohana/database/mysql.php [ 181 ]
2015-09-09 11:16:52 --- ERROR: Database_Exception [ 0 ]: [1064] You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'SELECT dpts.departamento from verificaobservaciones left JOIN users on verificao' at line 3 ( SELECT consultores.id,consultores.nombre_completo,tipoclasificacion.tipo,consultores.procedencia,departamentos.departamento,consultores.profesion,consultores.ci,
          consultores.telefonos,consultores.celular,consultores.mail,estados.estado 
          (SELECT dpts.departamento from verificaobservaciones left JOIN users on verificaobservaciones.id_user = users.id left JOIN departamentos dpts on users.id_departamento = dpts.id where verificaobservaciones.id_empresa = consultores.id  order by verificaobservaciones.id DESC LIMIT 0,1) as 'verificadoen' 
          FROM consultores 
          INNER JOIN estados on consultores.estado = estados.id
          LEFT JOIN departamentos on consultores.id_departamento = departamentos.id
          INNER JOIN tipoclasificacion on consultores.tipo = tipoclasificacion.id ) ~ MODPATH/database/classes/kohana/database/mysql.php [ 181 ]