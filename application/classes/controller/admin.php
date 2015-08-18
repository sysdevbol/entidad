<?php
defined('SYSPATH') or die('Acceso denegado');
class Controller_Admin extends Controller_AdministratorTemplate{
    public function action_index(){
        $auth =  Auth::instance();
        //si el usuario esta logeado entocnes mostramos el menu
        if($auth->logged_in()){
            $session=Session::instance();
            $user=$session->get('auth_user');
            if($user->nivel==5){                
                $this->template->title   = 'Administrador del Sitio';
                $this->template->menu=View::factory('admin/menu');                
                $this->template->content = View::factory('user/info');                 
            }
            else
            {
               $this->template->content=View::factory('admin/error'); 
            }
        }
        //de lo contrario mostramos el formulario de ingreso
        else{            
            $this->template->title   = 'Administrador - Login';
            $this->template->content = View::factory('admin/login');
        }        
        
    }
    public function action_usuarios(){
       $auth =  Auth::instance();
        //si el usuario esta logeado entocnes mostramos el menu
        if($auth->logged_in()){
            $session=Session::instance();
            $user=$session->get('auth_user');
            if($user->nivel==1){  
                $oUser=New Model_Users();
                $usuarios=$oUser->usuarios($user->id);
                $this->template->styles=array('media/css/tablas.css'=>'all');
        $this->template->scripts    = array('media/js/jquery.tablesorter.min.js');
                $this->template->title   = 'Lista de Usuarios';
                $this->template->menu=View::factory('admin/menu');                
                $this->template->content = View::factory('admin/usuarios')
                                            ->bind('usuarios', $usuarios)                 
                                            ->bind('user', $this->user);                 
            }
            else
            {
               $this->template->content=View::factory('admin/error'); 
            }
        }
        //de lo contrario mostramos el formulario de ingreso
        else{            
            $this->template->title   = 'Administrador - Login';
            $this->template->content = View::factory('admin/login');
        } 

    }
    public function action_user($id=''){
       $auth =  Auth::instance();
        //si el usuario esta logeado entocnes mostramos el menu
        if($auth->logged_in()||$id!=''){
            $session=Session::instance();
            $user=$session->get('auth_user');
            if($user->nivel==1){  
                $user=  ORM::factory('users',$id);                
                //lista de menus
                $tipos=  ORM::factory('tipos')->where('doc','=',0)->find_all();   //tipos de documento                             
                $oficinas=  ORM::factory('oficinas')->find_all(); //oficinas                
                $niveles=  ORM::factory('niveles')->find_all(); //niveles
                $users_menu=  ORM::factory('usermenu')->where('id_user','=',$id)->find_all();
                $this->template->title   = 'Lista de Usuarios';
                $this->template->menu=View::factory('admin/menu');                
                $this->template->content = View::factory('admin/user')
                                            ->bind('user', $user)
                                            ->bind('tipos',$tipos)
                                            ->bind('oficinas', $oficinas)
                                            ->bind('niveles', $niveles)
                                            ->bind('menus', $users_menu);
            }
            else
            {
               $this->template->content=View::factory('admin/error'); 
            }
        }
        //de lo contrario mostramos el formulario de ingreso
        else{            
            $this->template->title   = 'Administrador - Login';
            $this->template->content = View::factory('admin/login');
        } 

    }
    //logout administrador
   public function action_logout(){
     $auth=Auth::instance();
     $auth->logout();
     $this->request->redirect(URL::base()); //redireccionamos a la pagina principal
   }
}
?>
