<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_archivero_modalidades extends Controller_archivero_index {

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
        $modalidades = ORM::factory('modalidades');
        $modalidades = $modalidades->find_all();
        $this->template->content = View::factory('archivero/modalidades')
                ->bind('errors', $errors)
                ->bind('modalidades', $modalidades);
        //$this->template->page_title = 'modalidades';
        //  $this->template->content = $content;
    }

    public function action_add() {

        if (isset($_POST['modaDescripcion'])) {
            // $mod = Arr::extract($_POST, array('nomModalidad', 'modaDescripcion', 'idMod'));
            $newmodalidad = ORM::factory('modalidades');
            //print '<pre>'; print_r($cat); print '</pre>'; echo '<br>';
            $newmodalidad->nomModalidad = $_POST['nomModalidad'];
            $newmodalidad->modaDescripcion = $_POST['modaDescripcion'];
            $newmodalidad->save();
            // $newmodalidad->modaDescripcion = $mod['modaDescripcion'];
            // try {
            //     if (!$mod['idMod']) {
            // $newmodalidad->make_root();
            //     } else {
            // $newmodalidad->insert_as_last_child($mod['idMod']);
            //     }
            //      HTTP::redirect('modalidades');
            //    } catch (ORM_Validation_Exception $e) {
            //        $errors = $e->errors('validation');
            //   }
        }
        //$categories = $categories->find_all()->as_array();
        $modalidades = ORM::factory('Modalidades')->find_all();
        $content = View::factory('archivero/modalidadadd')
                ->set('values', $_POST)
                ->bind('modalidades', $modalidades)
                ->bind('errors', $errors);

        $this->template->page_title = 'Modalidades';
        $this->template->content = $content;
    }

    public function action_edit() {
        $contra = $_GET['contra'];
        if (isset($_POST['nomModalidad'])) {
            $modalidad = ORM::factory('modalidades',$contra);
            $modalidad->nomModalidad = $_POST['nomModalidad'];
            $modalidad->modaDescripcion = $_POST['modaDescripcion'];
            $modalidad->save();
        }
        $modalidades = ORM::factory('modalidades', $contra);
        if ($modalidades->loaded()) {            
            $content = View::factory('archivero/modalidadedit')->set('values', $_POST)->bind('errors', $errors)
                            ->bind('id', $id)->bind('modalidades', $modalidades)->bind('data', $data);
            $data = $modalidades->as_array();            
            $modalidades = ORM::factory('modalidades')->find_all()->as_array();
            $this->template->page_title = 'modalidades';
            $this->template->content = $content;
        }
        else
        {
            $this->template->content = "no existe la modalidad";
        }
    }

    public function action_eliminar() {
        $contra = $_GET['contra'];
        $modalidades = ORM::factory('modalidades', $contra);
        //$data = $modalidades->as_array();   
        $modalidades->delete();
        //HTTP::redirect('archivero/modalidades');
  $this->request->redirect('archivero/modalidades');      //$this->action_index();
    }

}