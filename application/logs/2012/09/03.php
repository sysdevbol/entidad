<?php defined('SYSPATH') or die('No direct script access.'); ?>

2012-09-03 15:09:24 --- ERROR: Kohana_View_Exception [ 0 ]: The requested view documentos/listar_viajes.php could not be found ~ SYSPATH\classes\kohana\view.php [ 268 ]
2012-09-03 15:10:22 --- ERROR: Kohana_View_Exception [ 0 ]: The requested view documentos/listar_viajes.php could not be found ~ SYSPATH\classes\kohana\view.php [ 268 ]
2012-09-03 17:51:28 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 'v.trasporte1' in 'field list' ( SELECT d.id, d.cite_original,d.nombre_remitente,o.oficina,d.cargo_remitente,d.referencia,d.nur,v.lugar,v.fecha_salida,v.fecha_retorno,v.viatico,v.trasporte1,v.transporte2
        ,v.no_descripcion,v.cedula_identidad,d.contenido,v.resolucion,v.pases,v.form110,v.cuenta_corriente,v.cuenta_utc,
        v.fondos_copia,v.pasaje_aereo,v.pasaje_terrestre,v.form604,v.planilla_invitados
        FROM documentos d 
        INNER JOIN users u ON u.id=d.id_user
        INNER JOIN oficinas o ON o.id=d.id_oficina
        INNER JOIN viajes v ON d.id=v.id_documento       
        INNER JOIN mediotransporte m ON m.id=v.medio_transporte1
	INNER JOIN mediotransporte mm ON mm.id=v.medio_transporte2
        WHERE d.id='218' ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2012-09-03 17:51:50 --- ERROR: Database_Exception [ 0 ]: [1054] Unknown column 'v.transporte1' in 'field list' ( SELECT d.id, d.cite_original,d.nombre_remitente,o.oficina,d.cargo_remitente,d.referencia,d.nur,v.lugar,v.fecha_salida,v.fecha_retorno,v.viatico,v.transporte1,v.transporte2
        ,v.no_descripcion,v.cedula_identidad,d.contenido,v.resolucion,v.pases,v.form110,v.cuenta_corriente,v.cuenta_utc,
        v.fondos_copia,v.pasaje_aereo,v.pasaje_terrestre,v.form604,v.planilla_invitados
        FROM documentos d 
        INNER JOIN users u ON u.id=d.id_user
        INNER JOIN oficinas o ON o.id=d.id_oficina
        INNER JOIN viajes v ON d.id=v.id_documento       
        INNER JOIN mediotransporte m ON m.id=v.medio_transporte1
	INNER JOIN mediotransporte mm ON mm.id=v.medio_transporte2
        WHERE d.id='218' ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]