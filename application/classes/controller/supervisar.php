<?php
defined('SYSPATH') or die('Acceso denegado');
class Controller_Supervisar extends Controller_IndexTemplate{
    protected $user;
    protected $menus;
    public function before() 
    {
        $auth =  Auth::instance();     
        if($auth->logged_in())
        {        
            $session=Session::instance();
            $this->user=$session->get('auth_user');
            $oNivel=New Model_niveles();
            $this->menus=$oNivel->menus($this->user->nivel);
        parent::before();
        $this->template->titulo='<v>Supervisar / </v>';
        $this->template->username=$this->user->nombre;
        if($this->user->theme!=null)
            {$this->template->theme=$this->user->theme; }
        }
        else
        {
            $url= substr($_SERVER['REQUEST_URI'],1);
            $this->request->redirect('/registroempresas/selecciontipo?url='.$url);
        }        
    }
    public function after() 
    {        
        $this->template->menutop = View::factory('templates/menutop')->bind('menus',$this->menus)->set('controller', 'correspondence');
        $oSM=New Model_menus();
        $submenus=$oSM->submenus('correspondence');
        $this->template->submenu = View::factory('templates/submenu')->bind('smenus',$submenus)->set('titulo','Correspondencia');        
        parent::after();
    }      
    
    public function action_listarempresas(){
        if(!empty($_GET['exportentidad']) and $_GET['exportentidad'] == 'ok'){
            $this->exportarentidad();
        }
        $vista = 'supervisor/listar_empresas';
        $this->template->title.='Lista de Empresas';
        $this->template->titulo='Lista de Empresas registradas';
        $this->template->descripcion = '';
        $this->template->styles = array(
            'media/jqwidgets/styles/jqx.darkblue.css' => 'all',
            'media/jqwidgets/styles/jqx.office.css' => 'all',
            'media/jqwidgets/styles/jqx.base.css' => 'all',
        );
        $this->template->scripts = array(
            'media/jqwidgets/globalization/globalize.js',
            'media/jqwidgets/jqxcalendar.js',
            'media/jqwidgets/jqxdatetimeinput.js',
            'media/jqwidgets/jqxwindow.js',
            'media/jqwidgets/scripts/gettheme.js',
            'media/jqwidgets/jqxnumberinput.js',
            'media/jqwidgets/jqxgrid.aggregates.js',
            'media/jqwidgets/jqxgrid.columnsresize.js',
            'media/jqwidgets/jqxgrid.columnsreorder.js',
            'media/jqwidgets/jqxdata.export.js',
            'media/jqwidgets/jqxgrid.export.js',
            'media/jqwidgets/jqxgrid.edit.js',
            'media/jqwidgets/jqxgrid.grouping.js',
            'media/jqwidgets/jqxgrid.selection.js',
            'media/jqwidgets/jqxgrid.filter.js',
            'media/jqwidgets/jqxgrid.pager.js',
            'media/jqwidgets/jqxgrid.sort.js',
            'media/jqwidgets/jqxdata.js',
            'media/jqwidgets/jqxgrid.js',
            'media/jqwidgets/jqxdropdownlist.js',
            'media/jqwidgets/jqxlistbox.js',
            'media/jqwidgets/jqxcheckbox.js',
            'media/jqwidgets/jqxmenu.js',
            'media/jqwidgets/jqxscrollbar.js',
            'media/jqwidgets/jqxbuttons.js',
            'media/jqwidgets/jqxcore.js',
            'media/js/jquery.number.min.js',
            

        );
        $selestado = array('4','5');
        $oEstados = ORM::factory('estados')->where('id','IN',$selestado)->find_all();
        $estados = array();
        foreach ($oEstados as $e) {
            $estados[$e->id] = $e->estado;
        }
        
        
        $user = $this->user;
        $idu = $this->user->id;
        $this->template->content = View::factory($vista)
                                   ->bind('user', $user)
                                   ->bind('estados', $estados)
                                   ->bind('idu', $idu);
    }
    public function action_rankingconsultores(){
        $vista = 'supervisor/ranking_consultores';
        $this->template->title.='Ranking de Entidades Ejecutoras';
        $this->template->titulo='Ranking de Entidades Ejecutoras';
        $this->template->descripcion = '';
        
        $this->template->styles = array(
            'media/jqwidgets/styles/jqx.darkblue.css' => 'all',
            'media/jqwidgets/styles/jqx.office.css' => 'all',
            'media/jqwidgets/styles/jqx.base.css' => 'all',
        );
        $this->template->scripts = array(
            'media/jqwidgets/globalization/globalize.js',
            'media/jqwidgets/jqxcalendar.js',
            'media/jqwidgets/jqxdatetimeinput.js',
            'media/jqwidgets/jqxwindow.js',
            'media/jqwidgets/scripts/gettheme.js',
            'media/jqwidgets/jqxnumberinput.js',
            'media/jqwidgets/jqxgrid.aggregates.js',
            'media/jqwidgets/jqxgrid.columnsresize.js',
            'media/jqwidgets/jqxgrid.columnsreorder.js',
            'media/jqwidgets/jqxdata.export.js',
            'media/jqwidgets/jqxgrid.export.js',
            'media/jqwidgets/jqxgrid.edit.js',
            'media/jqwidgets/jqxgrid.grouping.js',
            'media/jqwidgets/jqxgrid.selection.js',
            'media/jqwidgets/jqxgrid.filter.js',
            'media/jqwidgets/jqxgrid.pager.js',
            'media/jqwidgets/jqxgrid.sort.js',
            'media/jqwidgets/jqxdata.js',
            'media/jqwidgets/jqxgrid.js',
            'media/jqwidgets/jqxdropdownlist.js',
            'media/jqwidgets/jqxlistbox.js',
            'media/jqwidgets/jqxcheckbox.js',
            'media/jqwidgets/jqxmenu.js',
            'media/jqwidgets/jqxscrollbar.js',
            'media/jqwidgets/jqxbuttons.js',
            'media/jqwidgets/jqxcore.js',
            'media/js/jquery.number.min.js',
            

        );
        
        //$selestado = array('4','5');
        //$oEstados = ORM::factory('estados')->where('id','IN',$selestado)->find_all();
        //$estados = array();
        //foreach ($oEstados as $e) {
        //    $estados[$e->id] = $e->estado;
        //}
        
        
        $user = $this->user;
        $idu = $this->user->id;
        $this->template->content = View::factory($vista)
                                   ->bind('user', $user)
                                   ->bind('idu', $idu);
                                   
    }
    public function action_rankingentidades(){
        $vista = 'supervisor/ranking_entidades';
        $this->template->title.='Ranking de Entidades Ejecutoras';
        $this->template->titulo='Ranking de Entidades Ejecutoras';
        $this->template->descripcion = '';
        
        $this->template->styles = array(
            'media/jqwidgets/styles/jqx.darkblue.css' => 'all',
            'media/jqwidgets/styles/jqx.office.css' => 'all',
            'media/jqwidgets/styles/jqx.base.css' => 'all',
        );
        $this->template->scripts = array(
            'media/jqwidgets/globalization/globalize.js',
            'media/jqwidgets/jqxcalendar.js',
            'media/jqwidgets/jqxdatetimeinput.js',
            'media/jqwidgets/jqxwindow.js',
            'media/jqwidgets/scripts/gettheme.js',
            'media/jqwidgets/jqxnumberinput.js',
            'media/jqwidgets/jqxgrid.aggregates.js',
            'media/jqwidgets/jqxgrid.columnsresize.js',
            'media/jqwidgets/jqxgrid.columnsreorder.js',
            'media/jqwidgets/jqxdata.export.js',
            'media/jqwidgets/jqxgrid.export.js',
            'media/jqwidgets/jqxgrid.edit.js',
            'media/jqwidgets/jqxgrid.grouping.js',
            'media/jqwidgets/jqxgrid.selection.js',
            'media/jqwidgets/jqxgrid.filter.js',
            'media/jqwidgets/jqxgrid.pager.js',
            'media/jqwidgets/jqxgrid.sort.js',
            'media/jqwidgets/jqxdata.js',
            'media/jqwidgets/jqxgrid.js',
            'media/jqwidgets/jqxdropdownlist.js',
            'media/jqwidgets/jqxlistbox.js',
            'media/jqwidgets/jqxcheckbox.js',
            'media/jqwidgets/jqxmenu.js',
            'media/jqwidgets/jqxscrollbar.js',
            'media/jqwidgets/jqxbuttons.js',
            'media/jqwidgets/jqxcore.js',
            'media/js/jquery.number.min.js',
            

        );
        
        //$selestado = array('4','5');
        //$oEstados = ORM::factory('estados')->where('id','IN',$selestado)->find_all();
        //$estados = array();
        //foreach ($oEstados as $e) {
        //    $estados[$e->id] = $e->estado;
        //}
        
        
        $user = $this->user;
        $idu = $this->user->id;
        $this->template->content = View::factory($vista)
                                   ->bind('user', $user)
                                   ->bind('idu', $idu);
                                   
    }
    public function action_listarproveedor(){
        if(!empty($_GET['exportproveedor']) and $_GET['exportproveedor'] == 'ok'){
            $this->exportarproveedor();
        }
        $vista = 'supervisor/listar_proveedor';
        $this->template->title.='Lista de Proveedores';
        $this->template->titulo='Lista de Proveedores';
        $this->template->descripcion = '';
        $this->template->styles = array(
            'media/jqwidgets/styles/jqx.darkblue.css' => 'all',
            'media/jqwidgets/styles/jqx.office.css' => 'all',
            'media/jqwidgets/styles/jqx.base.css' => 'all',
        );
        $this->template->scripts = array(
            'media/jqwidgets/globalization/globalize.js',
            'media/jqwidgets/jqxcalendar.js',
            'media/jqwidgets/jqxdatetimeinput.js',
            'media/jqwidgets/jqxwindow.js',
            'media/jqwidgets/scripts/gettheme.js',
            'media/jqwidgets/jqxnumberinput.js',
            'media/jqwidgets/jqxgrid.aggregates.js',
            'media/jqwidgets/jqxgrid.columnsresize.js',
            'media/jqwidgets/jqxgrid.columnsreorder.js',
            'media/jqwidgets/jqxdata.export.js',
            'media/jqwidgets/jqxgrid.export.js',
            'media/jqwidgets/jqxgrid.edit.js',
            'media/jqwidgets/jqxgrid.grouping.js',
            'media/jqwidgets/jqxgrid.selection.js',
            'media/jqwidgets/jqxgrid.filter.js',
            'media/jqwidgets/jqxgrid.pager.js',
            'media/jqwidgets/jqxgrid.sort.js',
            'media/jqwidgets/jqxdata.js',
            'media/jqwidgets/jqxgrid.js',
            'media/jqwidgets/jqxdropdownlist.js',
            'media/jqwidgets/jqxlistbox.js',
            'media/jqwidgets/jqxcheckbox.js',
            'media/jqwidgets/jqxmenu.js',
            'media/jqwidgets/jqxscrollbar.js',
            'media/jqwidgets/jqxbuttons.js',
            'media/jqwidgets/jqxcore.js',
            'media/js/jquery.number.min.js',
            

        );
        $selestado = array('4','5');
        $oEstados = ORM::factory('estados')->where('id','IN',$selestado)->find_all();
        $estados = array();
        foreach ($oEstados as $e) {
            $estados[$e->id] = $e->estado;
        }
        
        
        $user = $this->user;
        $idu = $this->user->id;
        $this->template->content = View::factory($vista)
                                   ->bind('user', $user)
                                   ->bind('estados', $estados)
                                   ->bind('idu', $idu);
    }
    public function action_listarconsultor(){
        if(!empty($_GET['exportconsultor']) and $_GET['exportconsultor'] == 'ok'){
            $this->exportarconsultor();
        }
        $vista = 'supervisor/listar_consultor';
        $this->template->title.='Lista de Consultores';
        $this->template->titulo='Lista de Consultores registrados';
        $this->template->descripcion = '';
        $this->template->styles = array(
            'media/jqwidgets/styles/jqx.darkblue.css' => 'all',
            'media/jqwidgets/styles/jqx.office.css' => 'all',
            'media/jqwidgets/styles/jqx.base.css' => 'all',
        );
        $this->template->scripts = array(
            'media/jqwidgets/globalization/globalize.js',
            'media/jqwidgets/jqxcalendar.js',
            'media/jqwidgets/jqxdatetimeinput.js',
            'media/jqwidgets/jqxwindow.js',
            'media/jqwidgets/scripts/gettheme.js',
            'media/jqwidgets/jqxnumberinput.js',
            'media/jqwidgets/jqxgrid.aggregates.js',
            'media/jqwidgets/jqxgrid.columnsresize.js',
            'media/jqwidgets/jqxgrid.columnsreorder.js',
            'media/jqwidgets/jqxdata.export.js',
            'media/jqwidgets/jqxgrid.export.js',
            'media/jqwidgets/jqxgrid.edit.js',
            'media/jqwidgets/jqxgrid.grouping.js',
            'media/jqwidgets/jqxgrid.selection.js',
            'media/jqwidgets/jqxgrid.filter.js',
            'media/jqwidgets/jqxgrid.pager.js',
            'media/jqwidgets/jqxgrid.sort.js',
            'media/jqwidgets/jqxdata.js',
            'media/jqwidgets/jqxgrid.js',
            'media/jqwidgets/jqxdropdownlist.js',
            'media/jqwidgets/jqxlistbox.js',
            'media/jqwidgets/jqxcheckbox.js',
            'media/jqwidgets/jqxmenu.js',
            'media/jqwidgets/jqxscrollbar.js',
            'media/jqwidgets/jqxbuttons.js',
            'media/jqwidgets/jqxcore.js',
            'media/js/jquery.number.min.js',
            

        );
        $selestado = array('4','5');
        $oEstados = ORM::factory('estados')->where('id','IN',$selestado)->find_all();
        $estados = array();
        foreach ($oEstados as $e) {
            $estados[$e->id] = $e->estado;
        }
        
        
        $user = $this->user;
        $idu = $this->user->id;
        $this->template->content = View::factory($vista)
                                   ->bind('user', $user)
                                   ->bind('estados', $estados)
                                   ->bind('idu', $idu);
    }
    public function action_verifiquereporte(){
        $vista = 'supervisor/verifiquereporte';
        $this->template->title.='Verifique Reporte';
        $this->template->titulo='Verifique Reporte';
        $this->template->descripcion = '';
        $this->template->styles = array(
            'media/jqwidgets/styles/jqx.darkblue.css' => 'all',
            'media/jqwidgets/styles/jqx.office.css' => 'all',
            'media/jqwidgets/styles/jqx.base.css' => 'all',
        );
        if(!empty($_POST['submit']) and $_POST['submit'] == "VERIFICAR"){
            $codigo = strtoupper($_POST['codigo']);
            $codigo = trim($_POST['codigo']);
            if(empty($codigo)){
                echo '<script>alert("INGRESE UN CODIGO")</script>';
            }else{
                $codigo = str_replace('AB', '', $codigo);
                $codigo = str_replace('XY', '', $codigo);
                $idcodigo = $codigo-234;
                $ohistory = new Model_Historybusqueda();
                $result = $ohistory->datoscodigo($idcodigo);
            }
        }
        $this->template->content = View::factory($vista)
                        ->bind('result', $result);
    }
    public function action_buscaproovedor(){
        $vista = 'supervisor/buscaproveedor';
        $this->template->title.='Busca Proveedor';
        $this->template->titulo='Busca Proveedor';
        $this->template->descripcion = '';
        $this->template->styles = array(
            'media/jqwidgets/styles/jqx.darkblue.css' => 'all',
            'media/jqwidgets/styles/jqx.office.css' => 'all',
            'media/jqwidgets/styles/jqx.base.css' => 'all',
        );
        if(!empty($_POST['submit']) and $_POST['submit'] == "BUSCAR"){
            if($_POST['item'] == "-1" or $_POST['deptoid'] == "-1"){
                echo '<script>alert("Utilice al menos ITEM y DEPARTAMENTO para generar un resultado.")</script>';
            }else{
                $id1 = $_POST['item'];
                $id2 = $_POST['deptoid'];
                $id3 = $_POST['muniid'];
                $resultado = $this->busquematerial($id1,$id2,$id3);
            }
        }
        if(!empty($_GET['iddepto'])){
            $iddepto = $_GET['iddepto'];
        }else{
            $iddepto = 0;    
        }
        if(!empty($_GET['iditem'])){
            $iditem = $_GET['iditem'];
        }else{
            $iditem = 0;
        }
        if(!empty($_GET['muniid'])){
            $idmuni = $_GET['muniid'];
        }else{
            $idmuni = 0; 
        }    
        
        
        $user = $this->user;
        $username = $this->user->username;
        $this->template->content = View::factory($vista)
                                    ->bind('username', $username)
                                    ->bind('iddepto', $iddepto)
                                    ->bind('iditem', $iditem)
                                    ->bind('idmuni', $idmuni)
                                    ->bind('resultado', $resultado);
    }
    public function action_buscaempresa(){
        $vista = 'supervisor/buscaempresa';
        $this->template->title.='Busca Empresa';
        $this->template->titulo='Busca Empresa';
        $this->template->descripcion = '';
        $this->template->styles = array(
            'media/jqwidgets/styles/jqx.darkblue.css' => 'all',
            'media/jqwidgets/styles/jqx.office.css' => 'all',
            'media/jqwidgets/styles/jqx.base.css' => 'all',
        );
        if(!empty($_POST['submit']) and $_POST['submit'] == "BUSCAR"){
            if(empty($_POST['montoproy']) and $_POST['deptoid'] == "-1"){
                echo '<script>alert("Utilice al menos un campo de busqueda.")</script>';
            }else{
                if(!empty($_POST['montoproy'])){
                    if($_POST['montoproy'] > 0){
                        //funciones
                        $resultado = $this->busquedaempresa($_POST['montoproy'],$_POST['deptoid']);
                    }else{
                        echo '<script>alert("INSERTE UN VALOR VALIDO")</script>';
                    }
                }else{
                    $resultado = $this->busquedaempresa(0,$_POST['deptoid']);   
                }
            }
        }
        $user = $this->user;
        $username = $this->user->username;
        $this->template->content = View::factory($vista)
                                    ->bind('username', $username)
                                    ->bind('resultado', $resultado);
    }
    public function action_buscaconsultor(){
        $vista = 'supervisor/buscaconsultor';
        $this->template->title.='Busca Consultor';
        $this->template->titulo='Busca Consultor';
        $this->template->descripcion = '';
        $this->template->styles = array(
            'media/jqwidgets/styles/jqx.darkblue.css' => 'all',
            'media/jqwidgets/styles/jqx.office.css' => 'all',
            'media/jqwidgets/styles/jqx.base.css' => 'all',
        );
        if(!empty($_POST['submit']) and $_POST['submit'] == "BUSCAR"){
            
            if($_POST['deptoid'] == "-1" or $_POST['tipo'] == "-1" or $_POST['tipo1'] == "-1"){
                echo '<script>alert("Utilice todos los campos de busqueda.")</script>';
            }else{
                if($_POST['tipo'] == "17"){
                    if($_POST['expesp'] > 0){
                        $resultado = $this->busquedaconsultor($_POST['deptoid'],$_POST['tipo'],$_POST['tipo1'],$_POST['expesp'],$_POST['expg']);
                    }else{
                        echo '<script>alert("INSERTE VALORES VALIDOS")</script>';
                    }
                }else{
                    if($_POST['expesp'] > 0 and $_POST['expg'] > 0){
                        $resultado = $this->busquedaconsultor($_POST['deptoid'],$_POST['tipo'],$_POST['tipo1'],$_POST['expesp'],$_POST['expg']);
                    }else{
                        echo '<script>alert("INSERTE VALORES VALIDOS")</script>';
                    }
                }
            }
        }
        if(!empty($_GET['iditem'])){
            $iditem = $_GET['iditem'];
        }else{
            $iditem = 0;
        }
        if(!empty($_GET['prop'])){
            $prop = $_GET['prop'];
        }else{
            $prop = 0;
        }
        if(empty($resultado[0])){
            $rescantidad = 0;
        }else{
            $rescantidad = $resultado[0];
        }
        if(empty($resultado[1])){
            $residsc = 0;
        }else{
            $residsc = $resultado[1];
        }
        if(empty($resultado[2])){
            $residse = 0;
        }else{
            $residse = $resultado[2];
        }
        
        $user = $this->user;
        $username = $this->user->username;
        $this->template->content = View::factory($vista)
                                    ->bind('username', $username)
                                    ->bind('iditem', $iditem)
                                    ->bind('prop', $prop)
                                    ->bind('idsc', $residsc)
                                    ->bind('idse', $residse)
                                    ->bind('resultado', $rescantidad);
    }
    public function exportarconsultor(){
         $sql = "SELECT consultores.nombre_completo, 
    tipoclasificacion.tipo, 
    departamentos.departamento, 
    consultores.profesion, 
    consultores.telefonos, 
    consultores.celular, 
    consultores.mail, 
    estados.estado,
    (SELECT dpts.departamento from verificaobservaciones left JOIN users on verificaobservaciones.id_user = users.id left JOIN departamentos dpts on users.id_departamento = dpts.id where verificaobservaciones.id_empresa = consultores.id  order by verificaobservaciones.id DESC LIMIT 0,1) as 'verificadoen' 
FROM consultores INNER JOIN departamentos ON consultores.id_departamento = departamentos.id
     INNER JOIN estados ON consultores.estado = estados.id
     INNER JOIN tipoclasificacion ON consultores.tipo = tipoclasificacion.id";
         $resultado = mysql_query ($sql) or die (mysql_error ());
         $registros = mysql_num_rows ($resultado);
          
         if ($registros > 0) {
           require 'application/vendor/PHPExcel/Classes/PHPExcel.php';
           $objPHPExcel = new PHPExcel();
            
           //Informacion del excel
           $objPHPExcel->
            getProperties()
                ->setCreator("aevivienda.gob.bo")
                ->setLastModifiedBy("aevivienda.gob.bo")
                ->setTitle("Consultores")
                ->setSubject("Consultores")
                ->setDescription("Consultores")
                ->setKeywords("aevivienda.gob.bo  Consultores")
                ->setCategory("Consultores");    
         
            $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A1', "Nombre Completo")
                    ->setCellValue('B1', "Tipo")
                    ->setCellValue('C1', "Departamento")
                    ->setCellValue('D1', "Profesion")
                    ->setCellValue('F1', "Telefonos")
                    ->setCellValue('G1', "Celular")
                    ->setCellValue('H1', "Mail")
                    ->setCellValue('I1', "Estado")
                    ->setCellValue('J1', "VerificadoEn");
           $i = 2;  
           while ($registro = mysql_fetch_object ($resultado)) {
                
              $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$i, $registro->nombre_completo)
                    ->setCellValue('B'.$i, $registro->tipo)
                    ->setCellValue('C'.$i, $registro->departamento)
                    ->setCellValue('D'.$i, $registro->profesion)
                    ->setCellValue('F'.$i, $registro->telefonos)
                    ->setCellValue('G'.$i, $registro->celular)
                    ->setCellValue('H'.$i, $registro->mail)
                    ->setCellValue('I'.$i, $registro->estado)
                    ->setCellValue('J'.$i, $registro->verificadoen);
          
              $i++;
               
           }
        }
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="consultores.xls"');
        header('Cache-Control: max-age=0');
         
