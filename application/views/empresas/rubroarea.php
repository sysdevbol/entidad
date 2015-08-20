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

$idproponente = $datosC['id'];
$tipo = $datosC['tipo'];
$motipocla = new Model_Tipoclasificacion();
$idclasificacion = $motipocla->idclasificacion($tipo);
$modelrainteres = new Model_Rubroarea();
$resultado = $modelrainteres->listaprrubrosareas($idproponente,$tipo,$idclasificacion); 
?>
<div class="control-group">
    <h3><label id="title1" for="Field1"><?php echo utf8_encode('Seleccione Areas o Rubros donde apunta su experiencia:')?></label></h3>
</div>    

<div class="row-fluid">    
    <div class="span12">
        <form class="form-horizontal" method="post" action="" name="basic_validate" id="basic_validate" novalidate="novalidate">
            <center>
            <table border="0" width="50%">
                <tr>
                    <td><strong><em>AREA/RUBRO</em></strong></td>
                    <td><em><strong>SELECCIONE</strong></em></td>
                </tr>
                <?php
                foreach ($resultado as $value) {
                    $nombrearea = $value['nombre'];
                    $idarea = $value['id'];
                    if($value['selected'] == 1){
                        $check = "checked";
                    }else{
                        $check = "";
                    }
                ?>
                <tr>
                <td><?php echo $nombrearea; ?></td>
                <td><input type="checkbox" id="deptointeres" name="reg[<?php echo $idarea; ?>]" <?php echo $check; ?>/></td>
                </tr>
                <?php    
                }
                ?>
            </table>
    </div>        
</div>    
            <br>
<div class="control-group">
    <label><?php echo utf8_encode('Nota: Seleccione al menos un Area o Rubro.')?></label>
</div>    
<div class="control-group">
<div style="text-align: center;">
            <input type="hidden" name="idprop" value="<?php echo $idproponente ?>"/>
            <input type="hidden" name="idcla" value="<?php echo $idclasificacion ?>"/>
            <input type="submit" name="guardar" id="guardar" value="Guardar Seleccionados" class="btn btn-success" />   
</div>
</div>            
            </center> 
        </form>    
    