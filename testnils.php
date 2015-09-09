<?php
echo "nilssssss";
$dbh = new PDO('mysql:host=localhost;port=3306;dbname=empresas', 'root', '', array(PDO::ATTR_PERSISTENT => false));
$sql = "SELECT * from empresas";
//$dat = mysql_query($sql);
//$reg = @mysql_fetch_assoc($dat);
$stmt = $dbh->prepare($sql);
$stmt->execute();
while($reg = $stmt->fetch(PDO::FETCH_ASSOC)){
echo $reg['id']."<BR>";	
}
//CALL registraproponente(NEW.id,NEW.tipo);

?>