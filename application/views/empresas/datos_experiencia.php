<link rel="stylesheet" href="/media/css/jquery-ui.css" />
<script src="/media/js/jquery.validate.js"></script> 
<script type="text/javascript">
$(document).ready(function() {
    
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

    $("#fecha_ini_contrato,#fecha_fin_contrato").datepicker();
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
        $( "#fecha_ini_contrato" ).change(function() {
         $( "#fecha_ini_contrato" ).focus();
        });
        $( "#fecha_fin_contrato" ).change(function() {
         $( "#fecha_fin_contrato" ).focus();
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
    
    
    
$('input.number').number(true, 2);
var theme = 'darkblue';
var theme2 = 'office';
    //menu secundario  
        $("#jqxMenu").jqxMenu({ width: '100%', height: '35px',theme: theme2});
            
                var centerItems = function () {
                    var firstItem = $($("#jqxMenu ul:first").children()[0]);
                    firstItem.css('', 0);
                    var width = 0;
                    var borderOffset = 2;
                    $.each($("#jqxMenu ul:first").children(), function () {
                        width += $(this).outerWidth(true) + borderOffset;
                    });
                    var menuWidth = $("#jqxMenu").outerWidth();
                    firstItem.css('', (menuWidth / 2 ) - (width / 2));
                }
                centerItems();
                $(window).resize(function () {
                    centerItems();
                });
        $("#menuauxcontenido").css('visibility', 'visible');
   
    //fin menu secundario
        var source = {
                    datatype: "json",
                    datafields: [
                                    {name: 'id'},
                                    {name: 'id_entidad'},
                                    {name: 'contratante',type:'string'},
                                    {name: 'objeto_contrato',type:'string'},
                                    {name: 'departamento',type:'string'},
                                    {name: 'ubicacion',type:'string'},
                                    {name: 'relacion_estado',type:'string'},
                                    {name: 'area',type:'string'},
                                    {name: 'monto_contrato',type:'number'},
                                    {name: 'fecha_ini'},
                                    {name: 'fecha_fin'},
                                    {name: 'porcentaje_asociacion'},
                                    {name: 'nombre_socios',type:'string'},
                                    {name: 'tipo',type:'string'},
                                    {name: 'suma'}
                                ],
                                id: 'id',
                                url: '/ajax/listaexperiencia/?ide=<?php echo $ide;?>',
                            };
        var adapter = new $.jqx.dataAdapter(source);
        $("#ordersGrid").jqxGrid({source: adapter});
        //$("#ordersGrid").jqxGrid('clearselection');
        var cellclass2 = function (row, columnfield, value) {
            return "colordefa";
        }
        $("#ordersGrid").jqxGrid(
                {
                    //source: dataAdapter,
                    theme: theme,
                    width: '100%',
                    height: 400,
                    showstatusbar: true,
                    statusbarheight: 37,
                    showaggregates: true,
                    //selectionmode: 'singlecell',
                    
                    keyboardnavigation: true,
                    filterable: true,
                    showfilterrow: true,
                    altrows: true,
                    enabletooltips: true,
                    columns: [
                       {text: '#', datafield: 'suma', width: 40},
                       {text: 'CLASIFICACION', datafield: 'tipo',editable: false, width: 180, cellsalign: 'left', filtertype: 'textbox',filtercondition: 'contains',cellclassname: cellclass2},
                        {text: 'NOMBRE CONTRATANTE', datafield: 'contratante',editable: false, width: 400, cellsalign: 'left', filtertype: 'textbox',filtercondition: 'contains',cellclassname: cellclass2},
                        {text: 'OBJETO DE CONTRATACION', datafield: 'objeto_contrato',editable: false, width: 400, cellsalign: 'left', filtertype: 'textbox',filtercondition: 'contains',cellclassname: cellclass2},
                        {text: 'DEPARTAMENTO', datafield: 'departamento',editable: false, width: 200, cellsalign: 'left', filtertype: 'textbox',filtercondition: 'contains',cellclassname: cellclass2},                        
                        {text: 'UBICACION', datafield: 'ubicacion',editable: false, width: 400, cellsalign: 'left', filtertype: 'textbox',filtercondition: 'contains',cellclassname: cellclass2},                        
                        {text: 'RELACION ESTADO', datafield: 'relacion_estado',editable: false, width: 150, cellsalign: 'left', filtertype: 'textbox',filtercondition: 'contains',cellclassname: cellclass2},                        
                        {text: 'AREA', datafield: 'area',editable: false, width: 200, cellsalign: 'left', filtertype: 'textbox',filtercondition: 'contains',cellclassname: cellclass2},                        
                        {text: 'MONTO DEL CONTRATO', datafield: 'monto_contrato',editable: false, width: 150, cellsalign: 'right', filtertype: 'textbox',filtercondition: 'contains',cellclassname: cellclass2,cellsformat: 'F2'},
                        {text: 'FECHA INICIAL', datafield: 'fecha_ini',editable: false, width: 150, cellsalign: 'right', filtertype: 'textbox',filtercondition: 'contains',cellclassname: cellclass2},
                        {text: 'FECHA FINAL', datafield: 'fecha_fin',editable: false, width: 150, cellsalign: 'right', filtertype: 'textbox',filtercondition: 'contains',cellclassname: cellclass2},
                        {text: '% PARTICIPACION EN ASOCIACION', datafield: 'porcentaje_asociacion',editable: false, width: 150, cellsalign: 'right', filtertype: 'textbox',filtercondition: 'contains',cellclassname: cellclass2},
                        {text: 'NOMBRE DEL SOCIO(S)', datafield: 'nombre_socios',editable: false, width: 200, cellsalign: 'left', filtertype: 'textbox',filtercondition: 'contains',cellclassname: cellclass2}
                        
                    ]
        });
        $("#ordersGrid").bind("bindingcomplete", function(event) {
            var visibleRows = $('#ordersGrid').jqxGrid('getrows');
            var suma = 0;
            $.each(visibleRows, function(i, e) {
                suma += e.suma;
            })
            // $('#statusbarordersGrid').html('Cantidad: <b>' + suma + '</b>');

        });
        
        function createElements1() {
            $('#window1').jqxWindow({
                resizable: false,
                isModal: true,
                autoOpen: false,
                width: 420,
                height: 550,
                minWidth: 300,
                minHeight: 200,
                //cancelButton: $("#Cancel"), 
                modalOpacity: 0.01 
            });
            var offset = $("#ordersGrid").offset();
            $("#window1").jqxWindow({ position: { x: parseInt(offset.left) + 550, y: parseInt(offset.top) + (130) } });
            $('#window1').jqxWindow('focus');
        }
        createElements1();
        
        
        $('#registro').click(function() {
                    /*$("#contenidodoc").html('');
                    $("#titulodoc").html('');
                    $.ajax({
                        url: "/ajax/otrosverificaciondocumento",
                        data: {tipo: 21},
                        type: "POST",
                        dataType: 'json',
                        success: function(data){
                        //alert(data);
                        //$('#jqxgrid').jqxGrid('updatebounddata');
                        //alert(data.contenido);
                        $("#contenidodoc").html(data.contenido);
                        $("#titulodoc").html('Documentos Requeridos - '+data.titulo);
                        }
                    }); */          
                    $("#idex").val('');   
                    $("#window1").css('visibility', 'visible');
                    $('#window1').jqxWindow('open');
                    $('#window1').jqxWindow('focus');
                            
        });
        
        $('#editar').bind('click', function() {
            var rowindex = $('#ordersGrid').jqxGrid('getselectedrowindex');
            if (rowindex > -1)
            {
                var dataRecord = $("#ordersGrid").jqxGrid('getrowdata', rowindex);
                $.ajax({
                        url: "/ajax/editarexperiencia",
                        data: {idex: dataRecord.id},
                        type: "POST",
                        dataType: 'json',
                        success: function(data){
                        $("#contratante").val(data.contratante);
                        $("#objeto_contrato").val(data.objeto_contrato);
                        $("#ubicacion").val(data.ubicacion);
                        $("#monto_contrato").val(data.monto_contrato);
                        $("#fecha_ini_contrato").val(data.fecha_ini);
                        $("#fecha_fin_contrato").val(data.fecha_fin);
                        $("#porcentaje_asociacion").val(data.porcentaje_asociacion);
                        $("#nombre_socios").val(data.nombre_socios);
                        $("#fecha_registro").val(data.fecha_registro);
                        $("#idex").val(dataRecord.id);
                        if(data.tipo==1)
                        $("input[type=checkbox]").prop('checked', true);
                        
                        $("#window1").css('visibility', 'visible');
                        $('#window1').jqxWindow('open');
                        $('#window1').jqxWindow('focus');
                        }
                });
            }
            else
            {
                alert("Seleccione la Experiencia a Editar.");
            }
        });
        $('#eliminar').click(function() {      
        var rowindex = $('#ordersGrid').jqxGrid('getselectedrowindex');
            if (rowindex > -1)
            {
              var res = confirm("Esta seguro de eliminar este registro?");    
              if (res == true) {  
                var dataRecord = $("#ordersGrid").jqxGrid('getrowdata', rowindex);
                location.href = "/seguimiento/eliexperiencia/" + dataRecord.id;
              }                
            }
            else
            {
                alert("Seleccione la Experiencia a Editar.");
            }
           
        });
 });    
    
</script>
<style>
    .jqx-grid-statusbar{height: 35px!important;}
    .colordefa:not(.jqx-grid-cell-hover):not(.jqx-grid-cell-selected), .jqx-widget .red:not(.jqx-grid-cell-hover):not(.jqx-grid-cell-selected){
        color:#0378BC;
        background-color: #CDCDCD;
    }
</style>
<style>
* {
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
}
form >textarea{
    text-transform: uppercase;
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
  width: 100%;
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
<a>Presione una de las opciones:</a>              
<div id="menuauxcontenido" class="row-fluid" style="visibility: hidden;">
    <div id='jqxMenu'>
                <ul>
                    <li><a id="registro" class="" href="javascript:void(0)">+ <img alt="Inicio" title="Registro de toda la Experiencia" src="/media/images/icons/control/32/page.png" style="height: 25px;" align="absmiddle"/> <label style="padding: 3px 5px 7px 5px;cursor: pointer;">REGISTRAR EXPERIENCIA </label></a></li>
                    <li><a id="editar" class="" href="javascript:void(0)">+ <img alt="Inicio" title="Editar datos de la experiencia Registrada" src="/media/images/icons/control/32/page.png" style="height: 25px;" align="absmiddle"/>  <label style="padding: 3px 5px 7px 5px;cursor: pointer;">EDITAR EXPERIENCIA</label></a>
                    <li><a id="eliminar" class="" href="javascript:void(0)">+ <img alt="eli" title="Editar datos de la experiencia Registrada" src="/media/images/32/bin.png" style="height: 25px;" align="absmiddle"/>  <label style="padding: 3px 5px 7px 5px;cursor: pointer;">ELIMINAR EXPERIENCIA</label></a>
                    </li>
                </ul>
    </div>
</div>
<div class="row-fluid">    
    <div class="span12">
        <div id="ordersGrid">
        </div>
    </div>        
</div>
<div id="window1" style="display: none;">
    <div ><section>Registar Experiencia Laboral</section></div>
    <div>
        <div>
          <section>
          
                  <div class="form-panel">
                <label id="msg" style="float:right;color: red;"> </label>
                <form class="form-horizontal" method="post" action="" name="basic_validate" id="basic_validate" novalidate="novalidate" >
                     <div class="control-group">
                         <p>Nombre Contratante:</p>
                         <textarea id="contratante" name="contratante" style="width: 99%; font-size: 14px;" rows="1" class="required"></textarea>
                     </div>
                      <div class="control-group">
                         <p>Objeto de Contrato:</p>
                         <textarea id="objeto_contrato" name="objeto_contrato" style="width: 99%; font-size: 14px;" rows="1" class="required"></textarea>
                     </div>

                     <div class="control-group">
                     <p>Departamento:</p>
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

                     <div class="control-group">
                     <p>Ubicacion:</p>
                     <textarea id="ubicacion" name="ubicacion" style="width: 97%; font-size: 14px;" rows="1" class="required"></textarea>
                     </div>
                     
                     <div class="control-group">
                     <p>Monto del Contrato:</p>
                     <?php echo Form::input('monto_contrato',NULL,array('id'=>'monto_contrato','class' => 'number required','style'=>'text-align: right;')); ?>
                     </div>
                     
                     <div class="control-group">
                         <p>Fecha Inicio Contrato:</p>
                         <?php echo Form::input('fecha_ini_contrato',NULL,array('id'=>'fecha_ini_contrato','class' => 'required date')); ?>
                     </div>
                     
                     <div class="control-group">
                         <p>Fecha Fin Contrato:</p>
                         <?php echo Form::input('fecha_fin_contrato',NULL,array('id'=>'fecha_fin_contrato','class' => 'required date')); ?>
                     </div>
                     
                     <div class="control-group">
                         <p>(%)Participacion en Asociación:</p>
                         <?php echo Form::input('porcentaje_asociacion',NULL,array('id'=>'porcentaje_asociacion','class' => 'number','style'=>'text-align: right;')); ?>
                     </div>
                     <div class="control-group">
                         <p>Nombre del Socio(s):</p>
                         <textarea id="nombre_socios" name="nombre_socios" style="width: 99%; font-size: 14px;"></textarea>
                     </div>
                     <p><strong>Experiencia relacionada con el ESTADO:</strong> SI<input type="radio" name="estado" id="estado" value="SI" />NO<input type="radio" name="estado" id="estado" value="NO" checked /></p>
                     <p><strong>Experinecia especifica del area:</strong><span style="font-size:8px">(marcar si corresponde)</span></p>
                     <p>Capacitacion y talleres <input type="radio" name="area" id="area" value="1" /><br>
                        Asistencia Tecnica <input type="radio" name="area" id="area" value="2" /><br>
                        Seguimiento <input type="radio" name="area" id="area" value="3" /><br>
                        Ninguno <input type="radio" name="area" id="area" value="0" checked />
                     </p>
                     <?php echo Form::hidden('ide',$ide,array('id'=>'ide','class' => 'field text fn')); ?>
                     <?php echo Form::hidden('idex',null,array('id'=>'idex','class' => 'field text fn')); ?>
                     <p><?php echo Form::checkbox('tipo', 1, bool, array('id'=>'tipo','class' => 'field select medium')); ?><label style="font-weight: bold;">Experiencia Específica</label>(marcar si corresponde)</p>                  
                     <input type="submit" name="guardar" value="Guardar Experiencia" class="btn btn-primary" style="text-align: right;"/>
                </form>
          </div>
          </section>  
        </div>
    </div>
</div>