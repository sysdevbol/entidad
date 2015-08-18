<?php
defined('SYSPATH') or die('Acceso denegado');
class Controller_login extends Controller_Mintemplate{
    public function action_index()
    {        
        $errors=array();
        $auth =  Auth::instance();        
        if($auth->logged_in())
        {            
            $session=Session::instance();
            $user=$session->get('auth_user');
            if($user->nivel==5)
            {
                $this->request->redirect('admin');
            }
            else 
            {
                $this->request->redirect('dashboard');
            }  
        }        
        else{            
            if(isset($_POST['submit']))
             {
                $validate = Validation::factory($this->request->post());
                $validate->rule('username', 'not_empty')
                         ->rule('password', 'not_empty');
                if ($validate->check())
                {
                $user=$auth->login(html::chars($_POST['username']),  html::chars($_POST['password']));
                if($user)
                    {
                    $usuario=  ORM::factory('users',$auth->get_user());
                    $session=Session::instance();
                    $session->set('username',$usuario->nombre);
                    $session->set('username',$usuario->username);
                    $session->set('cargo',$usuario->cargo);                    
                    //vitacora
                    $this->save($usuario->id_entidad,$usuario->id, $usuario->nombre.' <b>'.$usuario->cargo.'</b> ingresó al sistema');
                    
                    if($usuario->nivel==5)                    
                        $this->request->redirect('admin');                    
                    else
                       {
                        if(isset($_GET['url']))
                         $this->request->redirect($_GET['url']);
                        else
                         $this->request->redirect('dashboard');                           
                       }
                    }
                else
                   {
                    $this->template->errors['login']='Acceso no autorizado.';    
                    //$_POST=array();
                    }                  
                }
            }                        
        }
        $this->template->title   .= ' / Ingreso';
        $this->template->content = View::factory('templates/login');
    }
   
}
?>
