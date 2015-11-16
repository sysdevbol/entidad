<?php
/*
echo "nilssssss";
$dbh = new PDO('mysql:host=localhost;port=3306;dbname=empresas', 'root', '', array(PDO::ATTR_PERSISTENT => false));
$sql = "SELECT * from empresas";
//$dat = mysql_query($sql);
//$reg = @mysql_fetch_assoc($dat);
$stmt = $dbh->prepare($sql);
$stmt->execute();
while($reg = $stmt->fetch(PDO::FETCH_ASSOC)){
echo $reg['id']."<BR>";	
}*/
//CALL registraproponente(NEW.id,NEW.tipo);
$dbh = new PDO('mysql:host=localhost;port=3306;dbname=empresas', 'root', '43vivienda', array(PDO::ATTR_PERSISTENT => false));
$sql = "SELECT * from consultores";
$stmt = $dbh->prepare($sql);
$stmt->execute();
while($rs = $stmt->fetch(PDO::FETCH_ASSOC)){
$id_empresa = $rs['id'];
$iddeptos = $rs['id_departamento'];
echo $insert = "INSERT into departamentosinteres(`id_empresas`,`id_departamentos`,`tipo`) values('$id_empresa','$iddeptos','Consultor')";
$stmt1 = $dbh->prepare($insert);
$stmt1->execute();
}
?>