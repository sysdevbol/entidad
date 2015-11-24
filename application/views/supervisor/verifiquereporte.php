<script type="text/javascript">
$(document).ready(function() {
var theme = 'darkblue';
var theme2 = 'office';
</script>
<script type="text/javascript">
function cargaimagen(){

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
    <h3><label id="title1" for="Field1"><?php echo utf8_encode('VERIFIQUE SU REPORTE')?></label></h3>
</div>    

<div class="row-fluid">    
    <div class="span12">
        <form class="form-horizontal" method="post" action="" name="basic_validate" id="basic_validate" novalidate="novalidate">
            <center>
            <table border="0" width="50%">
                <tr><td>INGRESE CODIGO ALFA NUMERICO DE SU REPORTE:</td>
                    <td><input type="text" id="codigo" name="codigo" /> <a href="#" onclick="window.open('/media/img/codigo.png','CODIGO','width =550,height=400')">CODIGO??</a></td>
                </tr>
                <tr><td></td><td style="font-size:10px" >Si cuenta con un Scanner puede leer el codigo de barras.</td></tr>
                <tr><td></td><td style="font-size:10px" ></td></tr>
                
            </table>
    </div>        
</div>    
            <br>
   
<div class="control-group">
<div style="text-align: center;">
            <input type="hidden" name="ide" value="<?php echo $ide ?>"/>
            <input type="submit" name="submit" id="submit" value="VERIFICAR" class="btn btn-success" />   
</div>
</div>            
            </center> 
        </form> 
<?php
if(!empty($_POST['submit']) and $_POST['submit'] == "VERIFICAR"){
if(empty($result)){
?>
<div class="control-group">
    <label><?php echo utf8_encode('EL CODIGO NO GENERO NINGUN RESULTADO.')?></label><br>
</div>  
<?php
}else{
    foreach ($result as $key => $value) {
        $id = $value['id'];
        $user = $value['user'];
        $criterios = $value['criterios'];
        $resultado = $value['resultado'];
        $fecha = $value['fecha'];
    }
    $idc = $id+234;
    $codigo = 'AB'.$idc.'XY';
    $criterioarray = explode("||", $criterios);
    $tipobusqueda = explode(":::", $criterioarray[0]);
    
?>
<div class="control-group">
    <label><strong><?php echo utf8_encode('EL CODIGO GENERO EL SIGUIENTE RESULTADO: ')?></strong></label><br>
    <label><?php echo utf8_encode('USUARIO: ')?><?php echo $user ?></label><br>
    <label><?php echo utf8_encode('FECHA: ')?><?php echo $fecha ?></label><br>
    <label><?php echo utf8_encode('REGISTROS DE RESPUESTA: ')?><?php echo $resultado ?></label><br>
    <label><?php echo utf8_encode('CON LOS SIGUIENTES CRITERIOS: ')?></label><br>
<?php
if($tipobusqueda[0] == "EMPRESAS"){
?>
<label><?php echo utf8_encode($tipobusqueda[0])?></label><br>
<label><?php echo utf8_encode($tipobusqueda[1])?></label><br>
<label><?php echo utf8_encode($criterioarray[1])?></label><br>
<label><?php echo utf8_encode($criterioarray[2])?></label><br>
<label><?php echo utf8_encode($criterioarray[3])?></label><br>
<?php
}elseif($tipobusqueda[0] == "PROVEEDOR"){
?>
<label><?php echo utf8_encode($tipobusqueda[0])?></label><br>
<label><?php echo utf8_encode($tipobusqueda[1])?></label><br>
<label><?php echo utf8_encode($criterioarray[1])?></label><br>
<label><?php echo utf8_encode($criterioarray[2])?></label><br>
<?php
}else{
?>
<label><?php echo utf8_encode($tipobusqueda[0])?></label><br>
<label><?php echo utf8_encode($tipobusqueda[1])?></label><br>
<label><?php echo utf8_encode($criterioarray[1])?></label><br>
<label><?php echo utf8_encode($criterioarray[2])?></label><br>
<label><?php echo utf8_encode($criterioarray[3])?></label><br>
<label><?php echo utf8_encode($criterioarray[4])?></label><br>
<?php    
}
?>    

</div> 
<?php    
}
   
/*
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
*/
}
?>          

    