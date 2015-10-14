<?php
$dbh = new PDO('mysql:host=localhost;port=3306;dbname=empresas', 'root', '43vivienda', array(PDO::ATTR_PERSISTENT => false));
//$sql = "SELECT * FROM empresas where estado = 1 and mail <> '' and mail not like '%eliminado%'";
$sql = "SELECT * FROM `consultores` where estado = 1 and mail <> '' and mail not like '%eliminado%'";
//$sql = "SELECT * FROM empresas where id = '923'";
$stmt = $dbh->prepare($sql);
$stmt->execute();
while($reg = $stmt->fetch(PDO::FETCH_ASSOC)){
    $id = $reg['id'];
    $mail = $reg['mail'];
    //$nombre = $reg['nombre_proponente'];
    $nombre = $reg['nombre_completo'];
    //if($reg['tipo']==5)
    //$nivel=4;
    //else
    //$nivel=2;

	$nivel = 7;
    registromanual($id,$mail,$nombre,$nivel);
}    
function registromanual($id,$mail,$nombre,$nivel){
        $dbh = new PDO('mysql:host=localhost;port=3306;dbname=empresas', 'root', '43vivienda', array(PDO::ATTR_PERSISTENT => false));
        $sql = "SELECT * from users where username = '$mail'";
        $stmt = $dbh->prepare($sql);
		$stmt->execute();
		$reg = $stmt->fetch(PDO::FETCH_ASSOC);
		if(empty($reg['id'])){
			$contraseña = "01763d84148cd8db9e0ae0cf0297d9f36c40c7a9983711ab88266922b552f56b";
            //3421
            $contraseñaliteral = "3421";
            $insert1 = "INSERT INTO users(`username`,`password`,`nombre`,`email`,`nivel`) VALUES ('$mail','$contraseña','$nombre','$mail','$nivel')";
            $stmt = $dbh->prepare($insert1);
			$stmt->execute();
			$insert2 = "INSERT INTO roles_users(user_id,role_id) VALUES ((SELECT id from users where username = '$mail'),'1')";
			$stmt = $dbh->prepare($insert2);
			$stmt->execute();
			//$update1 = "UPDATE empresas set estado = '2', user_id = (SELECT id from users where username = '$mail') where id = '$id'";
			$update1 = "UPDATE consultores set estado = '2', user_id = (SELECT id from users where username = '$mail') where id = '$id'";
			
			$stmt = $dbh->prepare($update1);
			$stmt->execute();
			$asunto = "Datos para el ingreso al sistema de la AEVIVIENDA";
                $cuerpo = '
                <p>Datos para el ingreso al sistema de la AEVIVIENDA</p>
                <table style="width: 813px; height: 240px;" border="0">
                <tbody>
                <tr>
                <td><span style="font-family: arial,helvetica,sans-serif; font-size: large;">Se&ntilde;ores:</span></td>
                <td>&nbsp;</td>
                </tr>
                <tr>
                <td><span style="color: #0000ff;"><strong><span style="font-size: large;"><span style="font-family: arial,helvetica,sans-serif;">'.$nombre.'</span>:</span></strong></span></td>
                <td>&nbsp;</td>
                </tr>
                <tr class="tablerow1">
                <td style="text-align: justify;">
                <p><span style="font-family: arial,helvetica,sans-serif; font-size: large;">Su verificaci&oacute;n fue exitosa, su usuario y contrase&ntilde;a son los siguientes:</span></p>
                <p><span style="background-color: #ffffff; font-size: x-large;"><strong><span style="color: #993300;">Usuario</span></strong> : '.$mail.'</span></p>
                <p><span style="background-color: #ffffff; font-size: x-large;"><strong><span style="color: #993300;">Contrase&ntilde;a</span></strong>: '.$contraseñaliteral.'</span></p> 
                <p>&nbsp;</p>
                <p><span style="font-family: arial,helvetica,sans-serif; font-size: large;">Ingrese al Sistema para complementar sus datos, Direcci&oacute;n:<a href="http://entidad.aevivienda.gob.bo/registroempresas/selecciontipo/">http://entidad.aevivienda.gob.bo/registroempresas/selecciontipo/</a></span></p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <p><span style="text-decoration: underline;"><em><span style="font-family: arial,helvetica,sans-serif; font-size: small;">Notificaci&oacute;n autom&aacute;tica generada por la Agencia Estatal de Vivienda.</span></em></span></p>
                </td>
                <td>&nbsp;</td>
                </tr>
                </tbody>
                </table>
                ';
                $headers = "MIME-Version: 1.0\r\n";
                $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
                $headers .= "From: Unidad de Sistemas <sistemas@aevivienda.gob.bo>\r\n";
                //$headers .= "Reply-To: mmejia@aevivienda.gob.bo\r\n";
                //$headers .= "Return-path: obarreta@aevivienda.gob.bo\r\n";
                $headers .= "Cc: registro.entidad@aevivienda.gob.bo\r\n";             
                mail($mail,$asunto,$cuerpo,$headers);

		}
    }
?>