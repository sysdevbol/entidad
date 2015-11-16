<script type="text/javascript">
$(document).ready(function() {
var theme = 'darkblue';
var theme2 = 'office';
</script>
<style>
    .jqx-grid-statusbar{height: 35px!important;}
    .colordefa:not(.jqx-grid-cell-hover):not(.jqx-grid-cell-selected), .jqx-widget .red:not(.jqx-grid-cell-hover):not(.jqx-grid-cell-selected){
        color:#0378BC;
        background-color: #CDCDCD;
    }
</style>
<?php
$id_empresas = $ide;
if($consultor == "si"){
    $modeldinteres = new Model_Departamentosinteres();
    $resultado = $modeldinteres->listaprdeptosinteres($id_empresas,"Consultor");
}else{
    $modeldinteres = new Model_Departamentosinteres();
    $resultado = $modeldinteres->listaprdeptosinteres($id_empresas,"EmpresaProveedor");
}
$idd1 = "";
$idd2 = "";
$idd3 = "";
$idd4 = "";
$idd5 = "";
$idd6 = "";
$idd7 = "";
$idd8 = "";
$idd9 = "";
foreach ($resultado as $key => $value) {
    if($value['id_departamentos'] == '1'){
        $idd1 = "checked";    
    }
    if($value['id_departamentos'] == '2'){
        $idd2 = "checked";    
    }
    if($value['id_departamentos'] == '3'){
        $idd3 = "checked";    
    }
    if($value['id_departamentos'] == '4'){
        $idd4 = "checked";    
    }
    if($value['id_departamentos'] == '5'){
        $idd5 = "checked";    
    }
    if($value['id_departamentos'] == '6'){
        $idd6 = "checked";    
    }
    if($value['id_departamentos'] == '7'){
        $idd7 = "checked";    
    }
    if($value['id_departamentos'] == '8'){
        $idd8 = "checked";    
    }
    if($value['id_departamentos'] == '9'){
        $idd9 = "checked";    
    }
}
?>
<div class="control-group">
    <h3><label id="title1" for="Field1"><?php echo utf8_encode('Seleccione Departamentos de interes para su trabajo:')?></label></h3>
</div>    

<div class="row-fluid">    
    <div class="span12">
        <form class="form-horizontal" method="post" action="" name="basic_validate" id="basic_validate" novalidate="novalidate">
            <center>
            <table border="0" width="50%">
                <tr><td><input type="checkbox" id="deptointeres" name="reg[2]" <?php echo $idd2; ?>/>  La Paz</td>
                    <td><input type="checkbox" id="deptointeres" name="reg[1]" <?php echo $idd1; ?>/>  Chuquisaca</td>
                    <td><input type="checkbox" id="deptointeres" name="reg[3]" <?php echo $idd3; ?>/>  Cochabamba</td>
                </tr>
                <tr><td><input type="checkbox" id="deptointeres" name="reg[4]" <?php echo $idd4; ?>/>  Oruro</td>
                    <td><input type="checkbox" id="deptointeres" name="reg[5]" <?php echo $idd5; ?>/>  Potosi</td>
                    <td><input type="checkbox" id="deptointeres" name="reg[6]" <?php echo $idd6; ?>/>  Tarija</td>
                </tr>
                <tr><td><input type="checkbox" id="deptointeres" name="reg[7]" <?php echo $idd7; ?>/>  Santa Cruz</td>
                    <td><input type="checkbox" id="deptointeres" name="reg[8]" <?php echo $idd8; ?>/>  Beni</td>
                    <td><input type="checkbox" id="deptointeres" name="reg[9]" <?php echo $idd9; ?>/>  Pando</td>
                </tr>
            </table>
    </div>        
</div>    
            <br>
<div class="control-group">
    <label><?php echo utf8_encode('Nota: Seleccione al menos un departamento.')?></label>
</div>    
<div class="control-group">
<div style="text-align: center;">
            <input type="hidden" name="ide" value="<?php echo $ide ?>"/>
            <input type="submit" name="guardar" id="guardar" value="Guardar Seleccionados" class="btn btn-success" />   
</div>
</div>            
            </center> 
        </form>    
<?php
if(!empty($_POST['guardar']) and $_POST['guardar'] == "Guardar Seleccionados"){
?>
<div class="control-group">
    <label><h3><?php echo utf8_encode('Guardado Correctamente !!!')?></h3></label>
</div>  
<?php    
}
?>    