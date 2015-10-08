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

?>
<div class="control-group">
    <h3><label id="title1" for="Field1"><?php echo utf8_encode('Genere e Imprima su registro para su verificacion y posterior habilitacion.')?></label></h3>
</div>    

<div class="row-fluid">    
    <div class="span12">
        <form class="form-horizontal" method="post" action="" name="basic_validate" id="basic_validate" novalidate="novalidate">
            <center>
            
    </div>        
</div>    
            <br>
<div class="control-group">
    <label><?php echo utf8_encode('Para poder generar su registro usted deberia tener toda su informacion completa. (Datos Generales, Materiales a Proveer, Departamentos de Interes).')?></label>
    <label><?php echo utf8_encode('Al generar este certificado de habilitacion usted ya esta HABILITADO en nuestra base de datos.')?></label>
    <!--<label><?php echo utf8_encode('Imprima dos copias de su registro y aproximese a la departamental correspondiente con documentos originales y fotocopias simples para verificar su informacion.')?></label>-->
    <!--<label><?php echo utf8_encode('Nota: La informacion que usted registro mediante el sistema nos permitira asignarle una calificacion.')?></label>-->
    <label><strong><?php echo utf8_encode('** El Certificado de Habilitacion no tiene valor alguno hasta que sea sellado y firmado por el Area Legal. **')?></strong></label>
</div>    
<div class="control-group">
<div style="text-align: center;">
            <input type="hidden" name="ide" value="<?php echo $ide ?>"/>
            <br><br><input type="submit" name="submit" id="submit" value="Generar e Imprimir Registro" class="btn btn-success" />   
</div>
</div>   

            </center> 
            <br>
            <a href="/reporte3.php/?ide=<?php echo $ide ?>" >IMPRIMA REPORTE DE TODOS SUS DATOS</a>
        </form>    
    