        $objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
        $objWriter->save('php://output');
        exit;
        mysql_close ();
    }
    public function exportarproveedor(){
         $sql = "SELECT empresas.nombre_proponente, 
    tipoclasificacion.tipo, 
    departamentos.departamento, 
    empresas.nit, 
    empresas.matricula, 
    empresas.telefonos, 
    empresas.celular, 
    empresas.mail, 
    estados.estado, 
    (SELECT dpts.departamento from verificaobservaciones left JOIN users on verificaobservaciones.id_user = users.id left JOIN departamentos dpts on users.id_departamento = dpts.id where verificaobservaciones.id_empresa = empresas.id  order by verificaobservaciones.id DESC LIMIT 0,1) as 'verificadoen' 
FROM empresas INNER JOIN departamentos ON empresas.ciudad = departamentos.id
     INNER JOIN tipoclasificacion ON empresas.tipo = tipoclasificacion.id
     INNER JOIN estados ON empresas.estado = estados.id
where empresas.tipo = 9 OR empresas.tipo = 19";
         $resultado = mysql_query ($sql) or die (mysql_error ());
         $registros = mysql_num_rows ($resultado);
          
         if ($registros > 0) {
           require 'application/vendor/PHPExcel/Classes/PHPExcel.php';
           $objPHPExcel = new PHPExcel();
            
           //Informacion del excel
           $objPHPExcel->
            getProperties()
                ->setCreator("aevivienda.gob.bo")
                ->setLastModifiedBy("aevivienda.gob.bo")
                ->setTitle("Proveedores")
                ->setSubject("Proveedores")
                ->setDescription("Proveedores")
                ->setKeywords("aevivienda.gob.bo  Proveedores")
                ->setCategory("Proveedores");    
         
            $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A1', "Razon Social")
                    ->setCellValue('B1', "Tipo")
                    ->setCellValue('C1', "Departamento")
                    ->setCellValue('D1', "NIT")
                    ->setCellValue('E1', "Matricula")
                    ->setCellValue('F1', "Telefonos")
                    ->setCellValue('G1', "Celular")
                    ->setCellValue('H1', "Mail")
                    ->setCellValue('I1', "Estado")
                    ->setCellValue('J1', "VerificadoEn");
           $i = 2;  
           while ($registro = mysql_fetch_object ($resultado)) {
                
              $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$i, $registro->nombre_proponente)
                    ->setCellValue('B'.$i, $registro->tipo)
                    ->setCellValue('C'.$i, $registro->departamento)
                    ->setCellValue('D'.$i, $registro->nit)
                    ->setCellValue('E'.$i, $registro->matricula)
                    ->setCellValue('F'.$i, $registro->telefonos)
                    ->setCellValue('G'.$i, $registro->celular)
                    ->setCellValue('H'.$i, $registro->mail)
                    ->setCellValue('I'.$i, $registro->estado)
                    ->setCellValue('J'.$i, $registro->verificadoen);
          
              $i++;
               
           }
        }
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="proveedores.xls"');
        header('Cache-Control: max-age=0');
         
        $objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
        $objWriter->save('php://output');
        exit;
        mysql_close ();
    }
    public function exportarentidad(){
         $sql = "SELECT empresas.nombre_proponente, 
    tipoclasificacion.tipo, 
    departamentos.departamento, 
    empresas.nit, 
    empresas.matricula, 
    empresas.telefonos, 
    empresas.celular, 
    empresas.mail, 
    estados.estado,
    (SELECT dpts.departamento from verificaobservaciones left JOIN users on verificaobservaciones.id_user = users.id left JOIN departamentos dpts on users.id_departamento = dpts.id where verificaobservaciones.id_empresa = empresas.id  order by verificaobservaciones.id DESC LIMIT 0,1) as 'verificadoen' 
FROM empresas INNER JOIN departamentos ON empresas.ciudad = departamentos.id
     INNER JOIN tipoclasificacion ON empresas.tipo = tipoclasificacion.id
     INNER JOIN estados ON empresas.estado = estados.id
where empresas.tipo <> 9 and empresas.tipo <> 19";
         $resultado = mysql_query ($sql) or die (mysql_error ());
         $registros = mysql_num_rows ($resultado);
          
         if ($registros > 0) {
           require 'application/vendor/PHPExcel/Classes/PHPExcel.php';
           $objPHPExcel = new PHPExcel();
            
           //Informacion del excel
           $objPHPExcel->
            getProperties()
                ->setCreator("aevivienda.gob.bo")
                ->setLastModifiedBy("aevivienda.gob.bo")
                ->setTitle("Entidades Ejecutoras")
                ->setSubject("Entidades Ejecutoras")
                ->setDescription("Entidades Ejecutoras")
                ->setKeywords("aevivienda.gob.bo  Entidades Ejecutoras")
                ->setCategory("Entidades");    
         
            $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A1', "Razon Social")
                    ->setCellValue('B1', "Tipo")
                    ->setCellValue('C1', "Departamento")
                    ->setCellValue('D1', "NIT")
                    ->setCellValue('E1', "Matricula")
                    ->setCellValue('F1', "Telefonos")
                    ->setCellValue('G1', "Celular")
                    ->setCellValue('H1', "Mail")
                    ->setCellValue('I1', "Estado")
                    ->setCellValue('J1', "VerificadoEn");
           $i = 2;  
           while ($registro = mysql_fetch_object ($resultado)) {
                
              $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$i, $registro->nombre_proponente)
                    ->setCellValue('B'.$i, $registro->tipo)
                    ->setCellValue('C'.$i, $registro->departamento)
                    ->setCellValue('D'.$i, $registro->nit)
                    ->setCellValue('E'.$i, $registro->matricula)
                    ->setCellValue('F'.$i, $registro->telefonos)
                    ->setCellValue('G'.$i, $registro->celular)
                    ->setCellValue('H'.$i, $registro->mail)
                    ->setCellValue('I'.$i, $registro->estado)
                    ->setCellValue('J'.$i, $registro->verificadoen);
          
              $i++;
               
           }
        }
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="entidades.xls"');
        header('Cache-Control: max-age=0');
         
        $objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
        $objWriter->save('php://output');
        exit;
        mysql_close ();
    }
    public function busquedaempresa($monto,$deptoid){
        if($monto == 0 and $deptoid != "-1"){
            $odeptosint = new Model_Departamentosinteres();
            $result = $odeptosint->cantregdeptosinteres($deptoid);
        }
        if($deptoid == "-1" and $monto != 0){
            $omonto = new Model_Experienciaentidad();
            $result = $omonto->cantregmonto($monto);
        }
        if($monto != 0 and $deptoid != "-1"){
            $oexp = new Model_Experienciaentidad();
            $result = $oexp->cantreg($monto,$deptoid);
        }
        return $result;
    }
    public function busquematerial($item,$deptoid,$muniid){
        if($muniid == "-1"){
            $oprovmat = new Model_Proveedormateriales();
            $result = $oprovmat->cantreg($item,$deptoid);
        }else{
            $oprovmat = new Model_Proveedormateriales();
            $result = $oprovmat->cantregmuni($item,$deptoid,$muniid);
        }
        return $result;
    }
    /*
    $dato1 = departamento
    $dato2 = Tipo consultor
    $dato3 = persona natural, empresa, ambos
    $dato4 = experiencia especifica
    $dato5 = experiencia general
    */
    public function busquedaconsultor($dato1,$dato2,$dato3,$dato4,$dato5){
        if($dato2 == "17"){
            $oconsultor = new Model_Experienciaconsultor();
            $result = $oconsultor->cantpn2($dato1,$dato2,$dato4);
            $result = array($result[0],$result[1],"0");
        }else{
            if($dato3 == "pn"){
                if($dato2 == "16"){
                    $oconsultor = new Model_Experienciaconsultor();
                    $result = $oconsultor->cantpn1($dato1,$dato2,$dato4,$dato5);
                    $result = array($result[0],$result[1],"0");
                }else{
                    $oconsultor = new Model_Experienciaconsultor();
                    $result = $oconsultor->cantpn($dato1,$dato2,$dato4,$dato5);
                    $result = array($result[0],$result[1],"0");
                }
            }
            if($dato3 == "em"){
                $oempresa = new Model_Experienciaentidad();
                $result = $oempresa->cantem($dato1,$dato2,$dato4,$dato5);
                $result = array($result[0],"0",$result[1]);
            }
            if($dato3 == "am"){
                $oconsultor = new Model_Experienciaconsultor();
                $result = $oconsultor->cantpn($dato1,$dato2,$dato4,$dato5);
                $oempresa = new Model_Experienciaentidad();
                $result1 = $oempresa->cantem($dato1,$dato2,$dato4,$dato5);
                $cant = $result[0]+$result1[0];
                $result = array($cant,$result[1],$result1[1]);
            }
        }
        return $result;
    }
    
  
}
/**
 * Funci�n que devuelve un numero en palabras.
 */

?>
