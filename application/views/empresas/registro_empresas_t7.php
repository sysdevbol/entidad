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
.controzroup.success textarea {color:#468847}
.control-group.success input, 
.control-group.success select, 
.control-group.success textarea {border-color:#468847;-webkit-box-shadow:inset 0 1px 1px rgba(0,0,0,0.075);-moz-box-shadow:inset 0 1px 1px rgba(0,0,0,0.075);box-shadow:inset 0 1px 1px rgba(0,0,0,0.075)}
.control-group.success input:focus, 
.control-group.success select:focus, 
.control-group.success textarea:focus {border-color:#356635;-webkit-box-shadow:inset 0 1px 1px rgba(0,0,0,0.075), 0 0 6px #7aba7b;-moz-box-shadow:inset 0 1px 1px rgba(0,0,0,0.075), 0 0 6px #7aba7b;box-shadow:inset 0 1px 1px rgba(0,0,0,0.075), 0 0 6px #7aba7b}
.control-group.success .input-prepend .add-on, 
.control-group.success .input-append .add-on {color:#468847;background-color:#dff0d8;border-color:#468847}


#keyword {
  width: 200px;
  font-size: 1em;
}

#results {
  display: none;
  width: 204px;
  display: absolute;
  border: 1px solid #c0c0c0;

}

#results .item {
  padding: 3px;
  font-family: Helvetica;
  border-bottom: 1px solid #c0c0c0;
  text-align: left;
}

#results .item:last-child {
  border-bottom: 0px;
}

#results .item:hover {
  background-color: #f2f2f2;
  cursor: pointer;
}

</style>
<script>
var MIN_LENGTH = 2;

$( document ).ready(function() {
  $("#nombre_proponente").keyup(function() {
    var nombre_proponente = $("#nombre_proponente").val();
    if (nombre_proponente.length >= MIN_LENGTH) {

      $.get( "/ajax/autocomplete", { nombre_proponente: nombre_proponente } )
      .done(function( data ) {
        $('#results').html('');
        var results = jQuery.parseJSON(data);
        $(results).each(function(key, value) {
          $('#results').append('<div class="item">' + value + '</div>');
        })

          $('.item').click(function() {
            var text = $(this).html();
            $('#nombre_proponente').val(text);
          })

      });
    } else {
      $('#results').html('');
    }
  });

    $("#nombre_proponente").blur(function(){
        $("#results").fadeOut(500);
      })
        .focus(function() {   
          $("#results").show();
      });

});
</script>

<form class="form-horizontal" method="post" action="" name="basic_validate" id="basic_validate" novalidate="novalidate" >
  <header>
    <h2>Registra a tu Empresa (Asociaciones Accidentales II)</h2>
    <div>Complete toda la informacion solicitada por el Sistema</div>
  </header>
  <div class="titgrupo">
  <?php echo utf8_encode('SELECCIONE Y REGISTRE ASOCIADOS')?>
  </div>
  <div class="control-group">
    <label class="desc" id="title1" for="Field1"><?php echo utf8_encode('Denominación del Asociado:')?></label>
    <div>
        <?php echo Form::input('asociado',NULL,array('id'=>'asociado','class' => 'field text fn required')); ?>Ingrese PIN asociado:<input type="text" id="pin" name="pin" style="width: 70px;" class="field text fn required" />
    </div>
    <div style="float: left;" id="results">
    </div>
  </div>
  <div class="control-group">
    <label class="desc" id="title1" for="Field1"><?php echo utf8_encode('Porcentaje de Participacion:')?></label>
    <div>
        <?php echo Form::input('porcentaje_participacion',NULL,array('id'=>'porcentaje_participacion','class' => 'field text fn required')); ?>
    </div>
  </div>

  <div style="text-align: center;">
  <input type="submit" name="guardar" value="Guardar Asociados" class="btn btn-success"/>
  </div>
  </form>
  <form class="form-horizontal" method="post" action="" name="basic_validate" id="basic_validate" novalidate="novalidate" >
  <div class="titgrupo">
  <?php echo utf8_encode('REGISTRO DE ASOCIADOS')?>
  </div>
  <div class="control-group">
  <div class="row-fluid">    
    <div class="span12">
        <table border="1">
          <tr class="titgrupo">
            <td>
              Asociacion_Accidental
            </td>
            <td>
              Socios
            </td>
            <td>
              Porcentaje_de_Participacion
            </td>
            <td width="10">
              Empresa_Lider
            </td>
          </tr> 
          <?php
        $osociosarray = new Model_Sociosaccidental();
        $result = $osociosarray->listaprsocioaccidental($idempresas);
        foreach ($result as $key => $value) {
          $lidersw = $value['empresa_lider'];
          ?>
          <tr>
            <td>
              <?php echo $value['nombre_proponente_acc']; ?>
            </td>
            <td>
              <?php echo $value['nombre_proponente_socio']; ?>
            </td>
            <td>
              <?php echo $value['porcentaje_participacion']; ?>
            </td>
            <td>
              <?php
              $check="";
              if($lidersw == "Si"){
                $check = "checked";
              }
              ?>
              <input type="radio" name="empresalider" value="<?php echo $value['id']; ?>" <?php echo $check; ?>>
            </td>
          </tr>
          <?php 
        }
        //$resultf= json_decode(json_encode($result));
        //print_r($result);
        //echo count($result);
        
          //$sociosarray = $sociedadaccidental->listaprsocioaccidental(421);
          //print_r($sociosarray);
          ?>
        </table>
    </div>        
  </div>
  </div>

  <div style="text-align: right;">
  <input type="submit" name="guardar" value="Finalizar Proceso" class="btn btn-success"/>
  </div>

</form>
