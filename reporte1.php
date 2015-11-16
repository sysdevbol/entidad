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
	$sql = "SELECT  `Tipo de Empresa Ejecutora`,`RUBRO/AREA`,`id` as 'Nro de Registro en el sistema', `Nombre del Proponente o Razon Social`, 
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
	///INICIO DATOS EXPERIENCIA
	//asscc experiencias de socios
	$sqlexpsc = "SELECT tipo from empresas where id = '$idregistro_entidad'";
	//$regexpsc = @mysql_fetch_assoc(mysql_query($sqlexpsc));
	$stmt = $dbh->prepare($sqlexpsc);
    $stmt->execute();
    $regexpsc = $stmt->fetch(PDO::FETCH_ASSOC);
	
	if($regexpsc['tipo'] == "5"){
		$sqlexpsc1 = "SELECT GROUP_CONCAT(CONVERT(id_empresa_socios,CHAR(10))) as 'idsocios', GROUP_CONCAT(porcentaje_participacion) as 'porcentajes' from sociosaccidental where id_empresa_acc = '$idregistro_entidad'";
		//$regexpsc1 = @mysql_fetch_assoc(mysql_query($sqlexpsc1));
		$stmt = $dbh->prepare($sqlexpsc1);
    	$stmt->execute();
    	$regexpsc1 = $stmt->fetch(PDO::FETCH_ASSOC);
		$idsocios = "(".$regexpsc1['idsocios'].")";
		$sql1 = "SELECT  CONCAT('[',`Contratante`,'] SOCIO:',empresas.`nombre_proponente`) as 'Contratante', `Objeto del Contrato`,`Ubicacion`,`Monto`,`Fecha Inicio`,`Fecha Fin`,`Meses` from reporteexen 
		inner join `empresas` on `reporteexen`.`ID Entidad` = empresas.`id`
		where `ID Entidad` in $idsocios";
	}else{
		$sql1 = "SELECT `Contratante`,`Objeto del Contrato`,`Ubicacion`,`Monto`,`Fecha Inicio`,`Fecha Fin`,`Meses` from reporteexen where `ID Entidad` = '$idregistro_entidad'";	
	}

	
	//$dat1 = mysql_query($sql1);
    $stmt = $dbh->prepare($sql1);
    $stmt->execute();
    
	//$dat11 = mysql_query($sql1);
	$data2 = array();
	//$index=0;
	$sumameses=0;
	$sumamonto = 0;
	//while($reg1 = @mysql_fetch_assoc($dat1)){
    while($reg1 = $stmt->fetch(PDO::FETCH_ASSOC)){
		$fechaini = date("d/m/Y", strtotime($reg1['Fecha Inicio']));
		$fechafin = date("d/m/Y", strtotime($reg1['Fecha Fin']));
		$montoformat = number_format($reg1['Monto'],2);
		$data2[] = array('Contratante'=>$reg1['Contratante'],'Objeto del Contrato'=>$reg1['Objeto del Contrato'],'Ubicacion'=>$reg1['Ubicacion'],'Monto'=>$montoformat,
			'Fecha Inicio'=>$fechaini,'Fecha Fin'=>$fechafin,'Meses'=>$reg1['Meses'],'Verifique'=>'[  ]','EE'=>'[  ]');
		/*
		$data2[$index] = @mysql_fetch_assoc($dat11, MYSQL_ASSOC);
		$index++;
		*/
		$sumameses = $sumameses+$reg1['Meses'];
		$sumamonto = $sumamonto+$reg1['Monto'];
	}

	$sumamonto = number_format($sumamonto,2);
	if(empty($data2)){
		$data2[] = array("SIN REGISTROS EN EXPERIENCIA ...");
	}else{
		$data2[] = array('Contratante'=>'','Objeto del Contrato'=>'','Ubicacion'=>'','Monto'=>'','Fecha Inicio'=>'','Fecha Fin'=>'','Meses'=>'','Verifique'=>'','EE'=>'');
		$data2[] = array('Contratante'=>'','Objeto del Contrato'=>'','Ubicacion'=>'***Experiencia en monto (Bs)','Monto'=>$sumamonto,'Fecha Inicio'=>'','Fecha Fin'=>'***Experiencia en meses','Meses'=>$sumameses,'Verifique'=>'','EE'=>'');
		$data2[] = array('Contratante'=>'','Objeto del Contrato'=>'','Ubicacion'=>'','Monto'=>'','Fecha Inicio'=>'','Fecha Fin'=>'','Meses'=>'','Verifique'=>'Monto Especifico:','EE'=>'');
		$data2[] = array('Contratante'=>'','Objeto del Contrato'=>'','Ubicacion'=>'','Monto'=>'','Fecha Inicio'=>'','Fecha Fin'=>'','Meses'=>'','Verifique'=>'Meses Especifico:','EE'=>'');
		$data3=array();
		$data3[] = array("TOTAL EXPERIENCIA ESPECIFICA LITERAL:"=>"TOTAL EXPERIENCIA GENERAL LITERAL:"," "=>" ");
		$data4[] = array("TOTAL MONTO GENERAL EN Bs LITERAL:"=>"TOTAL MONTO ESPECIFICO EN Bs LITERAL:"," "=>" ");
	}
	
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
	$pdf->ezText('Entidades Ejecutoras', 20, array(
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

	$pdf->ezText('Entidades Ejecutoras', 20, array(
		'justification' => 'center'
	));
	$pdf->ezText('EXPERIENCIA Especifica/General', 15, array(
		'justification' => 'left'
	));
	$pdf->ezTable($data2, '', 'Datos Provenientes Durante el Registro', array(
		'width' => 650,
		'maxWidth' => 650,
		'fontSize' => 7,
		'cols'=>array('Contratante'=>array('width'=>190),'Objeto del Contrato'=>array('width'=>100),'Ubicacion'=>array('width'=>80),'Monto'=>array('width'=>55),'Fecha Inicio'=>array('width'=>50),'Fecha Fin'=>array('width'=>50),
			'Meses'=>array('width'=>35),'Verifique'=>array('width'=>45),'EE'=>array('width'=>95))
	));
	$pdf->ezText('');
	$pdf->ezTable($data3, '', '', array(
		'width' => 660,
		'maxWidth' => 700,
		'fontSize' => 7,
		'cols'=>array('TOTAL EXPERIENCIA ESPECIFICA LITERAL:'=>array('width'=>180))
	));
	$pdf->ezTable($data4, '', '', array(
		'width' => 660,
		'maxWidth' => 700,
		'fontSize' => 7,
		'cols'=>array('TOTAL MONTO GENERAL EN Bs LITERAL:'=>array('width'=>180))
	));
	$pdf->ezText('');
	$pdf->ezText('');
	$pdf->ezText('');
	/*
	$pdf->ezText('Fecha: ' . $fecha, 15, array(
		'justification' => 'right'
	));
	*/
	$pdf->ezStream();
}	
	?>