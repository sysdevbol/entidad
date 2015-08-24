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
	//mysql_query ("SET NAMES 'utf8'");
	$sql = "SELECT tipoclasificacion.tipo as 'Tipo Consultor',(SELECT GROUP_CONCAT(rubroarea.nombre) from rubroarea where CONCAT(',',consultores.id_rubroarea,',') LIKE CONCAT('%,',rubroarea.id,',%')) as 'RUBRO/AREA', 
	consultores.id as 'Nro de registro en el sistema'
	FROM consultores INNER JOIN tipoclasificacion ON consultores.tipo = tipoclasificacion.id where consultores.id = '$idregistro_entidad'";
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
	$sql2 = "SELECT consultores.nombre_completo as 'Nombre Completo', 
	consultores.ci as 'Carnet de Identidad', 
	consultores.profesion as 'Profesion',
	consultores.fecha_nacimiento as 'Fecha de Nacimiento', 
	consultores.procedencia as 'Procedencia'
FROM consultores where id = '$idregistro_entidad'";
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
	$sql3 = "SELECT consultores.telefonos as 'Telefonos', 
	consultores.celular as 'Celular', 
	consultores.mail as 'Correo Electronico'
FROM consultores where id = '$idregistro_entidad'";
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

	//FORMACION ACADEMICA
	$sqlf = "SELECT titulo, universidad_institucion, fecha_diplomaconclusion from formacionconsultor where id_consultor = '$idregistro_entidad'";
	$stmt = $dbh->prepare($sqlf);
    $stmt->execute();
    $data2 = array();
    while($regf = $stmt->fetch(PDO::FETCH_ASSOC)){
    	$data2[] = array('TITULO'=>$regf['titulo'],'Universidad/Institucion'=>$regf['universidad_institucion'],'Fecha Titulo en Provision Nacional'=>$regf['fecha_diplomaconclusion'],'Verifique'=>'[  ]');

    }
	// FIN FORMACION ACADEMICA
	//Postgrados
	$sqlp = "SELECT postgradoconsultor.curso_postgrado, 
	postgradoconsultor.numero_horas, 
	postgradoconsultor.fecha_diplomaconclusion, 
	postgradoconsultor.universidad_institucion, 
	tipopostgrado.nombre
FROM postgradoconsultor LEFT JOIN tipopostgrado ON postgradoconsultor.id_tipopostgrado = tipopostgrado.id
where id_consultor = '$idregistro_entidad'";
	$stmt = $dbh->prepare($sqlp);
    $stmt->execute();
    $data3 = array();
    while($regp = $stmt->fetch(PDO::FETCH_ASSOC)){
    	$data3[] = array('CURSO/POSTGRADO'=>$regp['curso_postgrado'],'NroHoras'=>$regp['numero_horas'],'Fecha Conclusion'=>$regp['fecha_diplomaconclusion'],
    	'Universidad/Institucion'=>$regp['universidad_institucion'],'Tipo Postgrado'=>$regp['nombre'],'Verifique'=>'[  ]');

    }
	// FIN Postgrado
	//Cursos cortos
	$sqlcc = "SELECT curso_corto, universidad_institucion, carga_horaria FROM cursocortoconsultor where id_consultor = '$idregistro_entidad'";
	$stmt = $dbh->prepare($sqlcc);
    $stmt->execute();
    $data4 = array();
    while($regcc = $stmt->fetch(PDO::FETCH_ASSOC)){
    	$data4[] = array('CURSO'=>$regcc['curso_corto'],'Universidad/Institucion'=>$regcc['universidad_institucion'],'Carga Horaria'=>$regcc['carga_horaria'],'Verifique'=>'[  ]');

    }
	// FIN Cursos cortos
	//experiencia
	$sqlexp = "SELECT experienciaconsultor.nombre_contratante, 
	experienciaconsultor.objeto_contrato, 
	departamentos.departamento, 
	experienciaconsultor.lugar_contrato, 
	experienciaconsultor.monto_contrato, 
	experienciaconsultor.descripcion_contrato, 
	tipoexperiencia.tipo, 
	experienciaconsultor.inicio_contrato, 
	experienciaconsultor.fin_contrato,
	round(((to_days(fin_contrato) - to_days(inicio_contrato)) / 30),2)as 'meses'
FROM experienciaconsultor left JOIN departamentos ON experienciaconsultor.id_departamento = departamentos.id
	 INNER JOIN tipoexperiencia ON experienciaconsultor.id_tipoexperiencia = tipoexperiencia.id
