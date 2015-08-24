<?php
error_reporting(E_ALL);
set_time_limit(1800);
set_include_path('application/vendor/newezpdf/src/' . PATH_SEPARATOR . get_include_path());
//include "conexionsp.php";
include 'Cezpdf.php';

createreport($_GET['ide']);
function createreport($id){
class Creport extends Cezpdf{
	function Creport($p,$o){
  		$this->__construct($p, $o,'none',array());
	}
}
$dbh = new PDO('mysql:host=localhost;port=3306;dbname=empresas', 'root', '43vivienda', array(PDO::ATTR_PERSISTENT => false));
	$idregistro_entidad =$id;
	///INICIO DATOS GENERALES
	mysql_query ("SET NAMES 'utf8'");
	$sql = "SELECT  `Tipo de Empresa Ejecutora` as 'Tipo',`RUBRO/AREA`,`id` as 'Nro de Registro en el sistema', `Nombre del Proponente o Razon Social`,
	`Nombre del Representante Legal`, `Carnet de Identidad`, `CI Expedido en` from reporteemejdg where id = '$idregistro_entidad'";
	//$dat = mysql_query($sql);
	//$reg = @mysql_fetch_assoc($dat, MYSQL_ASSOC);
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $reg = $stmt->fetch(PDO::FETCH_ASSOC);
    
	$data1 = array();
	foreach ($reg as $key=>$datos) {
		$data1[] = array("    "=>$key,"DATOS"=>$datos,"Verifique"=>"[  ]");
	}
	///FIN DATOS GENERALES
	///INICIO DATOS especificos
	$sql2 = "SELECT `Numero de Identificacion Tributaria`, `Fecha de expedicion NIT`, `Numero de Matricula de Comercio`,
	`Fecha de expedicion Matricula`, `Numero de Testimonio`, `Lugar de Emision Testimonio`, `Fecha de Expedicion Testimonio` from reporteemejdg where id = '$idregistro_entidad'";
	//$dat2 = mysql_query($sql2);
	//$reg2 = @mysql_fetch_assoc($dat2, MYSQL_ASSOC);
    $stmt = $dbh->prepare($sql2);
    $stmt->execute();
    $reg2 = $stmt->fetch(PDO::FETCH_ASSOC);
	$data12 = array();
	foreach ($reg2 as $key2=>$datos2) {
		$data12[] = array("    "=>$key2,"DATOS"=>$datos2,"Verifique"=>"[  ]");
	}

	///FIN DATOS especificos
	
	///INICIO datos direccion
	$sql3 = "SELECT `Pais`, `Ciudad`, `Direccion`,`Telefonos`,`FAX`,`Celular`,`Correo Electronico 1`,`Correo Electronico 2` from reporteemejdg where id = '$idregistro_entidad'";
	//$dat3 = mysql_query($sql3);
	//$reg3 = @mysql_fetch_assoc($dat3, MYSQL_ASSOC);
    $stmt = $dbh->prepare($sql3);
    $stmt->execute();
    $reg3 = $stmt->fetch(PDO::FETCH_ASSOC);
	$data13 = array();
	foreach ($reg3 as $key3=>$datos3) {
		$data13[] = array("    "=>$key3,"DATOS"=>$datos3,"Verifique"=>"[  ]");
	}
	///FIN datos direccion
	//materiales
	$sqlf = "SELECT materialesrequeridos.descripcion, 
	materialesrequeridos.unidad, 
	proveedormateriales.departamentos, 
	proveedormateriales.municipios
FROM proveedormateriales INNER JOIN materialesrequeridos ON proveedormateriales.material_id = materialesrequeridos.id
where proveedormateriales.empresa_id = '$idregistro_entidad'";
	$stmt = $dbh->prepare($sqlf);
    $stmt->execute();
    $data2 = array();
    while($regf = $stmt->fetch(PDO::FETCH_ASSOC)){
    	$iddep = substr($regf['departamentos'],0,-1);
    	$sqldp = "SELECT GROUP_CONCAT(departamento) as 'departamento' from departamentos where id in ($iddep)";
    	$stmtdp = $dbh->prepare($sqldp);
    	$stmtdp->execute();
    	$regdp = $stmtdp->fetch(PDO::FETCH_ASSOC);
    	$idmun = substr($regf['municipios'],0,-1);
    	$sqlmn = "SELECT GROUP_CONCAT(municipios.municipio) as 'municipio' from municipios where id in ($idmun)";
    	$stmtmn = $dbh->prepare($sqlmn);
    	$stmtmn->execute();
    	$regmn = $stmtmn->fetch(PDO::FETCH_ASSOC);	
    	$data2[] = array('Material'=>$regf['descripcion'],'Unidad'=>$regf['unidad'],'Departamentos'=>$regdp['departamento'],'Municipios'=>$regmn['municipio'],'Verifique'=>'[  ]');
	}
	// FIN materiales

	//print_r($data1);
	//print_r($data12);
	//print_r($data13);
	//print_r($data2);break;
	//$fecha = date("F j, Y");
	//$fecha = date();
	setlocale(LC_TIME,"es_ES");
	$fecha = strftime("%d de %B del %Y");
	$pdf = new Creport('a4','landscape');
	$pdf->ezSetMargins(20,70,20,20);
	$pdf->selectFont('./fonts/Helvetica');
	$pdf->ezText('PROVEEDORES', 20, array(
		'justification' => 'center'
	));
	$pdf->ezText('AEVIVIENDA                                                                                      <c:uline>Registro #</c:uline>  ' . $idregistro_entidad, 11, array(
		'justification' => 'center'
	));
	$pdf->ezText('www.aevivienda.gob.bo                                                                      <c:uline>Fecha Actual:</c:uline>  ' . $fecha, 11, array(
		'justification' => 'center'
	));
	$pdf->ezText('');
	$pdf->ezText('DATOS GENERALES', 15, array(
		'justification' => 'left'
	));
	$pdf->ezTable($data1, '', 'Datos Provenientes Durante el Registro', array(
		'width' => 560,
		'maxWidth' => 600,
		'fontSize' => 7
	));
	
	$pdf->ezText('');
	$pdf->ezText('DATOS ESPECIFICOS', 15, array(
		'justification' => 'left'
	));
	$pdf->ezTable($data12, '', 'Datos Provenientes Durante el Registro', array(
		'width' => 560,
		'maxWidth' => 600,
		'fontSize' => 7
	));

	$pdf->ezText('');
	$pdf->ezText('DATOS COMPLEMENTARIOS', 15, array(
		'justification' => 'left'
	));
	$pdf->ezTable($data13, '', 'Datos Provenientes Durante el Registro', array(
		'width' => 560,
		'maxWidth' => 600,
		'fontSize' => 7
	));
	$footer = $pdf->openObject();
	$pdf->ezImage('/media/img/logoaevivienda.png',50,0,'full','left');
	$pdf->addText(500, 30, 8, "TECNICO");
	$pdf->line(490,40,600,40);
	$pdf->addText(620, 30, 8, "LEGAL");
	$pdf->line(610,40,720,40);
	$pdf->addText(740, 30, 8, "PROPONENTE");
	$pdf->line(730,40,840,40);
	$pdf->closeObject();
	$pdf->addObject($footer, "all");
	$pdf->ezNewPage();
	$pdf->ezText('PROVEEDORES', 20, array(
		'justification' => 'center'
	));
	$pdf->ezText('Materiales', 15, array(
		'justification' => 'left'
	));
	$pdf->ezTable($data2, '', 'Datos Provenientes Durante el Registro', array(
		'width' => 650,
		'maxWidth' => 650,
		'fontSize' => 7,
		'cols'=>array('Material'=>array('width'=>150),'Unidad'=>array('width'=>50),'Departamentos'=>array('width'=>200),'Municipios'=>array('width'=>200),'Verifique'=>array('width'=>50))
	));
	$pdf->ezText('');
	$pdf->ezText('');
	/*
	$pdf->ezText('Fecha: ' . $fecha, 15, array(
		'justification' => 'right'
	));
	*/
	$pdf->ezStream();
	echo $pdf;
}	
	?>