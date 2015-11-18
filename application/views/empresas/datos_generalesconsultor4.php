<link rel="stylesheet" href="/media/css/jquery-ui.css" />
<script src="/media/js/jquery-ui.js"></script>
<script src="/media/js/jquery.validate.js"></script> 




<script>

$(function() {
 $.datepicker.regional['es'] = {
 closeText: 'Cerrar',
 prevText: '<Ant',
 nextText: 'Sig>',
 currentText: 'Hoy',
 monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
 monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
 dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
 dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
 dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa'],
 weekHeader: 'Sm',
 dateFormat: 'dd/mm/yy',
 firstDay: 1,
 isRTL: false,
 showMonthAfterYear: false,
 yearSuffix: ''
 };
 $.datepicker.setDefaults($.datepicker.regional['es']);

    $("#nit_fecha_expedicion,#matricula_fecha_expedicion,#testimonio_fecha_expedido").datepicker();
    $("#basic_validate").validate({
            rules: {
                required: {
                    required: true
                },
                date: {
                    required: true,
                    date: true
                },
                url: {
                    required: true,
                    url: true
                },
                email:{
                    required: true,
                    email: true
                }
            },
            errorClass: "help-inline",
            errorElement: "span",
            highlight: function(element, errorClass, validClass) {
                $(element).parents('.control-group').addClass('error');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).parents('.control-group').removeClass('error');
                $(element).parents('.control-group').addClass('success');
            }
        });
        $( "#nit_fecha_expedicion" ).change(function() {
         $( "#nit_fecha_expedicion" ).focus();
        });
        $( "#matricula_fecha_expedicion" ).change(function() {
         $( "#matricula_fecha_expedicion" ).focus();
        });
        $( "#testimonio_fecha_expedido" ).change(function() {
         $( "#testimonio_fecha_expedido" ).focus();
        });
        
        $( "#pais" ).change(function() {
            if($("#pais").val() == 1){
                $('#ciudad').prop('disabled', false);
                $("select#ciudad").val(1);
            }else{
                $('#ciudad').prop('disabled', 'disabled');
                $("select#ciudad").val(10);
            }
            
        }); 
});

</script>


<script type="text/javascript">

