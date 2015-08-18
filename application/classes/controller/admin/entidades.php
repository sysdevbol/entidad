<?php
defined('SYSPATH') or die('No direct script access.');
 
class Controller_Admin_Entidades extends Controller_AdministratorTemplate {
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
            $this->template->title.=' / Entidades';
            $this->template->titulo='<v>Entidades / </v> ';
            $this->template->descripcion='';
            $this->template->username=$this->user->nombre;
        }
        else{
            $this->request->redirect('/logout');
        }
        
}
 public function after() {
        $this->template->menutop = View::factory('templates/menutopadmin')->bind('menus',$this->menus)->set('controller', 'admin');
        $oSM=New Model_menus();
        $submenus=$oSM->submenus('admin');
        $this->template->submenu = View::factory('templates/submenuadmin')->bind('smenus',$submenus)->set('titulo','');        
        parent::after();
    }  
    // lista de oficinas
    public function action_index()
    {
        $entidades=ORM::factory('entidades')->find_all();
        $this->template->titulo.='Listar';
        $this->template->descripcion='LISTA DE ENTIDADES';
        $this->template->content = View::factory('admin/lista_entidades')
                                    ->bind('entidades', $entidades);                 
    }
    public function action_lista($id='')
    {
        $entidad=ORM::factory('entidades',array('id'=>$id));
        if($entidad->loaded())
        {
            $oficinas=$entidad->oficinas->find_all();
            $this->template->content=View::factory('/admin/oficinas')
                                    ->bind('oficinas', $oficinas);
        }
        else
        {
            $this->template->content='Error: No se encontro la entidad';
        }
        
    }
    public function  action_add()
    {
        $errors=array();
        $mensaje='';
        if($_POST)
        {
            //verificamos que la sigla de la entidad no exista ya
            $entidad=ORM::factory('entidades',array('sigla'=>$_POST['sigla']));
            if($entidad->id)
            {
                $sigla=$_POST['sigla'];
                $errors[]="Ya existe una entidad con la sigla: $sigla , elija otra por favor";
            }
            else
            {
                $entidad->entidad=Arr::get($_POST, 'entidad');
                $entidad->sigla=Arr::get($_POST, 'sigla');
                $entidad->sigla2=Arr::get($_POST, 'sigla2');
                $entidad->direccion=Arr::get($_POST, 'direccion');
                $entidad->telefono=Arr::get($_POST, 'telefono');
                $entidad->save();
                $_POST=array();
                $mensaje=$entidad->entidad;
            }
        }
        $this->template->titulo.='Crear entidad';
        $this->template->descripcion.='Crear una nueva entidad';
        $this->template->content=View::factory('admin/add_entidad')
                                ->bind('errors', $errors)
                                ->bind('mensaje', $mensaje);
        
    }
 
}
?>
