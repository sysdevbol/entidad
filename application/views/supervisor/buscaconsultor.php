<script type="text/javascript">
$(document).ready(function() {
var theme = 'darkblue';
var theme2 = 'office';
</script>
<script type="text/javascript">
function cargaprop(){
    var iditem = document.getElementById("tipo").value;
    if(iditem == "-1"){
        alert("Eliga un Tipo de Consultoria");
    }else{
        location.href = "/supervisar/buscaconsultor/?iditem="+iditem;    
    }
    
}
function cargaprop1(){
    var iditem = document.getElementById("tipo").value;
    var prop1 = document.getElementById("tipo1").value;
    if(iditem == "-1"){
        alert("Eliga un Tipo de Consultoria");
    }else{
        location.href = "/supervisar/buscaconsultor/?iditem="+iditem+"&prop="+prop1;    
    }
    
}
</script>
<style>
    .jqx-grid-statusbar{height: 35px!important;}
    .colordefa:not(.jqx-grid-cell-hover):not(.jqx-grid-cell-selected), .jqx-widget .red:not(.jqx-grid-cell-hover):not(.jqx-grid-cell-selected){
        color:#0378BC;
        background-color: #CDCDCD;
    }
</style>
<div class="control-group">
    <h3><label id="title1" for="Field1"><?php echo utf8_encode('BUSQUE CONSULTOR CON LOS CRITERIOS SELECCIONADOS:')?></label></h3>
</div>    

<div class="row-fluid">    
    <div class="span12">
        <form class="form-horizontal" method="post" action="" name="basic_validate" id="basic_validate" novalidate="novalidate">
            <center>
            <table border="0" width="50%">
                <tr><td>Tipo de Consultoria:</td>
                    <td>
                        <select name = "tipo" id="tipo" onchange="cargaprop()">
                        <option value="-1">Seleccione Tipo de Consultoria</option>
                        <option value="10" <?php if(!empty($iditem) and $iditem == "10"){ echo "selected"; } ?> >SUPERVISOR</option>
                        <option value="11" <?php if(!empty($iditem) and $iditem == "11"){ echo "selected"; } ?> >INSPECTOR</option>
                        <option value="12" <?php if(!empty($iditem) and $iditem == "12"){ echo "selected"; } ?> >TOA</option>
                        <option value="15" <?php if(!empty($iditem) and $iditem == "15"){ echo "selected"; } ?> >ALMACENERO</option>
                        <option value="16" <?php if(!empty($iditem) and $iditem == "16"){ echo "selected"; } ?> >EDUCADOR-SOCIAL</option>
                        <option value="17" <?php if(!empty($iditem) and $iditem == "17"){ echo "selected"; } ?> >TECNICO-CONSTRUCTOR</option>
                        </select>
                    </td>
                </tr>
                <tr><td></td><td style="font-size:10px" ></td></tr>
                <tr><td></td><td style="font-size:10px" ></td></tr>
                <tr><td>Tipo de Proponente:</td>
                    <td>
                        <select name = "tipo1" id="tipo1" onchange="cargaprop1()">
                        <option value="-1">Seleccione Proponente</option>
                        <option value="pn" <?php if(!empty($prop) and $prop == "pn"){ echo "selected"; } ?> >Persona Natural</option>
                        <?php
                        if(!empty($iditem) and ($iditem == "10" OR $iditem == "11")){
                        ?>
                        <option value="em" <?php if(!empty($prop) and $prop == "em"){ echo "selected"; } ?>>Empresa</option>
                        <option value="am" <?php if(!empty($prop) and $prop == "am"){ echo "selected"; } ?>>Ambos</option>
                        <?php    
                        }
                        ?>
                        </select>
                    </td>
                </tr>
                <tr><td></td><td style="font-size:10px" ></td></tr>
                <tr><td></td><td style="font-size:10px" ></td></tr>
                <?php
                if($iditem != "17"){
                ?>
                <tr><td>Experiencia General (Meses):</td>
                    <td><input type="text" id="expg" name="expg" /></td>
                </tr>
                <?php    
                }
                ?>
                <tr><td></td><td style="font-size:10px" ></td></tr>
                <tr><td></td><td style="font-size:10px" ></td></tr>
                <?php
                if($iditem != "16"){
                ?>
                <tr><td>Experiencia Especifica (Meses):</td>
                    <td><input type="text" id="expesp" name="expesp" /></td>
                </tr>
                <?php
                }else{
                ?>
                <tr><td>Experiencia en Numero de Trabajos:</td>
                    <td><input type="text" id="expesp" name="expesp" /> <span style="font-size:8px">... considere al menos 2 meses de tiempo en cada trabajo.</span> </td>
                </tr>
                <?php
                }
                ?>
                <tr><td></td><td style="font-size:10px" ></td></tr>
                <tr><td></td><td style="font-size:10px" ></td></tr>
                <tr><td>DEPARTAMENTO:</td>
                    <td>
                        <select name = "deptoid" id="deptoid">
                        <option value="-1">Seleccione Departamento</option>
                        <?php
                        $odeptos = new Model_Departamentos();
                        $result = $odeptos->listadepto();
                        foreach ($result as $key => $value) {
                        $id = $value['id'];
                        $depto = $value['departamento'];
                        ?>
                        <option value="<?php echo $id ?>" ><?php echo $depto ?></option>
                        <?php
                        }
                        ?>
                        </select>
                    </td>
                </tr>
            </table>
    </div>        
</div>    
            <br>
<div class="control-group">
    <label><?php echo utf8_encode('Nota: Utilice al menos un campo de busqueda.')?></label>
</div>    
<div class="control-group">
<div style="text-align: center;">
            <input type="hidden" name="ide" value="<?php echo $ide ?>"/>
            <input type="submit" name="submit" id="submit" value="BUSCAR" class="btn btn-success" />   
</div>
</div>            
            </center> 
        </form> 
<?php
if(!empty($_POST['submit']) and $_POST['submit'] == "BUSCAR"){
if(empty($_POST['tipo'])){
    $dato2 = "-1";
}else{
    $dato2 = $_POST['tipo'];
}
if(empty($_POST['tipo1'])){
    $dato3 = "-1";
}else{
    $dato3 = $_POST['tipo1'];
}
if(empty($_POST['deptoid'])){
    $dato1 = "-1";
}else{
    $dato1 = $_POST['deptoid'];
}
if(empty($_POST['expg'])){
    $dato5 = 0;
}else{
    $dato5 = $_POST['expg'];
}
if(empty($_POST['expesp'])){
    $dato4 = 0;
}else{
    $dato4 = $_POST['expesp'];
}
if(!empty($resultado)){
$idsc = str_replace(",", "|", $idsc);
$idse = str_replace(",", "|", $idse);    
?>
<div class="control-group">
    <!-- <label><?php echo utf8_encode('SU BUSQUEDA GENERO '.$resultado.' RESULTADOS, DESCARGUELOS ')?><a href="/reportebusquedacons.php/?dato1=<?php echo $dato1 ?>&dato2=<?php echo $dato2 ?>&dato3=<?php echo $dato3 ?>&dato4=<?php echo $dato4 ?>&dato5=<?php echo $dato5 ?>" >AQUI</a></label>-->
    <label><?php echo utf8_encode('SU BUSQUEDA GENERO '.$resultado.' RESULTADOS, DESCARGUELOS ')?><a href="/reportebusquedacons.php/?idsc=<?php echo $idsc ?>&idse=<?php echo $idse ?>&user=<?php echo $username ?>&resp=<?php echo $resultado ?>&dato1=<?php echo $dato1 ?>&dato2=<?php echo $dato2 ?>&dato3=<?php echo $dato3 ?>&dato4=<?php echo $dato4 ?>&dato5=<?php echo $dato5 ?>" >AQUI</a></label>
</div>   
<?php
}else{
?>
<div class="control-group">
    <label><?php echo utf8_encode('SU BUSQUEDA NO GENERO NINGUN RESULTADO.')?></label>
</div>   
<?php    
}
}
?>          

    