</script>
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
<?php
$idconsultor1 = $datosC['id'];
$tipo = $datosC['tipo'];
$clasificacion = 3;
$oexperienciarubro = new Model_Rubroarea();
$result1 = $oexperienciarubro->listaprrubrosareas($idconsultor1,$tipo,$clasificacion); 
?>
<div class="row mt">
  <div class="col-lg-12">
    <div class="form-panel">
        <form class="form-horizontal" method="post" action="" name="basic_validate" id="basic_validate" novalidate="novalidate" >
          <header>
          <h2>Formulario de Actualización</h2>
          <div>Llene de forma correcta cada dato solicitado.</div>
          </header>
          <div class="titgrupo">
          <?php echo 'EXPERIENCIA DEL CONSULTOR'?>
          </div>
          <div class="control-group">
          <label class="desc" id="title1" for="Field1"><?php echo utf8_encode('Nombre Contratante:')?></label>
          <div>

          <?php echo Form::input('nombre_contratante',NULL,array('id'=>'nombre_contratante','class' => 'field text fn required')); ?>
          </div>
          </div>
          <div class="control-group">
          <label class="desc" id="title1" for="Field1"><?php echo utf8_encode('Objeto del Contrato:')?></label>
          <div>

          <?php echo Form::input('objeto_contrato',NULL,array('id'=>'objeto_contrato','class' => 'field text fn required')); ?>
          </div>
          </div>
          <div class="control-group">
          <label class="desc" id="title1" for="Field1"><?php echo utf8_encode('Lugar del Contrato:')?></label>
          <div>

          <?php echo Form::input('lugar_contrato',NULL,array('id'=>'lugar_contrato','class' => 'field text fn required')); ?>
          </div>
          </div>
          <div class="control-group">
          <label class="desc" id="title1" for="Field1"><?php echo utf8_encode('Departamento:')?></label>
          <div>
          <SELECT name="departamento" id="departamento">
                        <option value="0">Seleccione un Departamento</option>
                            <option value="2">La Paz</option>
                            <option value="1">Chuquisaca</option>
                            <option value="4">Oruro</option>
                            <option value="5">Potosi</option>
                            <option value="7">Santa Cruz</option>
                            <option value="8">Beni</option>
                            <option value="3">Cochabamba</option>
                            <option value="9">Pando</option>
                            <option value="6">Tarija</option>
                     </SELECT>
          </div>
          </div>
          
          <div class="control-group">
          <label class="desc" id="title1" for="Field1"><?php echo utf8_encode('Monto del Contrato:')?></label>
          <div>

          <?php echo Form::input('monto_contrato',NULL,array('id'=>'monto_contrato','class' => 'field text fn required')); ?>
          </div>
          </div>
          <div class="control-group">
          <label class="desc" id="title1" for="Field1"><?php echo utf8_encode('Descripcion del Contrato:')?></label>
          <div>

          <?php echo Form::input('descripcion_contrato',NULL,array('id'=>'descripcion_contrato','class' => 'field text fn required')); ?>
          </div>
          </div>
          <div class="control-group">
          <label class="desc" id="title1" for="Field1"><?php echo utf8_encode('Tipo Experiencia:')?></label>
          <div>
          <input type="radio" id="id_tipoexperiencia" name="id_tipoexperiencia" value="1" checked /> Experiencia Especifica
          <input type="radio" id="id_tipoexperiencia" name="id_tipoexperiencia" value="2" /> Experiencia General
          </div>
          </div>
          <div class="control-group">
          <label class="desc" id="title1" for="Field1"><?php echo utf8_encode('La siguiente experiencia esta bajo el rubro de :')?></label>
          <div>
          <?php
          foreach ($result1 as $key1 => $value1) {
          if($value1['selected'] == '1'){
          ?>
          <?php echo  $value1['nombre'] ?> <input type="radio" name="rubro" id="rubro" value="<?php echo $value1['id'] ?>" /><br>
          <?php
          }
          } 
          ?>  
          Otro <input type="radio" name="rubro" id="rubro" value="-1" checked />
          </div>
          </div>
          <div class="control-group">     
          <label class="desc" id="title1" for="Field1"><?php echo utf8_encode('Fecha Inicio :')?></label>
          <div>
          <?php echo Form::input('inicio_contrato',NULL,array('id'=>'inicio_contrato','class' => 'field text fn required date')); ?>
          </div>
          </div>
          <div class="control-group">     
          <label class="desc" id="title1" for="Field1"><?php echo utf8_encode('Fecha Fin :')?></label>
          <div>
          <?php echo Form::input('fin_contrato',NULL,array('id'=>'fin_contrato','class' => 'field text fn required date')); ?>
          </div>
          </div>
          <div style="text-align: center;">
          <input type="hidden" name="idconsultor" id="idconsultor" value="<?php echo $datosC['id'] ?>"/>
          <input type="submit" name="guardar" value="Guardar Registro" class="btn btn-success"/>
          </div>
        </form>
        <form class="form-horizontal" method="post" action="" name="basic_validate" id="basic_validate" novalidate="novalidate" >
          <div class="control-group">
          <label class="desc" id="title1" for="Field1"><?php echo utf8_encode('Registros:')?></label>
          </div>
          <div>
          <div style="font-size:10px;float:left">
          <table border="1">
          <tr class="titgrupo">
          <td>
          Nombre_Contratante
          </td>
          <td>
          Objeto_del_Contrato
          </td>
          <td>
          Lugar Contrato
          </td>
          <td>
          Departamento  
          </td>
          <td>
          Monto_Final_del_Contrato_Bs
          </td>
          <td>
          Descripcion_del_Contrato
          </td>
          <td>
          Fecha_Inicio
          </td>
          <td>
          Fecha_Fin
          </td>
          <td>
          Experiencia bajo el rubro de ...
          </td>
          <td style="color:red">
            <input type="submit" name="eliminar" value="Eliminar"/>
          </td>
          </tr> 
          <?php
          $idconsultor = $datosC['id'];
          $oexperienciaarray = new Model_Experienciaconsultor();
          $result = $oexperienciaarray->listaprexperiencia($idconsultor);
          //print_r($result);
          foreach ($result as $key => $value) {
          if(!empty($_GET['idupdate']) and $value['id'] == $_GET['idupdate']){
          ?>
          <tr>
          <td>
          <?php echo Form::input('nombre_contratante1',$value['nombre_contratante'],array('id'=>'nombre_contratante1','class' => 'field text fn required')); ?>
          </td>
          <td>
          <?php echo Form::input('objeto_contrato1',$value['objeto_contrato'],array('id'=>'objeto_contrato1','class' => 'field text fn required')); ?>
          </td>
          <td>
          <?php echo Form::input('lugar_contrato1',$value['lugar_contrato'],array('id'=>'lugar_contrato1','class' => 'field text fn required')); ?>
          </td>
          <td>
            <SELECT name="departamento1" id="departamento1">
                        <option value="0">Seleccione un Departamento</option>
                            <option value="2">La Paz</option>
                            <option value="1">Chuquisaca</option>
                            <option value="4">Oruro</option>
                            <option value="5">Potosi</option>
                            <option value="7">Santa Cruz</option>
                            <option value="8">Beni</option>
                            <option value="3">Cochabamba</option>
                            <option value="9">Pando</option>
                            <option value="6">Tarija</option>
                     </SELECT>
          </td>
          <td>
          <?php echo Form::input('monto_contrato1',$value['monto_contrato'],array('id'=>'monto_contrato1','class' => 'field text fn required')); ?>
          </td>
          <td>
          <?php echo Form::input('descripcion_contrato1',$value['descripcion_contrato'],array('id'=>'descripcion_contrato1','class' => 'field text fn required')); ?>
          </td>
          <td>
          <?php
          $fechain = $value['inicio_contrato'];
          $arrayfecha = explode("-", $fechain);
          $fechain = $arrayfecha[2]."/".$arrayfecha[1]."/".$arrayfecha[0];
          ?>
          <?php echo Form::input('inicio_contrato1',$fechain,array('id'=>'inicio_contrato1','class' => 'field text fn required date')); ?>
          </td>
          <td>
          <?php
          $fechana = $value['fin_contrato'];
          $arrayfecha = explode("-", $fechana);
          $fechana = $arrayfecha[2]."/".$arrayfecha[1]."/".$arrayfecha[0];
          ?>
          <?php echo Form::input('fin_contrato1',$fechana,array('id'=>'fin_contrato1','class' => 'field text fn required date')); ?>
          </td>
          <td>
          <?php
          foreach ($result1 as $key1 => $value1) {
          if($value1['selected'] == '1'){
          ?>
          <?php echo  $value1['nombre'] ?> <input type="radio" name="rubro1" id="rubro1" value="<?php echo $value1['id'] ?>" <?php if($value['rubro'] == $value1['id']){ echo "checked"; } ?> /><br>
          <?php
          }
          } 
          ?>
          Otro <input type="radio" name="rubro1" id="rubro1" value="-1" <?php if($value['rubro'] == '-1'){ echo "checked"; } ?> /> 
          </td>
          <td>

          <input type="radio" id="tipo1" name="tipo1" value="1" checked /> Experiencia Especifica
          <input type="radio" id="tipo1" name="tipo1" value="2" /> Experiencia General

          </td>
          <td>
          <input type="hidden" name="idexp" id="idexp" value="<?php echo $_GET['idupdate']; ?>"/>
          <input type="submit" name="guardar" value="Actualizar" class="btn btn-success"/>
          <a href="javascript:history.back(1)" class="btn btn-danger">Cancelar</a>

          </td>
          </tr>
          <?php
          }else{
          ?>
          <tr>
          <td>
          <?php echo $value['nombre_contratante']; ?>
          </td>
          <td>
          <?php echo $value['objeto_contrato']; ?>
          </td>
          <td>
          <?php echo $value['lugar_contrato']; ?>
          </td>
          <td>
          <?php echo $value['departamento']; ?>
          </td>
          <td>
          <?php echo $value['monto_contrato']; ?>
          </td>
          <td>
          <?php echo $value['descripcion_contrato']; ?>
          </td>
          <td>
          <?php echo $value['inicio_contrato']; ?>
          </td>
          <td>
          <?php echo $value['fin_contrato']; ?>
          </td>
          <td>
          <?php 
          if($value['rubro'] == "-1"){
          echo "Otro";
          }else{
            foreach ($result1 as $key1 => $value1) {
            if($value['rubro'] == $value1['id']){
            echo  $value1['nombre'];
            }
            }
          } 
          ?>
          </td>
          <td>
          <?php echo $value['tipo']; ?>
          </td>
          <td>
          <a href="?idconsultor=<?php echo $idconsultor ?>&update=ok&idupdate=<?php echo $value['id']; ?>">Actualizar</a><br>
          <input type="radio" name="ideliminaexp" id="ideliminaexp" value="<?php echo $value['id']; ?>">

          </td>
          </tr>
          <?php
          } 
          }
          ?>
          </table>
          </div>
          </div>
        </form>
    </div>  
  </div><!-- col-lg-12-->      	
</div>


