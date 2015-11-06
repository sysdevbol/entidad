<?php
//$dbh = new PDO('mysql:host=localhost;port=3306;dbname=empresas', 'root', '43vivienda', array(PDO::ATTR_PERSISTENT => false));
$dbh = new PDO('mysql:host=localhost;port=3306;dbname=empresas', 'root', '', array(PDO::ATTR_PERSISTENT => false));
?>
<link rel="stylesheet" href="/media/css/jquery-ui.css" />
<style>
* {
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
}

form header {
  margin: 0 0 20px 0; 
}
form header div {
  font-size: 90%;
  color: #999;
}
form header h2 {
  margin: 0 0 5px 0;
}
form > div {
  clear: both;
  overflow: hidden;
  padding: 1px;
  margin: 0 0 10px 0;
}
form > div > fieldset > div > div {
  margin: 0 0 5px 0;
}
form > div > label,
legend {
    width: 25%;
  float: left;
  padding-right: 10px;
}
form > div > div,
form > div > fieldset > div {
  width: 75%;
  float: right;
}
form > div > fieldset label {
    font-size: 90%;
}
fieldset {
    border: 0;
  padding: 0;
}

input[type=text],
input[type=email],
input[type=url],
input[type=password],
textarea {
    width: 100%;
  border-top: 1px solid #ccc;
  border-left: 1px solid #ccc;
  border-right: 1px solid #eee;
  border-bottom: 1px solid #eee;
}
input[type=text],
input[type=email],
input[type=url],
input[type=password] {
  width: 50%;
}
input[type=text]:focus,
input[type=email]:focus,
input[type=url]:focus,
input[type=password]:focus,
textarea:focus {
  outline: 0;
  border-color: #4697e4;
}

@media (max-width: 600px) {
  form > div {
    margin: 0 0 15px 0; 
  }
  form > div > label,
  legend {
      width: 100%;
    float: none;
    margin: 0 0 5px 0;
  }
  form > div > div,
  form > div > fieldset > div {
    width: 100%;
    float: none;
  }
  input[type=text],
  input[type=email],
  input[type=url],
  input[type=password],
  textarea,
  select {
    width: 100%; 
  }
}
@media (min-width: 1200px) {
  form > div > label,
    legend {
    text-align: right;
  }
}

