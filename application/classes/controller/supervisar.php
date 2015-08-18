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
    
  
}
/**
 * Función que devuelve un numero en palabras.
 */

?>
