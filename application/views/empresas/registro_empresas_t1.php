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
 dayNames: ['Domingo', 'Lunes', 'Martes', 'Mi�rcoles', 'Jueves', 'Viernes', 'S�bado'],
 dayNamesShort: ['Dom','Lun','Mar','Mi�','Juv','Vie','S�b'],
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

<form class="form-horizontal" method="post" action="" name="basic_validate" id="basic_validate" novalidate="novalidate" >
  <header>
    <h2>Registra a tu Empresa</h2>
    <div>Complete toda la informacion solicitada por el Sistema</div>
  </header>
  <div class="titgrupo">
  <?php echo utf8_encode('DATOS GENERALES DEL PROPONENTE')?>
  </div>
  <div class="control-group">
    <label class="desc" id="title1" for="Field1"><?php echo utf8_encode('Nombre del proponente o Raz�n Social:')?></label>
    <div>
      <textarea id="nombre_proponente" name="nombre_proponente" spellcheck="true" rows="3" cols="50" tabindex="4" class="required"></textarea>
      
    </div>
  </div>
  
  <div class="control-group">
  <label><?php echo utf8_encode('Domicilio Principal:')?></label>  
      <div>
        <?php echo utf8_encode('Pais')?>
        <?php echo Form::select('pais', $paises, NULL, array('id'=>'pais','class' => 'field select medium required')); ?>
        
        <?php echo utf8_encode('Ciudad')?>
        <?php echo Form::select('ciudad', $ciudades, NULL, array('id'=>'ciudad','class' => 'field select medium required')); ?>
      </div>
 
  </div>
  <div class="control-group">
      <label class="desc" id="title1" for="Field1"><?php echo utf8_encode('Direcci�n:')?></label>
      <div>       
      <textarea id="direccion" name="direccion" spellcheck="true" rows="1" cols="50" tabindex="4" class="required"></textarea>
      </div>
  </div>
  <div class="control-group">
      <label class="desc" id="title1" for="Field1"><?php echo utf8_encode('Rubro:')?></label>
      <div>       
      SUPERVISION<input type="radio" name="rubro" id = "rubro" value="49"/>
      CONSTRUCCION<input type="radio" name="rubro" id = "rubro" value="17" checked/>
      </div>
  </div>
    
   <div class="control-group">
    <label class="desc" id="title1" for="Field1"><?php echo utf8_encode('N�mero de NIT :')?></label>  
      <div>
        <?php echo Form::input('nit',NULL,array('id'=>'nit','class' => 'field text fn required')); ?>
      </div>
   </div>   
  
  <div class="control-group">     
  <label class="desc" id="title1" for="Field1"><?php echo utf8_encode('Fecha de Expedici�n del NIT :')?></label>
  <div>
        <?php echo Form::input('nit_fecha_expedicion',NULL,array('id'=>'nit_fecha_expedicion','class' => 'field text fn required date')); ?>
    </div>
  </div>
  
 <div class="control-group">
  <label class="desc" id="title1" for="Field1"><?php echo utf8_encode('N�mero de Matricula :')?></label>
    <div>
        
        <?php echo Form::input('matricula',NULL,array('id'=>'matricula','class' => 'field text fn required')); ?>
    </div>
  </div>
  <div class="control-group">
  <label class="desc" id="title1" for="Field1"><?php echo utf8_encode('Fecha de Expedici�n de la Matricula:')?></label>
    <div>
        <?php echo Form::input('matricula_fecha_expedicion',NULL,array('id'=>'matricula_fecha_expedicion','class' => 'field text fn required date')); ?>
    </div>
  </div>
  
  
  
  <div class="titgrupo">
  <?php echo utf8_encode('DATOS COMPLEMENTARIOS DEL PROPONENTE')?>
  </div>
  <div class="control-group">
      <div>
      <label class="desc" id="title1" for="Field1"><?php echo utf8_encode('DATOS DEL REPRESENTANTE LEGAL')?></label>
      </div>
  </div>
  <div class="control-group">
      <label class="desc" id="title1" for="Field1"><?php echo utf8_encode('Nombre (s):')?></label>
      <div>
            <?php echo Form::input('nombres_representante',NULL,array('id'=>'nombres_representante','class' => 'field text fn required')); ?>
      </div>
  </div>
  
  <div class="control-group">
      <label class="desc" id="title1" for="Field1"><?php echo utf8_encode('Ap. Paterno:')?></label>
      <div>
            <?php echo Form::input('paterno_representante',NULL,array('id'=>'paterno_representante','class' => 'field text fn ')); ?>
      </div>
  </div>
  
  <div class="control-group">
  <label class="desc" id="title1" for="Field1"><?php echo utf8_encode('Ap. Materno:')?></label>
  <div>
        
        <?php echo Form::input('materno_representante',NULL,array('id'=>'materno_representante','class' => 'field text fn ')); ?>
  </div>
  </div>
  <div class="control-group">
  <label class="desc" id="" for=""><?php echo utf8_encode('Cedula de Identidad:')?></label>
  <div>
        <?php echo Form::input('ci_representante',NULL,array('id'=>'ci_representante','class' => 'field text fn required')); ?>
        
        <label class="desc" id="" for=""><?php echo utf8_encode('Expedido en:')?></label>
        <?php echo Form::select('ci_expedido', $ciudades, NULL, array('id'=>'ci_expedido','class' => 'field medium required')); ?>
  </div>
  </div>
    
  <div class="control-group">
      <div>
      <label class="desc" id="title1" for="Field1"><?php echo utf8_encode('PODER DEL REPRESENTANTE LEGAL')?></label>
      </div>
  </div>
  <div class="control-group">
  <label class="desc" id="title1" for="Field1"><?php echo utf8_encode('N�mero de Tetimonio:')?></label>
  <div>
        <?php echo Form::input('testimonio',NULL,array('id'=>'testimonio')); ?>
  </div>
  </div>
  <div class="control-group">
  <label class="desc" id="title1" for="Field1"><?php echo utf8_encode('Lugar de Emisi�n:')?></label>
  <div>
        <textarea id="testimonio_emision" name="testimonio_emision" spellcheck="true" rows="2" cols="50" tabindex="4"></textarea>
  </div>
  </div>
  <div class="control-group">
  <label class="desc" id="title1" for="Field1"><?php echo utf8_encode('Fecha de Expedici�n de Testimonio:')?></label>
    <div>
        <?php echo Form::input('testimonio_fecha_expedido',NULL,array('id'=>'testimonio_fecha_expedido')); ?>
    </div>
  </div>
  <div class="titgrupo">
  <?php echo utf8_encode('INFORMACI�N SOBRE NOTIFICACIONES/COMUNICACIONES(Toda la Informaci�n legal sera remitida a las siguientes direcciones)')?>
  </div>
  <div class="control-group">
  <label class="desc" id="title1" for="Field1"><?php echo utf8_encode('N�mero de Fax:')?></label>
  <div>
        <?php echo Form::input('fax',NULL,array('id'=>'fax','class' => 'field text fn ')); ?>
  </div>
  </div>
  <div class="control-group">
  <label class="desc" id="title1" for="Field1"><?php echo utf8_encode('N�mero de Telefono:')?></label>
  <div>
        <?php echo Form::input('telefonos',NULL,array('id'=>'telefonos','class' => 'field text fn ')); ?>
  </div>
  </div>
  <div class="control-group">
  <label class="desc" id="title1" for="Field1"><?php echo utf8_encode('N�mero de Celular:')?></label>
  <div>
        <?php echo Form::input('celular',NULL,array('id'=>'celular','class' => 'field text fn required')); ?>
  </div>
  </div>
  <div class="control-group">
  <label class="desc" id="title1" for="Field1"><?php echo utf8_encode('Correo Electr�nico:')?></label>
  <div>
        <?php echo Form::input('mail',NULL,array('id'=>'mail','class' => 'field text fn required email')); ?>
  </div>
  </div>
  <div class="control-group">
  <label class="desc" id="title1" for="Field1"><?php echo utf8_encode('Correo Electr�nico Alternativo:')?></label>
  <div>
        <?php echo Form::input('mail_opcional',NULL,array('id'=>'mail_opcional','class' => 'field text fn')); ?>
  </div>
  </div>
  <div style="text-align: center;">
  <input type="submit" name="guardar" value="Guardar Registro" class="btn btn-success"/>
  <a href="javascript:history.back(1)" class="btn btn-danger">Volver Atr&aacute;s</a>
  </div>
  