.titgrupo{
    /*background-color: #FEBC4A;*/
    background-color: #222222;
    color: white;
    font-weight: bold;
    text-align: center;
    vertical-align: middle;
}
.control-group.error .control-label, .control-group.error .help-block, .control-group.error .help-inline {color:#b94a48}
.control-group.error .checkbox, 
.control-group.error .radio, 
.control-group.error input, 
.control-group.error select, 
.control-group.error textarea {color:#b94a48}
.control-group.error input, 
.control-group.error select, 
.control-group.error textarea {border-color:#b94a48;-webkit-box-shadow:inset 0 1px 1px rgba(0,0,0,0.075);-moz-box-shadow:inset 0 1px 1px rgba(0,0,0,0.075);box-shadow:inset 0 1px 1px rgba(0,0,0,0.075)}
.control-group.error input:focus, 
.control-group.error select:focus, 
.control-group.error textarea:focus {border-color:#953b39;-webkit-box-shadow:inset 0 1px 1px rgba(0,0,0,0.075), 0 0 6px #d59392;-moz-box-shadow:inset 0 1px 1px rgba(0,0,0,0.075), 0 0 6px #d59392;box-shadow:inset 0 1px 1px rgba(0,0,0,0.075), 0 0 6px #d59392}
.control-group.error .input-prepend .add-on, .control-group.error .input-append .add-on {color:#b94a48;background-color:#f2dede;border-color:#b94a48}

.control-group.success .control-label, .control-group.success .help-block, .control-group.success .help-inline {color:#468847}
.control-group.success .checkbox, 
.control-group.success .radio, 
.control-group.success input, 
.control-group.success select, 
.control-group.success textarea {color:#468847}
.control-group.success input, 
.control-group.success select, 
.control-group.success textarea {border-color:#468847;-webkit-box-shadow:inset 0 1px 1px rgba(0,0,0,0.075);-moz-box-shadow:inset 0 1px 1px rgba(0,0,0,0.075);box-shadow:inset 0 1px 1px rgba(0,0,0,0.075)}
.control-group.success input:focus, 
.control-group.success select:focus, 
.control-group.success textarea:focus {border-color:#356635;-webkit-box-shadow:inset 0 1px 1px rgba(0,0,0,0.075), 0 0 6px #7aba7b;-moz-box-shadow:inset 0 1px 1px rgba(0,0,0,0.075), 0 0 6px #7aba7b;box-shadow:inset 0 1px 1px rgba(0,0,0,0.075), 0 0 6px #7aba7b}
.control-group.success .input-prepend .add-on, 
.control-group.success .input-append .add-on {color:#468847;background-color:#dff0d8;border-color:#468847}
</style>
<script>
function detalledecalificacion(id){
var opciones="toolbar=0, location=0, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, width=700, height=450, top=85, left=140";
window.open("/detalle_calificacion_1.php?id="+id,"_self",opciones);
}
</script>
<title>Calificacion Previa</title>
<div style="font-size:12px">
<div class="row-fluid">      
        <?php
        $idempresa = $_GET['idpls'];
        $idclasificacion=$_GET['idcla'];
        if($idclasificacion == "3"){
          $sql = "(SELECT 'Sistema' as 'Tipo','' as 'Usuario',comentario as 'Comentario', id ,calificacion as 'Calificacion', fecha_registro as 'Fecha' from calificaciones where id_empresa = '$idempresa' and id_clasificacion = '$idclasificacion' 
        and comentario LIKE '%(GENERADO POR EL SISTEMA)%' order by id desc limit 1) UNION ALL (SELECT 'Supervisor' as 'Tipo',(SELECT username from users 
            where users.id = id_user) as 'Usuario',comentario as 'Comentario', id ,calificacion as 'Calificacion', fecha_registro as 'Fecha' from calificaciones where id_empresa = '$idempresa' and id_clasificacion = '$idclasificacion' 
        and comentario NOT LIKE '%(GENERADO POR EL SISTEMA)%' order by id desc limit 1)";
        }else{
          $sql = "(SELECT 'Sistema' as 'Tipo','' as 'Usuario',comentario as 'Comentario', id ,calificacion as 'Calificacion', fecha_registro as 'Fecha' from calificaciones where id_empresa = '$idempresa' and id_clasificacion = '$idclasificacion' 
        and comentario LIKE '%(GENERADO POR EL SISTEMA)%' order by id desc limit 2) UNION ALL (SELECT 'Supervisor' as 'Tipo',(SELECT username from users 
            where users.id = id_user) as 'Usuario',comentario as 'Comentario', id ,calificacion as 'Calificacion', fecha_registro as 'Fecha' from calificaciones where id_empresa = '$idempresa' and id_clasificacion = '$idclasificacion' 
        and comentario NOT LIKE '%(GENERADO POR EL SISTEMA)%' order by id desc limit 1)";  
        }
        
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        $reg1 = $stmt->fetch(PDO::FETCH_ASSOC);
        if(!empty($reg1)){
            ?>
            <table border="1" style="font-size:12px">
            <tr class="titgrupo">
            <td>Tipo</td>
            <td>Usuario</td>
            <td>Comentario</td>
            <td>Calificacion</td>
            <td>Fecha</td>
            </tr>    
            <?php
            $stmt = $dbh->prepare($sql);
            $stmt->execute();
            while($reg = $stmt->fetch(PDO::FETCH_ASSOC)){
            ?>
            <tr>
            <td><?php echo $reg['Tipo']; ?></td>
            <td><?php echo $reg['Usuario']; ?></td>
            <td><?php echo $reg['Comentario']; ?></td>
            <td><a href='#' onclick="detalledecalificacion(<?php echo $reg['id']; ?>)"><?php echo $reg['Calificacion']; ?></a></td>
            <td><?php echo $reg['Fecha']; ?></td>
            </tr>
            <?php
            }
            ?>
            </table>
            <input type="button" value="Cerrar" onclick="window.close()"></input>
            </div>
            <div class="row-fluid">
            <em><strong>Nota:</strong> Son las ultimas calificaciones asignadas por parte del Sistema y Supervisor.</em>
            </div>    
            <?php
        }else{
            ?>
            <div class="row-fluid">
            <em><strong>Nota:</strong> Sugerimos que haga la verificacion previa de todo lo registrado por el usuario y proceder con la "HABILITACION".</em>
            </div>
            <?php                        
        }
        ?>
    </div>