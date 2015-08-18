<script type="text/javascript">
$(document).ready(function() {
var theme = 'energyblue';
var theme2 = 'office';
var source2 =
{
    datatype: "json",
    datafields: [
        {name: 'id'},
        {name: 'fecha_replica',type:'string'},
        {name: 'tabla',type:'string'},
        {name: 'cant_reg',type:'string'},
        {name: 'mensaje',type:'string'},
        {name: 'suma',type: 'int'},
    ],
    id: 'id',
    url: '/admin/ajax/listareplicas/',
};
var adapter = new $.jqx.dataAdapter(source2);   
                            // update data source.
$("#ordersGrid").jqxGrid({source: adapter});
$("#ordersGrid").jqxGrid('clearselection');

       var cellclass = function (row, columnfield, value) {
                return "colordefa";
        }
        $("#ordersGrid").jqxGrid(
                {
                    //source: dataAdapter,
                    theme: theme,
                    width: '100%',
                    height: 700,
                    //autoheight: "true",
                    //showstatusbar: true,
                    statusbarheight: 37,
                    //showaggregates: true,
                    //selectionmode: 'singlecell',
                    
                    keyboardnavigation: true,
                    //filterable: true,
                    //showfilterrow: true,
                    altrows: true,
                    enabletooltips: true,
                    columns: [
                        {text: '#',datafield: 'suma', width: 25},
                        {text: 'FECHA DE REPLICA', datafield: 'fecha_replica',editable: false,  width: 400,filtertype: 'textbox',cellclassname: cellclass},
                        {text: 'TABLA AFECTADA', datafield: 'tabla',editable: false,  width: 400,filtertype: 'textbox',cellclassname: cellclass},
                        {text: 'CANTIDAD REGISTROS REPLICADOS', datafield: 'cant_reg',editable: false,  width: 400,filtertype: 'textbox',cellclassname: cellclass},
                        {text: 'MENSAJE', datafield: 'mensaje',editable: false,  width: 400,filtertype: 'textbox',cellclassname: cellclass},
                        {text: 'Suma', datafield: 'SUMA', width: 140, hidden: true}
                    ]
                });

        $("#ordersGrid").bind("bindingcomplete", function(event) {
            var visibleRows = $('#ordersGrid').jqxGrid('getrows');
            var suma = 0;
            $.each(visibleRows, function(i, e) {
                suma += e.suma;
            })

        });
                $("#jqxMenu").jqxMenu({ width: '100%', height: '35px',theme:theme2});
            
                var centerItems = function () {
                    var firstItem = $($("#jqxMenu ul:first").children()[0]);
                    firstItem.css('margin-left', 0);
                    var width = 0;
                    var borderOffset = 2;
                    $.each($("#jqxMenu ul:first").children(), function () {
                        width += $(this).outerWidth(true) + borderOffset;
                    });
                    var menuWidth = $("#jqxMenu").outerWidth();
                    firstItem.css('margin-left', (menuWidth / 2 ) - (width / 2));
                }
                centerItems();
                $(window).resize(function () {
                    centerItems();
                });
        $('#datoscontrato').click(function() {
        var res = confirm("Esta seguro de actualizar la Tabla?");    
        if (res == true) {     
            $.ajax({
            url: "/admin/ajax/datoscontrato",
            data: {ids: 1},
            type: "POST",
            dataType: 'json',
            success: function(data){
                $("#ordersGrid").jqxGrid("updatebounddata");
            }
            });
        }           
        });
        
        $('#planillasporcontrato').click(function() {
        var res = confirm("Esta seguro de actualizar la Tabla?");    
        if (res == true) {  
            $.ajax({
            url: "/admin/ajax/planillasporcontrato",
            data: {ids: 1},
            type: "POST",
            dataType: 'json',
            success: function(data){
                $("#ordersGrid").jqxGrid("updatebounddata");
            }
            }); 
        }          
        });
        
        $('#proyectosexcel').click(function() {
        var res = confirm("Esta seguro de actualizar la Tabla?");    
        if (res == true) {  
            $.ajax({
            url: "/admin/ajax/proyectosexcel",
            data: {ids: 1},
            type: "POST",
            dataType: 'json',
            success: function(data){
                $("#ordersGrid").jqxGrid("updatebounddata");
            }
            }); 
        }          
        });
});
</script>
<style>
    .jqx-grid-statusbar{height: 35px!important;}
    .colordefa:not(.jqx-grid-cell-hover):not(.jqx-grid-cell-selected), .jqx-widget .red:not(.jqx-grid-cell-hover):not(.jqx-grid-cell-selected){
        color:#51759B;
        background-color: #FFE8E8;
    }

</style>
<div id="menuauxcontenido" class="row-fluid">
    <div id='jqxMenu'>
                <ul>
                    <li><a id="datoscontrato" href="javascript:void(0)">+ <img alt="Inicio" title="Dashboard" src="/media/images/icons/control/32/users.png" style="height: 25px;" align="absmiddle"/> Replicar Tabla DATOSCONTRATO</a></li>
                    <li><a id="planillasporcontrato" href="javascript:void(0)">+ <img alt="Inicio" title="Dashboard" src="/media/images/icons/control/32/users.png" style="height: 25px;" align="absmiddle"/> Replicar Tabla PLANILLASPORCONTRATO</a></li>
                    <li><a id="proyectosexcel" href="javascript:void(0)">+ <img alt="Inicio" title="Dashboard" src="/media/images/icons/control/32/users.png" style="height: 25px;" align="absmiddle"/> Replicar Tabla PROYECTOSEXCEL</a></li>
                </ul>
    </div>
</div>
<div class="row-fluid">    
    <div class="span12">
        <div id="ordersGrid">
        </div>
    </div>        
</div>