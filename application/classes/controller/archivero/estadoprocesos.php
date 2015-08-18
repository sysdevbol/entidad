<?php defined('SYSPATH') or die('No direct script access.');

class Controller_estadoprocesos extends Controller_index {
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
    //public function before() {parent::before();}    
    public function action_index() {
        $estadoprocesos = ORM::factory('estadoprocesos');
        $estadoprocesos = $estadoprocesos->find_all();
        $this->template->content = View::factory('estadoprocesos')
                        ->bind('errors', $errors)
                        ->bind('estadoprocesos', $estadoprocesos);
        
    }

    public function action_add() {
        
        if (isset($_POST['proDescripcion'])) {
            $newestadoprocesos = ORM::factory('estadoprocesos');
            $newestadoprocesos->nomProceso = $_POST['nomProceso'];
            $newestadoprocesos->proDescripcion = $_POST['proDescripcion'];
            $newestadoprocesos->save();
            HTTP::redirect('estadoprocesos');
        }
        $estadoprocesos = ORM::factory('estadoprocesos')->find_all();
        $content = View::factory('estadoprocesoadd')
                        ->set('values', $_POST)
                        ->bind('estadoprocesos', $estadoprocesos)
                ->bind('errors', $errors);
       
        $this->template->page_title = 'Estado Procesos';
        $this->template->content = $content;
    }

    public function action_edit() {
        $contra = $_GET['contra'];
        if (isset($_POST['nomModalidad'])) {
            $estadoproceso = ORM::factory('estadoprocesos',$contra);
            $estadoproceso->nomProceso = $_POST['nomProceso'];
            $estadoproceso->proDescripcion = $_POST['proDescripcion'];
            $estadoproceso->save();
        }
        $estadoprocesos = ORM::factory('estadoprocesos', $contra);
        if ($estadoprocesos->loaded()) {            
            $content = View::factory('estadoprocesoedit')->set('values', $_POST)->bind('errors', $errors)
                            ->bind('id', $id)->bind('estadoprocesos', $estadoprocesos)->bind('data', $data);
            $data = $estadoprocesos->as_array();            
            $estadoprocesos = ORM::factory('estadoprocesos')->find_all()->as_array();
            $this->template->page_title = 'estadoprocesos';
            $this->template->content = $content;
        }
        else
        {
            $this->template->content = "no existe la modalidad";
        }
    }
    public function action_eliminar() {
        $contra = $_GET['contra'];
        $estadoprocesos = ORM::factory('estadoprocesos', $contra);
        $estadoprocesos->delete();
        HTTP::redirect('estadoprocesos');
    }

}