<script type="text/javascript">
$(document).ready(function() {
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
                                    {name: 'nombre_completo',type:'string'},
                                    {name: 'tipo',type:'string'},
                                    {name: 'procedencia',type:'string'},
                                    {name: 'departamento',type:'string'},
                                    {name: 'profesion',type:'string'},
                                    {name: 'ci',type:'string'},
                                    {name: 'telefonos',type:'string'},
                                    {name: 'celular',type:'string'},
                                    {name: 'mail',type:'string'},
                                    {name: 'estado'},
                                    {name: 'verificadoen',type:'string'},
                                    {name: 'suma'}
                                ],
                                id: 'id',
                                url: '/ajax/listaprconsultores',
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
                        {text: 'NOMBRE COMPLETO', datafield: 'nombre_completo',editable: false, width: 400, cellsalign: 'left', filtertype: 'textbox',filtercondition: 'contains',cellclassname: cellclass2},
                        {text: 'TIPO', datafield: 'tipo',editable: false, width: 120, cellsalign: 'left', filtertype: 'textbox',filtercondition: 'contains',cellclassname: cellclass2},
                        {text: 'PROCEDENCIA', datafield: 'procedencia',editable: false, width: 120, cellsalign: 'left', filtertype: 'textbox',filtercondition: 'contains',cellclassname: cellclass2},
                        {text: 'DEPARTAMENTO', datafield: 'departamento',editable: false, width: 120, cellsalign: 'left', filtertype: 'textbox',filtercondition: 'contains',cellclassname: cellclass2},
                        {text: 'PROFESION', datafield: 'profesion',editable: false, width: 100, cellsalign: 'left', filtertype: 'textbox',filtercondition: 'contains',cellclassname: cellclass2},                        
                        {text: 'CI', datafield: 'ci',editable: false, width: 100, cellsalign: 'left', filtertype: 'textbox',filtercondition: 'contains',cellclassname: cellclass2},
                        {text: 'TELEFONOS', datafield: 'telefonos',editable: false, width: 150, cellsalign: 'left', filtertype: 'textbox',filtercondition: 'contains',cellclassname: cellclass2},
                        {text: 'CELULAR', datafield: 'celular',editable: false, width: 150, cellsalign: 'left', filtertype: 'textbox',filtercondition: 'contains',cellclassname: cellclass2},
                        {text: 'MAIL', datafield: 'mail',editable: false, width: 200, cellsalign: 'left', filtertype: 'textbox',filtercondition: 'contains',cellclassname: cellclass2},
                        {text: 'ESTADO CONSULTOR', datafield: 'estado',editable: false, width: 150, cellsalign: 'left', filtertype: 'textbox',filtercondition: 'contains',cellclassname: cellclass2},
                        {text: 'SE VERIFICO EN ...', datafield: 'verificadoen',editable: false, width: 150, cellsalign: 'left', filtertype: 'textbox',filtercondition: 'contains',cellclassname: cellclass2}                       
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
        $("#excelExport").click(function() {
            $("#ordersGrid").jqxGrid('exportdata', 'csv', 'Listaproponentes');
        });
        $('#reportegeneral').bind('click', function() {
            var rowindex = $('#ordersGrid').jqxGrid('getselectedrowindex');
            if (rowindex > -1)
            {
                var dataRecord = $("#ordersGrid").jqxGrid('getrowdata', rowindex);
                location.href = "/reporte4.php/?ide="+dataRecord.id;
            }
            else
            {
                alert("Seleccione un CONSULTOR.");
            }
        });
        function createElements() {
            $('#window').jqxWindow({
                resizable: false,
                isModal: true,
                autoOpen: false,
                width: 400,
                height: 250,
                minWidth: 300,
                minHeight: 250,
                //cancelButton: $("#Cancel"), 
                modalOpacity: 0.01 
            });
            var offset = $("#ordersGrid").offset();
            $("#window").jqxWindow({ position: { x: parseInt(offset.left) + 300, y: parseInt(offset.top) + (200) } });
            $('#window').jqxWindow('focus');
        }
        createElements(); 
        $('#conformidad').click(function() {
            var rowindex = $('#ordersGrid').jqxGrid('getselectedrowindex');
            if (rowindex > -1){
                
                var dataRecord = $("#ordersGrid").jqxGrid('getrowdata', rowindex);
                $("#titulodoc").html('Confirmar Revision de Datos');
                                        
                $("#window").css('visibility', 'visible');
                $('#window').jqxWindow('open');
                $('#window').jqxWindow('focus');               
            }
            else {
                alert("Seleccione un consultor para dar su conformidad.");
            }
        });
        function createElements1() {
            $('#window1').jqxWindow({
                resizable: false,
                isModal: true,
                autoOpen: false,
                width: 400,
                height: 250,
                minWidth: 300,
                minHeight: 250,
                //cancelButton: $("#Cancel"), 
                modalOpacity: 0.01 
            });
            var offset = $("#ordersGrid").offset();
            $("#window1").jqxWindow({ position: { x: parseInt(offset.left) + 300, y: parseInt(offset.top) + (200) } });
            $('#window1').jqxWindow('focus');
        }
        createElements1(); 
        $('#calificar').click(function() {
            var rowindex = $('#ordersGrid').jqxGrid('getselectedrowindex');
            if (rowindex > -1){
                
                var dataRecord = $("#ordersGrid").jqxGrid('getrowdata', rowindex);
                $("#titulodoc1").html('Calificar Consutlor');
                                        
                $("#window1").css('visibility', 'visible');
                $('#window1').jqxWindow('open');
                $('#window1').jqxWindow('focus');
                var opciones="toolbar=0, location=0, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, width=700, height=450, top=85, left=140";
                window.open("/detalle_calificacion.php?idpls="+dataRecord.id+"&idcla=3","",opciones);               
            }
            else {
                alert("Seleccione Una entidad para su calificacion.");
            }
        });

 });    
  
  function guardarconfirmacion(){
        
    var res = confirm("Esta seguro de Habilitar al CONSULTOR.?");    
    if (res == true) {    
        var rowindex = $('#ordersGrid').jqxGrid('getselectedrowindex');
        if (rowindex > -1)
        {
        var dataRecord = $("#ordersGrid").jqxGrid('getrowdata', rowindex);
        var justifi = $("#observacion").val();
        var estado = $("#estado").val();
        $.ajax({
            url: "/ajax/guardarconfirmacionconsultor",
            data: {ide:dataRecord.id,estado: estado,obs:justifi},
            type: "POST",
            dataType: 'json',
            success: function(data){
            if(data == 1){
                //$("#msg").html('Registro Correcto. Actualice el Proyecto'); // Mostrar la respuestas del script PHP.
                $("#window").fadeOut(700,function (event) {
                    $('#window').jqxWindow('close');   
                });
                $("#ordersGrid").jqxGrid("updatebounddata");
                
            }else{
                //$("#msg").html('No se pudo Guardar.');
                alert('No se puede cerrar'); 
            }
            
            
            }
        });
        }
        else {
                alert("Seleccione un Estado.");
        } 
    }
    } 
    function guardarcalificacion(){
        
    var res1 = confirm("Esta seguro de Calificar al Consultor?");    
    if (res1 == true) { 
        var rowindex = $('#ordersGrid').jqxGrid('getselectedrowindex');   
        var dataRecords = $("#ordersGrid").jqxGrid('getrowdata', rowindex);
        var justifis = $("#observacions").val();
        var calificacion = $("#calificaciones").val();
        $.ajax({
            url: "/ajax/guardarcalificacion",
            data: {ide:dataRecords.id,calificacion:calificacion,comentario:justifis,idclasificacion:'3'},
            type: "POST",
            dataType: 'json',
            success: function(data){
            if(data == 1){
                //$("#msg").html('Registro Correcto. Actualice el Proyecto'); // Mostrar la respuestas del script PHP.
                $("#window1").fadeOut(700,function (event) {
                    $('#window1').jqxWindow('close');   
                });
                $("#ordersGrid").jqxGrid("updatebounddata");
                
            }else{
                //$("#msg").html('No se pudo Guardar.');
                alert('Primero necesita "Habilitar" al proponente.');
                $("#window1").fadeOut(700,function (event) {
                    $('#window1').jqxWindow('close');   
                }); 
            }
            
            
            }
        });
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
<div id="menuauxcontenido" class="row-fluid" style="visibility: hidden;">
    <div id='jqxMenu'>
                <ul>
                                  
                    <li>
                    <a href="#">+ <img alt="Inicio" title="Dashboard" src="/media/images/icons/control/32/print.png" style="height: 25px;" align="absmiddle"/> Reportes</a>
                        <ul style='width: 250px;'>
                            <li style="text-align: left;"><a id="reportegeneral" class="" href="javascript:void(0)" style="width: 100px; font-size: 10px;padding: 7px 1px 7px 3px;">Reporte General</a></li>
                        </ul>
                    </li>
                    <li>
                    <a href="#">+ <img alt="Inicio" title="Dashboard" src="/media/images/32/empty-clipboard.png" style="height: 25px;" align="absmiddle"/> Habilitar CONSULTOR</a>
                        <ul style='width: 250px;'>
                            <li style="text-align: left;"><a id="conformidad" class="" href="javascript:void(0)" style="width: 100px; font-size: 10px;padding: 7px 1px 7px 3px;">Conformidad de Datos</a></li>
                        </ul>
                    </li>
                    <!--<li>
                    <a href="#">+ <img alt="Inicio" title="Dashboard" src="/media/images/32/empty-clipboard.png" style="height: 25px;" align="absmiddle"/> Calificar Consultor</a>
                        <ul style='width: 250px;'>
                            <li style="text-align: left;"><a id="calificar" class="" href="javascript:void(0)" style="width: 100px; font-size: 10px;padding: 7px 1px 7px 3px;">Calificar</a></li>
                        </ul>
                    </li>-->
                    <li style="text-align: left;"><a id="excelExport" class="" href="?exportconsultor=ok" style="width: 100px; font-size: 15px;padding: 7px 1px 7px 3px;">EXCEL</a></li>
                </ul>
    </div>
</div>
<div class="row-fluid">    
    <div class="span12">
        <div id="ordersGrid">
        </div>
    </div>        
</div>
<div id="window" style="display: none;">
    <div ><section id="titulodoc"></section></div>
    <div>
        <label>Observaciones:</label>
        <textarea id="observacion" name="observacion" style="width: 97%; font-size: 14px;"></textarea>
        <label>Cambiar Estado:</label>
        <?php echo Form::select('estado', $estados,6,array('id'=>'estado','style'=> 'width: 99%;overflow: auto;')); ?>
        <div style="width: 100%;text-align: right;">
            <button class="btn btn-danger alertdanger" onclick="guardarconfirmacion();"><small>Guardar Datos</small></button>
        </div>
    </div>
</div>

<div id="window1" style="display: none;">
    <div ><section id="titulodoc1"></section></div>
    <div>
        <label>Observaciones:</label>
        <textarea id="observacions" name="observacions" style="width: 97%; font-size: 14px;"></textarea>
        <br>
        <label>Calificar:</label>
        <?php echo Form::input('calificaciones',NULL,array('id'=>'calificaciones')); ?> /100 pts (solo registre un dato numeral.)
        <div style="width: 100%;text-align: right;">
            <button class="btn btn-danger alertdanger" onclick="guardarcalificacion();"><small>Guardar</small></button>
        </div>
    </div>
</div>

