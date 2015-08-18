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
                                    {name: 'id_empresa'},
                                    {name: 'nombre_proponente',type:'string'},
                                    {name: 'tipo',type:'string'},
                                    {name: 'departamento',type:'string'},
                                    {name: 'PtsPMAR',type:'integer'},
                                    {name: 'PtsViviendaNueva',type:'integer'},
                                    {name: 'PtsSupervisor',type:'integer'},
                                    {name: 'suma'}
                                ],
                                id: 'id_empresa',
                                url: '/ajax/listaprcalificacion',
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
                    sortable: true,
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
                        {text: 'NOMBRE PROPONENTE', datafield: 'nombre_proponente',editable: false, width: 400, sortable: false, cellsalign: 'left', filtertype: 'textbox',filtercondition: 'contains',cellclassname: cellclass2},
                        {text: 'TIPO', datafield: 'tipo',editable: false, width: 100, sortable: false, cellsalign: 'left', filtertype: 'textbox',filtercondition: 'contains',cellclassname: cellclass2},
                        {text: 'DEPARTAMENTO', datafield: 'departamento',editable: false, width: 100, sortable: false, cellsalign: 'left', filtertype: 'textbox',filtercondition: 'contains',cellclassname: cellclass2},                        
                        {text: 'PUNTAJE Automatico<img src="/media/images/sort_both_menu.png"><br>PMAR', datafield: 'PtsPMAR',editable: false, width: 150, sortable: true, cellsalign: 'left', filtertype: 'textbox',filtercondition: 'contains',cellclassname: cellclass2},
                        {text: 'PUNTAJE Automatico<img src="/media/images/sort_both_menu.png"><br>VIVIENDA NUEVA', datafield: 'PtsViviendaNueva',editable: false, width: 150, sortable: true, cellsalign: 'left', filtertype: 'textbox',filtercondition: 'contains',cellclassname: cellclass2},
                        {text: 'PUNTAJE Manual<img src="/media/images/sort_both_menu.png">', datafield: 'PtsSupervisor',editable: false, width: 150, sortable: true, cellsalign: 'left', filtertype: 'textbox',filtercondition: 'contains',cellclassname: cellclass2}
                        
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
        $('#reportegeneral').bind('click', function() {
            var rowindex = $('#ordersGrid').jqxGrid('getselectedrowindex');
            if (rowindex > -1)
            {
                var dataRecord = $("#ordersGrid").jqxGrid('getrowdata', rowindex);
                location.href = "/reporte3.php/?ide="+dataRecord.id;
            }
            else
            {
                alert("Seleccione un Proveedor.");
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
                alert("Seleccione un proveedor para dar su conformidad.");
            }
        });

 });    
  /*
  function guardarconfirmacion(){
        
    var res = confirm("Esta seguro de Habilitar al Proveedor.?");    
    if (res == true) {    
        var rowindex = $('#ordersGrid').jqxGrid('getselectedrowindex');
        if (rowindex > -1)
        {
        var dataRecord = $("#ordersGrid").jqxGrid('getrowdata', rowindex);
        var justifi = $("#observacion").val();
        var estado = $("#estado").val();
        $.ajax({
            url: "/ajax/guardarconfirmacion",
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
    } */
</script>
<style>
    .jqx-grid-statusbar{height: 35px!important;}
    .colordefa:not(.jqx-grid-cell-hover):not(.jqx-grid-cell-selected), .jqx-widget .red:not(.jqx-grid-cell-hover):not(.jqx-grid-cell-selected){
        color:#0378BC;
        background-color: #CDCDCD;
    }
</style>
<!--
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
                    <a href="#">+ <img alt="Inicio" title="Dashboard" src="/media/images/32/empty-clipboard.png" style="height: 25px;" align="absmiddle"/> Habilitar Proveedor</a>
                        <ul style='width: 250px;'>
                            <li style="text-align: left;"><a id="conformidad" class="" href="javascript:void(0)" style="width: 100px; font-size: 10px;padding: 7px 1px 7px 3px;">Conformidad de Datos</a></li>
                        </ul>
                    </li>
                    
                </ul>
    </div>
</div>
-->
<div class="row-fluid">    
    <div class="span12">
        <div id="ordersGrid" style="font-size:9px">
        </div>
    </div>        
</div>
<!--
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
-->