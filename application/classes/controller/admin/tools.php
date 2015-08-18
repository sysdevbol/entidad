<?php
defined('SYSPATH') or die('No direct script access.');
 
class Controller_Admin_Tools extends Controller_AdministratorTemplate {
     protected $user;
    protected $menus;
    public function before() {
        $auth =  Auth::instance();
        //si el usuario esta logeado entocnes mostramos el menu
        if($auth->logged_in()){
        //menu top de acuerdo al nivel
            $session=Session::instance();
            $this->user=$session->get('auth_user');
            $oNivel=New Model_niveles();
            $this->menus=$oNivel->menus($this->user->nivel);
        parent::before();            
            $this->template->titulo='<v>Replica / </v> ';
            $this->template->descripcion='';
            $this->template->username=$this->user->nombre;
       // $this->template->title='<li>'.html::anchor('admin','Bandeja').'</li>';
        }
        else{
            $this->request->redirect('/login');
        }
        
    }
     public function after() {
        $this->template->menutop = View::factory('templates/menutopadmin')->bind('menus',$this->menus)->set('controller', 'index');
        $oSM=New Model_menus();
        $submenus=$oSM->submenus('admin');
        $this->template->submenu = View::factory('templates/submenuadmin')->bind('smenus',$submenus)->set('titulo','Administrar');
        parent::after();
    }
    // lista de oficinas
    public function action_index()
    {
        $this->template->title.=' Replica DB';
        $this->template->titulo.=' Replica DB';
        $this->template->descripcion.='Replicar informacion SAP/CMI';
        $this->template->styles = array(
            'media/jqwidgets/styles/jqx.energyblue.css' => 'all',
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
        $this->template->content = View::factory('admin/replica');                 
    }
    public function action_impresiono()
    {
        $this->template->title.='Impresiones';
        $this->template->titulo.=' Copias-Ori';
        $this->template->descripcion.='Impresiones Copia-Originales';
        
        $this->template->content = View::factory('admin/copiasori');                 
    }
}
?>
