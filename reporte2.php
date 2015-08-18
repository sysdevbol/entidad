<?php
error_reporting(E_ALL);
set_time_limit(1800);
set_include_path('application/vendor/newezpdf/src/' . PATH_SEPARATOR . get_include_path());
//include "conexionsp.php";
include 'Cezpdf.php';

reportregistrocompleto($_GET['ide']);
function reportregistrocompleto($id){
class Creport extends Cezpdf{
	function Creport($p,$o){
  		$this->__construct($p, $o,'none',array());
	}
}
$dbh = new PDO('mysql:host=localhost;port=3306;dbname=empresas', 'root', '43vivienda', array(PDO::ATTR_PERSISTENT => false));
	$idregistro_entidad =$id;
	///INICIO DATOS GENERALES
	mysql_query ("SET NAMES 'utf8'");
	echo $sqlpin = "SELECT `pin_empresa` from empresas where `id` = '$idregistro_entidad'";
	$stmtpin = $dbh->prepare($sqlpin);
    $stmtpin->execute();
    $regpin = $stmtpin->fetch(PDO::FETCH_ASSOC);
	$pinempresa = $regpin['pin_empresa'];
	//break;break;
	$sql = "SELECT  `Tipo de Empresa Ejecutora`, `Nombre del Proponente o Razon Social`,
	`Nombre del Representante Legal`, `Carnet de Identidad`, `Direccion`, `Ciudad` from reporteemejdg where id = '$idregistro_entidad'";
	//$dat = mysql_query($sql);
	//$reg = @mysql_fetch_assoc($dat, MYSQL_ASSOC);
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $reg = $stmt->fetch(PDO::FETCH_ASSOC);
    
	$data1 = array();
	foreach ($reg as $key=>$datos) {
		$data1[] = array("    "=>$key,"DATOS"=>$datos);
	}
	///FIN DATOS GENERALES
	
	//print_r($data1);
	//print_r($data12);
	//print_r($data13);
	//print_r($data2);break;
	//$fecha = date("F j, Y");
	//$fecha = date();
	setlocale(LC_TIME,"es_ES");
	$fecha = strftime("%d de %B del %Y");
	$pdf = new Creport('a4','portrate');
	$pdf->ezSetMargins(20,70,20,20);
	$pdf->selectFont('./fonts/Helvetica');
	$pdf->ezText('Registro de Datos', 20, array(
		'justification' => 'center'
	));
	$pdf->ezText('AEVIVIENDA                                                                                      <c:uline>Nro</c:uline>  ' . $pinempresa, 11, array(
		'justification' => 'center'
	));
	$pdf->ezText('www.aevivienda.gob.bo                                                                      <c:uline>Fecha Actual:</c:uline>  ' . $fecha, 11, array(
		'justification' => 'center'
	));
	$pdf->ezText('');
	$pdf->ezText('');
	$pdf->ezText('');
	$pdf->ezText('');
	
	$pdf->ezTable($data1, '', 'Datos Provenientes Durante el Registro', array(
		'width' => 560,
		'maxWidth' => 600,
		'fontSize' => 7
	));
	
	$pdf->ezText('');
	$pdf->ezText('');
	$pdf->ezText('');
	$pdf->ezText('1.- Imprima dos copias de este registro.', 9, array('justification' => 'left'));
	$pdf->ezText('2.- Adjunte documentacion original y fotocopias simples de toda la informacion registrada en el sistema para su verificacion.', 9, array('justification' => 'left'));
	$pdf->ezText('3.- Contactese con la departamental correspondiente presentar toda su docuemntacion incluido este repote.', 9, array('justification' => 'left'));
	$pdf->ezText('');
	/*
	$pdf->ezText('Fecha: ' . $fecha, 15, array(
		'justification' => 'right'
	));
	*/
	$pdf->ezStream();
}	
	?>