where id_consultor = '$idregistro_entidad'";
	$stmt = $dbh->prepare($sqlexp);
    $stmt->execute();
    $data5 = array();
    while($regexp = $stmt->fetch(PDO::FETCH_ASSOC)){
    	$data5[] = array('Nombre Contratante'=>$regexp['nombre_contratante'],'Objeto del Contrato'=>$regexp['objeto_contrato'],
    		'Departamento'=>$regexp['departamento'],'Lugar del contrato'=>$regexp['lugar_contrato'],'Monto del Contrato'=>$regexp['monto_contrato'],
    		'Descripcion del Contrato'=>$regexp['descripcion_contrato'],'Tipo Experiencia'=>$regexp['tipo'],'Fecha Inicio'=>$regexp['inicio_contrato'],
    		'Fecha Fin'=>$regexp['fin_contrato'],'Meses'=>$regexp['meses'],'Verifique'=>'[  ]');

    }
	// FIN experiencia

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
	$pdf->ezText('CONSULTOR', 20, array(
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
	$pdf->addText(500, 30, 8, "TECNICO");
	$pdf->line(490,40,600,40);
	$pdf->addText(620, 30, 8, "LEGAL");
	$pdf->line(610,40,720,40);
	$pdf->addText(740, 30, 8, "PROPONENTE");
	$pdf->line(730,40,840,40);
	$pdf->closeObject();
	$pdf->addObject($footer, "all");
	$pdf->ezNewPage();
	$pdf->ezText('Consultor', 20, array(
		'justification' => 'center'
	));
	$pdf->ezText('Formacion Academica', 15, array(
		'justification' => 'left'
	));
	$pdf->ezTable($data2, '', 'Datos Provenientes Durante el Registro', array(
		'width' => 650,
		'maxWidth' => 650,
		'fontSize' => 7,
		'cols'=>array('TITULO'=>array('width'=>200),'Universidad/Institucion'=>array('width'=>200),'Fecha Titulo en Provision Nacional'=>array('width'=>100),'Verifique'=>array('width'=>50))
	));
	$pdf->ezText('');
	$pdf->ezText('');
	$pdf->ezText('PostGrado', 15, array(
		'justification' => 'left'
	));
	$pdf->ezTable($data3, '', 'Datos Provenientes Durante el Registro', array(
		'width' => 650,
		'maxWidth' => 650,
		'fontSize' => 7,
		'cols'=>array('CURSO/POSTGRADO'=>array('width'=>150),'NroHoras'=>array('width'=>50),'Fecha Conclusion'=>array('width'=>80),'Universidad/Institucion'=>array('width'=>150),'Tipo Postgrado'=>array('width'=>100),'Verifique'=>array('width'=>50))
	));
	$pdf->ezText('');
	$pdf->ezText('');
	$pdf->ezText('Cursos Cortos', 15, array(
		'justification' => 'left'
	));
	$pdf->ezTable($data4, '', 'Datos Provenientes Durante el Registro', array(
		'width' => 650,
		'maxWidth' => 650,
		'fontSize' => 7,
		'cols'=>array('CURSO'=>array('width'=>200),'Universidad/Institucion'=>array('width'=>200),'Carga Horaria'=>array('width'=>100),'Verifique'=>array('width'=>50))
	));
	$pdf->ezNewPage();
	$pdf->ezText('Consultor', 20, array(
		'justification' => 'center'
	));
	$pdf->ezText('Experiencia General/Especifica', 15, array(
		'justification' => 'left'
	));
	$pdf->ezTable($data5, '', 'Datos Provenientes Durante el Registro', array(
		'width' => 750,
		'maxWidth' => 750,
		'fontSize' => 7,
		'cols'=>array('Nombre Contratante'=>array('width'=>80),'Objeto del Contrato'=>array('width'=>80),'Departamento'=>array('width'=>40),
			'Lugar del contrato'=>array('width'=>80),'Monto del Contrato'=>array('width'=>50),'Descripcion del Contrato'=>array('width'=>80),
			'Tipo Experiencia'=>array('width'=>40),'Fecha Inicio'=>array('width'=>40),'Fecha Fin'=>array('width'=>40),
			'Meses'=>array('width'=>40),'Verifique'=>array('width'=>40))
	));
	
	$pdf->ezStream();
	echo $pdf;
}	
	?>