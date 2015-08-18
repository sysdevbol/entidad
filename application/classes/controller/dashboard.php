<?php
defined('SYSPATH') or die('Acceso denegado');
class Controller_Dashboard extends Controller_IndexTemplate{
    protected $user;
    protected $menus;
    public function before() 
    {
       parent::before();
       $auth =  Auth::instance();
        //si el usuario esta logeado entonces mostramos el menu
        if($auth->logged_in()){
        //menu top de acuerdo al nivel
            $session=Session::instance();
            $this->user=$session->get('auth_user');
            $oNivel=New Model_niveles();
            $this->menus=$oNivel->menus($this->user->nivel);                        
            $this->template->username=$this->user->nombre;
            if($this->user->theme!=null)
            {$this->template->theme=$this->user->theme; }
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
    }
    public function action_index()
    {   
        
                    
        $id=$this->user->id;
        $user=ORM::factory('users',array('id'=>$id));
        //$oficina=$user->oficina->oficina;        
        $this->template->title      .=' / Inicio';        
        $this->template->titulo     ='<v>'.$this->user->nombre;        
        $this->template->descripcion     =$this->user->cargo;        
        //unset($estados[6]);
        $this->template->content=View::factory('empresas/index')
                ->bind('user',$user);                
        
    }    
  
    public function action_buscar()
    {
        $this->request->redirect('busqueda/buscar');
    }
}
?>
