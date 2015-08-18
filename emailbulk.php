<?php
$dbh = new PDO('mysql:host=localhost;port=3306;dbname=empresas', 'root', '43vivienda', array(PDO::ATTR_PERSISTENT => false));
$message = '
                <p>Este mensaje se envia a todas las Entidades Ejecutoras, Proveedores de Material y Consultores para que tomen en cuenta lo siguiente:</p>
                <p><span style="background-color: #ffffff; font-size: x-large;"><strong><span style="color: #993300;">Entidades Ejecutoras, Proveedores de Material y Consultores</span></strong></span></p>
                <p>1.- Verifique que su registro este completo, esto significa que tengan un Usuario y Contrase&ntilde;a.</p>
                <p>El usuario es su mismo correo electronico con el que se registraron y su contrase&ntilde;a son cuatro digitos que les enviamos a su correo electronico.</p>
                <p>2.- Verifiquen que sus datos ingresados en los formularios sean los correctos. Corriga si es necesario.</p>
                <p>FECHA dos digitos para dia/dos digitos para mes/cuatro digitos para a&ntilde;o (Ejem. 31 de julio de 2015 seria 31/07/2015).</p>
                <p>3.- Complete todos sus formularios correspondientes e imprima su "Certificado de Habilitacion". Dirigase a la departamental correspondiente para ser "Habilitado".</p>
                <p><strong>Nota: En dos semanas procederemos a eliminar usuarios que recibieron este mensaje y no tengan contrase&ntilde;a.</strong></p>
                <p><span style="background-color: #ffffff; font-size: x-large;"><strong><span style="color: #993300;">Entidades Ejecutoras y Consultores</span></strong></span></p>
                <p>Para Entidades Ejecutoras y Consultores, se esta lanzando un nuevo proceso "Calificacion Automatica" que les pondra en un ranking el cual nos ayudara a decidir a que entidades y 
                    consultores enviar invitaciones para ciertos proyectos. Esta calificacion es generada por el sistema por lo tanto tomar en cuenta lo siguiente:</p>
                <p>Verifiquen que sus datos ingresados en los formularios sean los correctos. Corriga si es necesario.</p>
                <p>FECHA dos digitos para dia/dos digitos para mes/cuatro digitos para a&ntilde;o (Ejem. 31 de julio de 2015 seria 31/07/2015).</p>
                <p>1.- Fecha inicio y fecha fin de contratos en los registros de experiencia.</p>
                <p>2.- Monto de contratos en los registros de experiencia, solo es necesario el separado "." par definir decimales.</p>
                <p>3.- Compruebe que la experiencia registrada tenga el dato de "Departamento" donde se realizo.</p>
                <p><strong>Esta informacion es un patron principal de calificacion e influira en su calificacion final.</strong></p>
                <p><span style="background-color: #ffffff; font-size: x-large;"><strong><span style="color: #993300;">Solo Entidades Ejecutoras</span></strong></span></p>
                <p>1.- En los registros de experiencia verifique que el dato "Relacion con el Estado" este marcado si corresponde.</p>
                <p>2.- En los registros de experiencia verifique que el dato "Experiencia Especifica" este marcado si corresponde.</p>
                <p>3.- En los registros de experiencia verifique que el dato "Experinecia Especifica del area" este marcado si corresponde.</p>
                <p><strong>Esta informacion es un patron principal de calificacion e influira en su calificacion final.</strong></p>
                <p><span style="background-color: #ffffff; font-size: x-large;"><strong><span style="color: #993300;">Solo Consultores</span></strong></span></p>
                <p>1.- En los registros de Post Grados verifique qeu el dato "Tipo de Post grado" este correctamente marcado.</p>
                <p><strong>Esta informacion es un patron principal de calificacion e influira en su calificacion final.</strong></p>
                <p><span style="background-color: #ffffff; font-size: x-large;"><strong><span style="color: #993300;">Solo Proveedores de Material</span></strong></span></p>
                <p>Les pedimos por favor a todos los Proveedores de Material que verifiquen la seleccion de Materiales que realizaron ya que en una actualizacion a nuestra base de datos tal vez perdimos la informacion que registraron. 
                    Disculpas nuevamente y gracias por su comprension.</p>
                
                <BR><BR><BR>
                <p>Cualquier inquietud no dude en contactarnos.</p>    
                <BR><BR><BR>    
                <p><span style="text-decoration: underline;"><em><span style="font-family: arial,helvetica,sans-serif; font-size: small;">Notificaci&oacute;n autom&aacute;tica generada por la Agencia Estatal de Vivienda.</span></em></span></p>

                ';
$sql = "SELECT * from empresas where mail not like '%eliminado%' and mail <> '' group by mail";
$stmt = $dbh->prepare($sql);
$stmt->execute();
while($reg = $stmt->fetch(PDO::FETCH_ASSOC)){
    echo $reg['mail']."<br>";
    $mailto = $reg['mail'];
    $subject = "Complete y verifique sus datos AEVIVIENDA";
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
    $headers .= "From: Unidad de Sistemas <sistemas@aevivienda.gob.bo>\r\n";
    $headers .= "Cc: registro.entidad@aevivienda.gob.bo\r\n";             
    /*
    if(mail($mailto,$subject,$message,$headers)){
        echo "Enviado"."<BR>";
    }else{
        echo "NoEnviado"."<BR>";
    }*/
}
$sql1 = "SELECT * from consultores where mail not like '%eliminado%' and mail <> '' group by mail";
$stmt = $dbh->prepare($sql1);
$stmt->execute();
while($reg1 = $stmt->fetch(PDO::FETCH_ASSOC)){
    echo $reg1['mail']."<br>";
    $mailto = $reg1['mail'];
    $subject = "Complete y verifique sus datos AEVIVIENDA";
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
    $headers .= "From: Unidad de Sistemas <sistemas@aevivienda.gob.bo>\r\n";
    $headers .= "Cc: registro.entidad@aevivienda.gob.bo\r\n";             
    /*if(mail($mailto,$subject,$message,$headers)){
        echo "Enviado"."<BR>";
    }else{
        echo "NoEnviado"."<BR>";
    }*/
}
?>
                