<script type="text/javascript">
$(document).ready(function() {
var theme = 'darkblue';
var theme2 = 'office';
</script>
<script type="text/javascript">
function cargamunicipio(){
    var iddepto = document.getElementById("deptoid").value;
    var iditem = document.getElementById("item").value;
    if(iditem == "-1"){
        alert("Eliga un ITEM");
    }else{
        location.href = "/supervisar/buscaproovedor/?iddepto="+iddepto+"&iditem="+iditem;    
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
    <h3><label id="title1" for="Field1"><?php echo utf8_encode('BUSQUE PROVEEDOR MEDIANTE EL ITEM:')?></label></h3>
</div>    

<div class="row-fluid">    
    <div class="span12">
        <form class="form-horizontal" method="post" action="" name="basic_validate" id="basic_validate" novalidate="novalidate">
            <center>
            <table border="0" width="50%">
                <tr><td>ITEM:</td>
                    <td>
                        <select name = "item" id="item">
                        <option value="-1">Seleccione Item</option>
                        <?php
                        $omateriales = new Model_Materialesrequeridos();
                        $result = $omateriales->listamateriales();
                        foreach ($result as $key => $value) {
                        if($value['id'] == $iditem){
                            $sw = 'selected';
                        }else{
                            $sw = 0;
                        }
                        $id = $value['id'];
                        $desc = $value['descripcion'];
                        ?>
                        <option value="<?php echo $id ?>" <?php echo $sw ?> ><?php echo $desc ?></option>
                        <?php
                        }
                        ?>
                        </select>
                    </td>
                </tr>
                <tr><td></td><td style="font-size:10px" ></td></tr>
                <tr><td></td><td style="font-size:10px" ></td></tr>
                <tr><td>DEPARTAMENTO:</td>
                    <td>
                        <select name = "deptoid" id="deptoid" onchange="cargamunicipio()" >
                        <option value="-1">Seleccione Departamento</option>
                        <?php
                        $odeptos = new Model_Departamentos();
                        $result = $odeptos->listadepto();
                        foreach ($result as $key => $value) {
                        if($value['id'] == $iddepto){
                            $sw = 'selected';
                        }else{
                            $sw = 0;
                        }    
                        $id = $value['id'];
                        $depto = $value['departamento'];
                        ?>
                        <option value="<?php echo $id ?>" <?php echo $sw ?> ><?php echo $depto ?></option>
                        <?php
                        }
                        ?>
                        </select>
                    </td>
                </tr>
                <tr><td></td><td style="font-size:10px" ></td></tr>
                <tr><td></td><td style="font-size:10px" ></td></tr>
                <tr><td>Municipio:</td>
                    <td>
                        <select name = "muniid" id="muniid" >
                        <option value="-1">Seleccione Municipio</option>
                        <?php
                        $omuni = new Model_Municipios();
                        $result = $omuni->listamuni($iddepto);
                        foreach ($result as $key => $value) {
                        $id = $value['id'];
                        $muni = $value['municipio'];
                        ?>
                        <option value="<?php echo $id ?>"><?php echo $muni ?></option>
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
$id1 = $_POST['item'];
$id2 = $_POST['deptoid'];
$id3 = $_POST['muniid'];
if(!empty($resultado)){
?>
<div class="control-group">
    <label><?php echo utf8_encode('SU BUSQUEDA GENERO '.$resultado.' RESULTADOS, DESCARGUELOS ')?><a href="/reportebusquedaprov.php/?iditem=<?php echo $id1 ?>&iddepto=<?php echo $id2 ?>&idmuni=<?php echo $id3 ?>&user=<?php echo $username ?>&resp=<?php echo $resultado ?>" >AQUI</a></label>
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

    