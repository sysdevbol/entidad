<?php
defined('SYSPATH') or die('Acceso denegado');
class Controller_archivero_dashboard extends Controller_index{
    public function after() {
        $auth = Auth::instance();
        if ($auth->get_user()) {
            $user = ORM::factory('users', $auth->get_user());
        }
        else
        {
            $this->request->redirect('/login');
        }
        $this->template->user = $user;
        parent::after();
    }
    //protected $user;
    //protected $menus;
   /* public function before() 
    {
       parent::before();
       $auth =  Auth::instance();      
        if($auth->logged_in()){        
            $session=Session::instance();
            $this->user=$session->get('auth_user');
            $oNivel=New Model_niveles();
            $this->menus=$oNivel->menus($this->user->nivel);                        
            $this->template->username=$this->user->nombre;
            $this->template->theme=$this->user->theme;         
        }
        else{
            $this->request->redirect('/login');
        }        
    }  
    public function after() 
    {
        $this->template->menutop = View::factory('templates/menutop')->bind('menus',$this->menus)->set('controller', 'index');
        $oSM=New Model_menus();
        $submenus=$oSM->submenus('index');
        $this->template->submenu = View::factory('templates/submenu')->bind('smenus',$submenus)->set('titulo','Pagina de Inicio');
        parent::after();
    } */
    public function action_index()
    {               
        $actividades=ORM::factory('archivero/gestiones')->count_all();
        $proyectos=ORM::factory('archivero/modalidades')->count_all();
        $this->template->styles=array( 'assets/media/css/flick/jquery-ui-1.9.0.custom.css'=>'all');
        $this->template->scripts=array('assets/media/js/jquery-ui-1.9.0.custom.min.js', 
                                       'assets/media/Highcharts/js/modules/exporting.js',
                                       'assets/media/Highcharts/js/highcharts.js', );
        
        $this->template->content=View::factory('archivero/dashboard')
                                    ->bind('gestiones', $actividades)      
                                    ->bind('modalidades', $proyectos);      
    }    
}
?>
