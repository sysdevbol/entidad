<?php
$dbh = new PDO('mysql:host=localhost;port=3306;dbname=empresas', 'root', '43vivienda', array(PDO::ATTR_PERSISTENT => false));
//$dbh = new PDO('mysql:host=localhost;port=3306;dbname=empresas', 'root', '', array(PDO::ATTR_PERSISTENT => false));
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

<title>Detalle de Calificacion</title>
<div style="font-size:12px">
<div class="row-fluid">      
        <?php
        $id = $_GET['id'];
        $sql = "SELECT * from calificaciones where id = '$id'";
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        $reg = $stmt->fetch(PDO::FETCH_ASSOC);
        $id_emcons = $reg['id_empresa'];
        $clasificacion = $reg['id_clasificacion'];
        $comentario = $reg['comentario'];
        $id_user = $reg['id_user'];
        //depto donde se habilita
        $sqlushab="SELECT departamentos.departamento
        FROM users LEFT JOIN departamentos ON users.id_departamento = departamentos.id
        where users.id = '$id_user'";
        $stmt = $dbh->prepare($sqlushab);
        $stmt->execute();
        $regushab = $stmt->fetch(PDO::FETCH_ASSOC);
        $deptohabilita = $regushab['departamento'];
        //
        $idnotafinal = $reg['calificacion'];
        $evalua = strpos($comentario, "PMAR (GENERADO POR EL SISTEMA)");
        if($evalua === false){
          $evalua1 = strpos($comentario, "Vivienda Nueva (GENERADO POR EL SISTEMA)");
          if($evalua1 === false){
            $proyecto = '0';
          }else{
            $proyecto = '1';
          }
        }else{
          $proyecto = '2';
        }
        if($proyecto == '0'){
          $sqluserdp="SELECT users.username, 
          users.email, 
          departamentos.departamento
          FROM users LEFT JOIN departamentos ON users.id_departamento = departamentos.id
          where users.id = '$id_user'";
          $stmt = $dbh->prepare($sqluserdp);
          $stmt->execute();
          $reguserdep = $stmt->fetch(PDO::FETCH_ASSOC);
          $deptouser = $reguserdep['departamento'];
          $username = $reguserdep['username'];
          $useremail = $reguserdep['email'];
          ?>
            <div class="row-fluid">
            <em><strong>Supervisor:</strong> <?php echo $username; ?></em>
            </div>
            <div class="row-fluid">
            <em><strong>Correo Electronico:</strong> <?php echo $useremail; ?></em>
            </div>
            <div class="row-fluid">
            <em><strong>Departamento:</strong> <?php echo $deptouser; ?></em>
            </div>
            <div class="row-fluid">
            <em><strong>Calificacion al Proponente: <?php echo $idnotafinal; ?></strong></em>
            </div>
            <div class="row-fluid">
            <em><strong>Observacion:</strong> <?php echo $comentario; ?></em>
            </div>
            <input type="button" value="Cerrar" onclick="window.close()"></input>
            </div>
            <div class="row-fluid">
            </div>
          <?php
        }
        if($clasificacion == '1' and $proyecto != '0'){
          $sql1 = "SELECT SUM(experienciaentidad.monto_contrato) as 'monto' from experienciaentidad where id_entidad = '$id_emcons'";
          $stmt = $dbh->prepare($sql1);
          $stmt->execute();
          $reg1 = $stmt->fetch(PDO::FETCH_ASSOC);
          if(empty($reg1['monto'])){
              $montoexpgen = 0;
          }else{
              $montoexpgen = $reg1['monto'];   
          }
          $area = 1;
          $califica1 = patroncalifica1($clasificacion,$proyecto,$area,$montoexpgen);
          
          $date = date('Y');
          $date10 = ($date-10)."-01-01";
          $sql1 = "SELECT round((SUM(round(((to_days(`experienciaentidad`.`fecha_fin_contrato`) - to_days(`experienciaentidad`.`fecha_ini_contrato`)) / 30),2))/12),2) AS 'anios' 
          from experienciaentidad where id_entidad = '$id_emcons' and fecha_ini_contrato > '$date10' and tipo = '1'";
          $stmt = $dbh->prepare($sql1);
          $stmt->execute();
          $reg1 = $stmt->fetch(PDO::FETCH_ASSOC);
          if(empty($reg1['anios'])){
              $expanios = 0;
          }else{
              $expanios = $reg1['anios'];   
          }
          $area = 2;
          $califica2 = patroncalifica1($clasificacion,$proyecto,$area,$expanios);
          
          if($proyecto == '1'){
          $sql1 = "SELECT round((((SELECT COUNT(id) from experienciaentidad where id_entidad = '$id_emcons' and tipo = '1' and relacion_estado = 'SI')*100)/(SELECT COUNT(id) from experienciaentidad where id_entidad = '$id_emcons' and tipo = '1')),2) as 'totalporcentaje'";
          $stmt = $dbh->prepare($sql1);
          $stmt->execute();
          $reg1 = $stmt->fetch(PDO::FETCH_ASSOC);
          if(empty($reg1['totalporcentaje'])){
              $expestado = 0;
          }else{
              $expestado = $reg1['totalporcentaje'];   
          }
          $area=3;
          $califica3 = patroncalifica1($clasificacion,$proyecto,$area,$expestado);  
          }
          if($proyecto == '2'){
            $sql1 = "SELECT GROUP_CONCAT(id_area) as 'areas' from experienciaentidad 
            where experienciaentidad.id_entidad = '$id_emcons' and id_area <> '0' group by id_entidad";
            $stmt = $dbh->prepare($sql1);
            $stmt->execute();
            $reg1 = $stmt->fetch(PDO::FETCH_ASSOC);
            if(empty($reg1['areas'])){
                $exparea= 0;
            }else{
                $exparea= $reg1['areas'];   
            }
            $area = 6;
            $califica3 = patroncalifica3($clasificacion,$proyecto,$area,$exparea);
          }
          $sqldepto = "SELECT * from users where id = '$id_user'";
          $stmt = $dbh->prepare($sqldepto);
          $stmt->execute();
          $regdepto = $stmt->fetch(PDO::FETCH_ASSOC);
          $depto = $regdepto['id_departamento'];
          $sql1 = "SELECT round((((SELECT COUNT(id) from experienciaentidad where id_entidad = '$id_emcons' and tipo = '1' and id_departamento = '$depto')*100)/(SELECT COUNT(id) from experienciaentidad where id_entidad = '$id_emcons' and tipo = '1')),2) as 'totalporcentaje'";
          $stmt = $dbh->prepare($sql1);
          $stmt->execute();
          $reg11 = $stmt->fetch(PDO::FETCH_ASSOC);
          if(empty($reg11['totalporcentaje'])){
              $expdepto = 0;
          }else{
              $expdepto = $reg11['totalporcentaje'];   
          }
          $area=4;
          $califica4 = patroncalifica1($clasificacion,$proyecto,$area,$expdepto);
          $sql1 = "SELECT em.tipo as 'tipoentidad'
          FROM experienciaentidad ex INNER JOIN empresas em ON ex.id_entidad = em.id
          where ex.id_entidad = '$id_emcons' group by ex.id_entidad";
          $stmt = $dbh->prepare($sql1);
          $stmt->execute();
          $reg1 = $stmt->fetch(PDO::FETCH_ASSOC);
              if(empty($reg1['tipoentidad'])){
                  $identifica= 0;
              }else{
                  $identifica= $reg1['tipoentidad'];   
              }
          $area=5;
          $califica5 = patroncalifica2($clasificacion,$proyecto,$area,$identifica);
          ?>
          <div class="row-fluid">
          <strong>Calificacion Generada a partir de la HABILITACION en <?php echo $deptohabilita; ?>.</strong>
          </div>
          <table border="1" style="font-size:10px">
            <tr class="titgrupo">
            <td>Descripcion</td>
            <td>Patron de Calificacion</td>
            <td>Calificacion del Proponente</td>
            </tr>    
            <tr>
            <td><pre><strong>Experiencia General de la Empresa</strong>
Mayor o igual a Bs.10.000.000,00
Mayor o igual a Bs.7.500.000,00
Mayor o igual a Bs.5.000.000,00
Mayor o igual a Bs.2.500.000,00
Mayor o igual a Bs.1.000.000,00</pre></td>
            <td align="right">25</td>
            <td align="right"><?php echo $califica1; ?></td>
            </tr>
            <tr>
            <td><pre><strong>Experiencia Especifica de la Empresa</strong>
Se asignara 6 puntos por cada 2 años de 
Experiencia Especifica en los ultimos  
10 años en obras de Edificacion.</pre></td>
            <td align="right">30</td>
            <td align="right"><?php echo $califica2; ?></td>
            </tr>
            <?php
            if($proyecto == '2'){
              ?>
            <tr>
            <td><pre><strong>Experiencia Especifica del Area</strong>
Capacitacion y Talleres.
Asistencia Tecnica.
Seguimiento.</pre></td>
            <td align="right">15</td>
            <td align="right"><?php echo $califica3; ?></td>
            </tr>  
              <?php
            }elseif($proyecto == '1') {
              ?>
            <tr>
            <td><pre><strong>Experiencia Especifica de la Empresa con el Estado</strong>
Mayor o igual al 60% de su Experiencia Especifica.
Mayor o igual al 40% de su Experiencia Especifica.
Mayor o igual al 20% de su Experiencia Especifica.</pre></td>
            <td align="right">15</td>
            <td align="right"><?php echo $califica3; ?></td>
            </tr>  
              <?php
            }
            ?>
            <tr>
            <td><pre><strong>Experiencia Específica de la Empresa en el Departamento donde postula</strong>
Mayor o igual al 60% de su Experiencia Especifica en cantidad de proyectos.
Mayor o igual al 40% de su Experiencia Especifica en cantidad de proyectos.
de 0% hasta el 39% de su Experiencia Especifica en cantidad de proyectos.</pre></td>
            <td align="right">15</td>
            <td align="right"><?php echo $califica4; ?></td>
            </tr>
            <?php
            if($proyecto == '2'){
            ?>
            <tr>
            <td><pre><strong>Identificacion del Proponente</strong>
ONG y Fundaciones.
Empresa Constructora SRL. /  SA / LTDA.
Empresas Asociadas / Empresas Unipersonal.</pre></td>
            <td align="right">15</td>
            <td align="right"><?php echo $califica5; ?></td>
            </tr>
            <?php
            }elseif($proyecto == '1') {
            ?>
            <tr>
            <td><pre><strong>Identificacion del Proponente</strong>
Empresa Constructora SRL. /  SA / LTDA.
Empresa Unipersonal.
Asociación Accidental / Fundacion y ONG.</pre></td>
            <td align="right">15</td>
            <td align="right"><?php echo $califica5; ?></td>
            </tr>
            <?php
            }  
            ?>
            <tr align="right">
            <td><strong>TOTAL FINAL</strong></td>
            <td>100</td>
            <td><strong><?php echo $califica1+$califica2+$califica3+$califica4+$califica5; ?></strong></td>
            </tr>
            </table>
            <div class="row-fluid">
            <em><strong>Nota:</strong> Si la calificacion del detalle no coincide con la nota final del proponenete, revise nuevamente</em>
            </div>
            <div class="row-fluid">
            <em>la infomracion generada en el reporte y proceda a verificar y HABILITAR nuevamente al proponente.</em>
            </div>
            <input type="button" value="Cerrar" onclick="window.close()"></input>
            </div>
            <div class="row-fluid">
            </div>
          <?php

        }
        if($clasificacion == '3' and $proyecto != '0'){
          $proyecto = '1';
          $sql1 = "SELECT SUM(experienciaconsultor.monto_contrato) as 'monto' from experienciaconsultor where id_consultor = '$id_emcons'";
          $stmt = $dbh->prepare($sql1);
          $stmt->execute();
          $reg1 = $stmt->fetch(PDO::FETCH_ASSOC);
          if(empty($reg1['monto'])){
              $montoexpgen = 0;
          }else{
              $montoexpgen = $reg1['monto'];   
          }
          $area = 1;
          $califica1 = patroncalifica1($clasificacion,$proyecto,$area,$montoexpgen);
          
          $date = date('Y');
          $date10 = ($date-10)."-01-01";
          $sql1 = "SELECT round((SUM(round(((to_days(experienciaconsultor.fin_contrato) - to_days(experienciaconsultor.inicio_contrato)) / 30),2))/12),2) AS 'anios' 
        from experienciaconsultor where id_consultor = '$id_emcons' and inicio_contrato > '$date10' and id_tipoexperiencia = '1'";
          $stmt = $dbh->prepare($sql1);
          $stmt->execute();
          $reg1 = $stmt->fetch(PDO::FETCH_ASSOC);
          if(empty($reg1['anios'])){
              $expanios = 0;
          }else{
              $expanios = $reg1['anios'];   
          }
          $area = 2;
          $califica2 = patroncalifica1($clasificacion,$proyecto,$area,$expanios);
          $sql1 = "SELECT * from formacionconsultor where id_consultor = '$id_emcons' and fecha_diplomaconclusion > '0000-00-00'";
          $stmt = $dbh->prepare($sql1);
          $stmt->execute();
          $reg1 = $stmt->fetch(PDO::FETCH_ASSOC);
          if(empty($reg1['id'])){
            $vtpn = '0';
          }else{
            $vtpn = 'SiTPN';
          }
          $sql11 = "SELECT * from postgradoconsultor where `id_consultor` = '$id_emcons' and id_tipopostgrado = '1' and numero_horas >= 200";
          $stmt = $dbh->prepare($sql11);
          $stmt->execute();
          $reg11 = $stmt->fetch(PDO::FETCH_ASSOC);
          if(empty($reg11['id'])){
            $vdpl = '0';
          }else{
            $vdpl = 'SiD';
          }
          $sql12 = "SELECT * from postgradoconsultor where `id_consultor` = '$id_emcons' and id_tipopostgrado = '2'";
          $stmt = $dbh->prepare($sql12);
          $stmt->execute();
          $reg12 = $stmt->fetch(PDO::FETCH_ASSOC);
          if(empty($reg12['id'])){
            $vpg = '0';
          }else{
            $vpg = 'SiMD';
          }
          $foracad = "'".$vtpn."','".$vdpl."','".$vpg."'";
          $area = 7;
          $califica3 = patroncalifica3($clasificacion,$proyecto,$area,$foracad);
          $sqldepto = "SELECT * from users where id = '$id_user'";
          $stmt = $dbh->prepare($sqldepto);
          $stmt->execute();
          $regdepto = $stmt->fetch(PDO::FETCH_ASSOC);
          $depto = $regdepto['id_departamento'];
          $sql1 = "SELECT round((((SELECT COUNT(id) from experienciaconsultor where id_consultor = '$id_emcons' and id_tipoexperiencia = '1' and id_departamento = '$depto')*100)/(SELECT COUNT(id) from experienciaconsultor where id_consultor = '$id_emcons' and id_tipoexperiencia = '1')),2) as 'totalporcentaje'";
          $stmt = $dbh->prepare($sql1);
          $stmt->execute();
          $reg11 = $stmt->fetch(PDO::FETCH_ASSOC);
          if(empty($reg11['totalporcentaje'])){
              $expdepto = 0;
          }else{
              $expdepto = $reg11['totalporcentaje'];   
          }
          $area=4;
          $califica4 = patroncalifica1($clasificacion,$proyecto,$area,$expdepto);
          $area=5;
          $califica5 = patroncalifica2($clasificacion,$proyecto,$area,$clasificacion);
          ?>
          <div class="row-fluid">
          <strong>Calificacion Generada a partir de la HABILITACION en <?php echo $deptohabilita; ?>.</strong>
          </div>
          
          <table border="1" style="font-size:10px">
            <tr class="titgrupo">
            <td>Descripcion</td>
            <td>Patron de Calificacion</td>
            <td>Calificacion del Proponente</td>
            </tr>    
            <tr>
            <td><pre><strong>Experiencia General de la Empresa</strong>
Mayor o igual a Bs.10.000.000,00
Mayor o igual a Bs.7.500.000,00
Mayor o igual a Bs.5.000.000,00
Mayor o igual a Bs.2.500.000,00
Mayor o igual a Bs.1.000.000,00</pre></td>
            <td align="right">25</td>
            <td align="right"><?php echo $califica1; ?></td>
            </tr>
            <tr>
            <td><pre><strong>Experiencia Especifica de la Empresa</strong>
Se asignara 6 puntos por cada 2 años de 
Experiencia Especifica en los ultimos  
10 años en obras de Edificacion.</pre></td>
            <td align="right">30</td>
            <td align="right"><?php echo $califica2; ?></td>
            </tr>
            <tr>
            <td><pre><strong>Formacion Academica</strong>
Titulo en Provision Nacional.
Diplomado (min 200 hrs).
Maestria.</pre></td>
            <td align="right">20</td>
            <td align="right"><?php echo $califica3; ?></td>
            </tr>
            <tr>
            <td><pre><strong>Experiencia Específica de la Empresa en el Departamento donde postula</strong>
Mayor o igual al 60% de su Experiencia Especifica en cantidad de proyectos.
Mayor o igual al 40% de su Experiencia Especifica en cantidad de proyectos.
de 0% hasta el 39% de su Experiencia Especifica en cantidad de proyectos.</pre></td>
            <td align="right">15</td>
            <td align="right"><?php echo $califica4; ?></td>
            </tr>
            <tr>
            <td><pre><strong>Identificacion del Proponente</strong>
Consultor.</pre></td>
            <td align="right">10</td>
            <td align="right"><?php echo $califica5; ?></td>
            </tr>
            <tr align="right">
            <td><strong>TOTAL FINAL</strong></td>
            <td>100</td>
            <td><strong><?php echo $califica1+$califica2+$califica3+$califica4+$califica5; ?></strong></td>
            </tr>
            </table>
            <div class="row-fluid">
            <em><strong>Nota:</strong> Si la calificacion del detalle no coincide con la nota final del proponenete, revise nuevamente</em>
            </div>
            <div class="row-fluid">
            <em>la informacion generada en el reporte y proceda a verificar y HABILITAR nuevamente al proponente.</em>
            </div>
            <input type="button" value="Cerrar" onclick="window.close()"></input>
            </div>
            <div class="row-fluid">
            </div>
          <?php
        }
        function patroncalifica2($clasificacion,$proyecto,$area,$tipo){
          $dbh = new PDO('mysql:host=localhost;port=3306;dbname=empresas', 'root', '43vivienda', array(PDO::ATTR_PERSISTENT => false));
          //$dbh = new PDO('mysql:host=localhost;port=3306;dbname=empresas', 'root', '', array(PDO::ATTR_PERSISTENT => false));
            $tipolike = '%'.$tipo.'%';
            $sql2="SELECT * from patrondecalificacion where patrondecalificacion.id_areacalificaion = '$area' 
            and id_clasificacion = '$clasificacion' AND id_proyecto = '$proyecto' and rango1 like '$tipolike'";
            $stmt = $dbh->prepare($sql2);
            $stmt->execute();
            $reg2 = $stmt->fetch(PDO::FETCH_ASSOC);
            if(empty($reg2['puntaje'])){
                return 0;
            }else{
                return $reg2['puntaje'];
            }   
        }
        function patroncalifica1($clasificacion,$proyecto,$area,$rangovalor){
          $dbh = new PDO('mysql:host=localhost;port=3306;dbname=empresas', 'root', '43vivienda', array(PDO::ATTR_PERSISTENT => false));
          //$dbh = new PDO('mysql:host=localhost;port=3306;dbname=empresas', 'root', '', array(PDO::ATTR_PERSISTENT => false));
            $sql2="SELECT * from patrondecalificacion where patrondecalificacion.id_areacalificaion = '$area' 
            and id_clasificacion = '$clasificacion' AND id_proyecto = '$proyecto' and (CAST(rango1 as DECIMAL(0)) <= $rangovalor and CAST(rango2 as DECIMAL(0)) > $rangovalor)";
            $stmt = $dbh->prepare($sql2);
            $stmt->execute();
            $reg2 = $stmt->fetch(PDO::FETCH_ASSOC);
            if(empty($reg2['puntaje'])){
              return 0;
            }else{
              return $reg2['puntaje'];
            }     
        }
        function patroncalifica3($clasificacion,$proyecto,$area,$exparea){
          $dbh = new PDO('mysql:host=localhost;port=3306;dbname=empresas', 'root', '43vivienda', array(PDO::ATTR_PERSISTENT => false));
          //$dbh = new PDO('mysql:host=localhost;port=3306;dbname=empresas', 'root', '', array(PDO::ATTR_PERSISTENT => false));
            $areain = '('.$exparea.')';
            $sql2="SELECT SUM(puntaje) as 'puntajesum' from patrondecalificacion where patrondecalificacion.id_areacalificaion = '$area' 
            and id_clasificacion = '$clasificacion' AND id_proyecto = '$proyecto' and rango1 in $areain";
            $stmt = $dbh->prepare($sql2);
            $stmt->execute();
            $reg2 = $stmt->fetch(PDO::FETCH_ASSOC);
            if(empty($reg2['puntajesum'])){
                return 0;
            }else{
                return $reg2['puntajesum'];
            }     
        }
        
?>