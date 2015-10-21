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
<div class="control-group">
    <h3><label id="title1" for="Field1"><?php echo utf8_encode('BUSQUE SU ENTIDAD CONSTRUCTORA:')?></label></h3>
</div>    

<div class="row-fluid">    
    <div class="span12">
        <form class="form-horizontal" method="post" action="" name="basic_validate" id="basic_validate" novalidate="novalidate">
            <center>
            <table border="0" width="50%">
                <tr><td>MONTO DEL PROYECTO:</td>
                    <td><input type="text" id="montoproy" name="montoproy" />  Bs.</td>
                </tr>
                <tr><td></td><td style="font-size:10px" >Solo utilice separador decimal (.)</td></tr>
                <tr><td></td><td style="font-size:10px" ></td></tr>
                <tr><td>DEPARTAMENTO DEL PROYECTO:</td>
                    <td>
                        <select name = "deptoid">
                        <option value="-1">Seleccione Departamento</option>
                        <option value="2">La Paz</option>
                        <option value="1">Chuquisaca</option>
                        <option value="3">Cochabamba</option>
                        <option value="4">Oruro</option>
                        <option value="5">Potosi</option>
                        <option value="7">Santa Cruz</option>
                        <option value="6">Tarija</option>
                        <option value="8">Beni</option>
                        <option value="9">Pando</option>
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
$monto = $_POST['montoproy'];
if(empty($monto)){
$monto = 0;
}
$monto = str_replace('.', 'p', $monto);
$iddepto = $_POST['deptoid'];
if(!empty($resultado)){
?>
<div class="control-group">
    <label><?php echo utf8_encode('SU BUSQUEDA GENERO '.$resultado.' RESULTADOS, DESCARGUELOS ')?><a href="/reportebusquedaempresa.php/?monto=<?php echo $monto ?>&iddepto=<?php echo $iddepto ?>&user=<?php echo $username ?>&resp=<?php echo $resultado ?>" >AQUI</a></label>
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

    