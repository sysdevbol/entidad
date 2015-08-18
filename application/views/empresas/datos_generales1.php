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
<div class="row mt">
          		<div class="col-lg-12">
                  <div class="form-panel">
                      <form class="form-horizontal" method="post" action="" name="basic_validate" id="basic_validate" novalidate="novalidate" >
                          <header>
                            <h2>Formulario de Actualización</h2>
                            <div>Llene de forma correcta cada dato solicitado.</div>
                          </header>
                          <div class="titgrupo">
                          <?php echo 'DATOS GENERALES DEL PROPONENTE'?>
                          </div>
                          <div class="control-group">
                            <label class="desc" id="title1" for="Field1"><?php echo 'Nombre del proponente o Razón Social:'?></label>
                            <div>
                              <textarea id="nombre_proponente" name="nombre_proponente" spellcheck="true" rows="3" cols="50" tabindex="4" class="required"><?php echo $datosE['nombre_proponente'];?></textarea>
                              
                            </div>
                          </div>
                          
                          <div class="control-group">
                          <label><?php echo 'Domicilio Principal:'?></label>  
                              <div>
                                <?php echo 'Pais'?>
                                <?php echo Form::select('pais', $paises, $datosE['pais'], array('id'=>'pais','class' => 'field select medium required')); ?>
                                
                                <?php echo 'Ciudad'?>
                                <?php echo Form::select('ciudad', $ciudades, $datosE['ciudad'], array('id'=>'ciudad','class' => 'field select medium required')); ?>
                              </div>
                         
                          </div>
                          <div class="control-group">
                              <label class="desc" id="title1" for="Field1"><?php echo 'Dirección:'?></label>
                              <div>       
                              <textarea id="direccion" name="direccion" spellcheck="true" rows="1" cols="50" tabindex="4" class="required"><?php echo $datosE['direccion'];?></textarea>
                              </div>
                          </div>
                          
                            
                           <div class="control-group">
                            <label class="desc" id="title1" for="Field1"><?php echo 'Número de NIT :'?></label>  
                              <div>
                                <?php echo Form::input('nit',$datosE['nit'],array('id'=>'nit','class' => 'field text fn required')); ?>
                              </div>
                           </div>   
                          
                          <div class="control-group">     
                          <label class="desc" id="title1" for="Field1"><?php echo 'Fecha de Expedición del NIT :'?></label>
                          <div>
                                <?php echo Form::input('nit_fecha_expedicion',date::dateformat($datosE['nit_fecha_expedicion']),array('id'=>'nit_fecha_expedicion','class' => 'field text fn required date')); ?>
                            </div>
                          </div>
                          
                         <div class="control-group">
                          <label class="desc" id="title1" for="Field1"><?php echo 'Número de Matricula :'?></label>
                            <div>
                                
                                <?php echo Form::input('matricula',$datosE['matricula'],array('id'=>'matricula','class' => 'field text fn required')); ?>
                            </div>
                          </div>
                          <div class="control-group">
                          <label class="desc" id="title1" for="Field1"><?php echo 'Fecha de Expedición de la Matricula:'?></label>
                            <div>
                                <?php echo Form::input('matricula_fecha_expedicion',date::dateformat($datosE['matricula_fecha_expedicion']),array('id'=>'matricula_fecha_expedicion','class' => 'field text fn required date')); ?>
                            </div>
                          </div>
                          
                          
                          
                          <div class="titgrupo">
                          <?php echo 'DATOS COMPLEMENTARIOS DEL PROPONENTE'?>
                          </div>
                          <div class="control-group">
                              <div>
                              <label class="desc" id="title1" for="Field1"><?php echo 'DATOS DEL REPRESENTANTE LEGAL'?></label>
                              </div>
                          </div>
                          <div class="control-group">
                              <label class="desc" id="title1" for="Field1"><?php echo 'Nombre (s):'?></label>
                              <div>
                                    <?php echo Form::input('nombres_representante',$datosE['nombres_representante'],array('id'=>'nombres_representante','class' => 'field text fn required')); ?>
                              </div>
                          </div>
                          
                          <div class="control-group">
                              <label class="desc" id="title1" for="Field1"><?php echo 'Ap. Paterno:'?></label>
                              <div>
                                    <?php echo Form::input('paterno_representante',$datosE['paterno_representante'],array('id'=>'paterno_representante','class' => 'field text fn required')); ?>
                              </div>
                          </div>
                          
                          <div class="control-group">
                          <label class="desc" id="title1" for="Field1"><?php echo 'Ap. Materno:'?></label>
                          <div>
                                
                                <?php echo Form::input('materno_representante',$datosE['materno_representante'],array('id'=>'materno_representante','class' => 'field text fn required')); ?>
                          </div>
                          </div>
                          <div class="control-group">
                          <label class="desc" id="" for=""><?php echo 'Cedula de Identidad:'?></label>
                          <div>
                                <?php echo Form::input('ci_representante',$datosE['ci_representante'],array('id'=>'ci_representante','class' => 'field text fn required')); ?>
                                
                                <label class="desc" id="" for=""><?php echo 'Expedido en:'?></label>
                                <?php echo Form::select('ci_expedido', $ciudades, $datosE['ci_expedido'], array('id'=>'ci_expedido','class' => 'field medium required')); ?>
                          </div>
                          </div>
                            
                          <div class="control-group">
                              <div>
                              <label class="desc" id="title1" for="Field1"><?php echo 'PODER DEL REPRESENTANTE LEGAL'?></label>
                              </div>
                          </div>
                          <div class="control-group">
                          <label class="desc" id="title1" for="Field1"><?php echo 'Número de Tetimonio:'?></label>
                          <div>
                                <?php echo Form::input('testimonio',$datosE['testimonio'],array('id'=>'testimonio','class' => 'field text fn required')); ?>
                          </div>
                          </div>
                          <div class="control-group">
                          <label class="desc" id="title1" for="Field1"><?php echo 'Lugar de Emisión:'?></label>
                          <div>
                                <textarea id="testimonio_emision" name="testimonio_emision" spellcheck="true" rows="2" cols="50" tabindex="4" class="required"><?php echo $datosE['testimonio_emision'];?></textarea>
                          </div>
                          </div>
                          <div class="control-group">
                          <label class="desc" id="title1" for="Field1"><?php echo 'Fecha de Expedición de Testimonio:'?></label>
                            <div>
                                <?php echo Form::input('testimonio_fecha_expedido',date::dateformat($datosE['testimonio_fecha_expedido']),array('id'=>'testimonio_fecha_expedido','class' => 'field text fn date required')); ?>
                            </div>
                          </div>
                          
                          
                          <div class="titgrupo">
                          <?php echo 'INFORMACIÓN SOBRE NOTIFICACIONES/COMUNICACIONES(Toda la Información legal sera remitida a las siguientes direcciones)'?>
                          </div>
                          <div class="control-group">
                          <label class="desc" id="title1" for="Field1"><?php echo 'Número de Fax:'?></label>
                          <div>
                                <?php echo Form::input('fax',$datosE['fax'],array('id'=>'fax','class' => 'field text fn required')); ?>
                          </div>
                          </div>
                          <div class="control-group">
                          <label class="desc" id="title1" for="Field1"><?php echo 'Número de Telefono:'?></label>
                          <div>
                                <?php echo Form::input('telefonos',$datosE['telefonos'],array('id'=>'telefonos','class' => 'field text fn required')); ?>
                          </div>
                          </div>
                          <div class="control-group">
                          <label class="desc" id="title1" for="Field1"><?php echo 'Número de Celular:'?></label>
                          <div>
                                <?php echo Form::input('celular',$datosE['celular'],array('id'=>'celular','class' => 'field text fn required')); ?>
                          </div>
                          </div>
                          <div class="control-group">
                          <label class="desc" id="title1" for="Field1"><?php echo 'Correo Electrónico:'?></label>
                          <div>
                                <?php echo Form::input('mail',$datosE['mail'],array('id'=>'mail','class' => 'field text fn required email', 'readonly'=>'')); ?>
                          </div>
                          </div>
                          <div class="control-group">
                          <label class="desc" id="title1" for="Field1"><?php echo 'Correo Electrónico Alternativo:'?></label>
                          <div>
                                <?php echo Form::input('mail_opcional',$datosE['mail_opcional'],array('id'=>'mail_opcional','class' => 'field text fn')); ?>
                          </div>
                          </div>
                          <div style="text-align: center;">
                          <?php echo Form::hidden('ide',$datosE['id'],array('id'=>'ide','class' => 'field text fn')); ?>
                          <input type="submit" name="guardar" value="Actualizar Información" class="btn btn-success"/>
                          </div>
                          
                          </div>
                      </form>
                  </div>
          		</div><!-- col-lg-12-->      	
          	</div>