</form>

<!--div>
    <label class="desc" id="title4" for="Field4">
      Message
    </label>
  
    <div>
      <input id="Field1" name="Field1" type="text" class="field text fn" value="" size="8" tabindex="1"/>
    </div>
  </div>
    
  <div>
    <fieldset>
    
      <legend id="title5" class="desc">
        Select a Choice
      </legend>
      
      <div>
      	<input id="radioDefault_5" name="Field5" type="hidden" value="">
      	<div>
      		<input id="Field5_0" name="Field5" type="radio" value="First Choice" tabindex="5" checked="checked">
      		<label class="choice" for="Field5_0">First Choice</label>
      	</div>
        <div>
        	<input id="Field5_1" name="Field5" type="radio" value="Second Choice" tabindex="6">
        	<label class="choice" for="Field5_1">Second Choice</label>
        </div>
        <div>
        	<input id="Field5_2" name="Field5" type="radio" value="Third Choice" tabindex="7">
        	<label class="choice" for="Field5_2">Third Choice</label>
        </div>
      </div>
    </fieldset>
  </div-->
  
  <!--div>
    <fieldset>
      <legend id="title6" class="desc">
        Check All That Apply
      </legend>
      <div>
      <div>
      	<input id="Field6" name="Field6" type="checkbox" value="First Choice" tabindex="8">
      	<label class="choice" for="Field6">First Choice</label>
      </div>
      <div>
      	<input id="Field7" name="Field7" type="checkbox" value="Second Choice" tabindex="9">
      	<label class="choice" for="Field7">Second Choice</label>
      </div>
      <div>
      	<input id="Field8" name="Field8" type="checkbox" value="Third Choice" tabindex="10">
      	<label class="choice" for="Field8">Third Choice</label>
        <input id="Field3" name="Field3" type="email" spellcheck="false" value="" maxlength="255" tabindex="3"> 
      </span>
      </div>
    </fieldset>
  </div>
  
  <div>
    <label class="desc" id="title106" for="Field106">
    	Select a Choice
    </label>
    <div>
    <select id="Field106" name="Field106" class="field select medium" tabindex="11"> 
      <option value="First Choice">First Choice</option>
      <option value="Second Choice">Second Choice</option>
      <option value="Third Choice">Third Choice</option>
    </select>
    </div>
  </div>
  
  <div>
		<div>
  		<input id="saveForm" name="saveForm" type="submit" value="Submit">
    </div>
	</div>
    </div-->