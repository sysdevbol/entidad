<?php defined('SYSPATH') or die('No direct script access.');

class Controller_contextos extends Controller_index {

    //public function before() {parent::before();}    
    public function action_index() {
        $contextos = ORM::factory('contextos');
        $contextos = $contextos->find_all();
        $this->template->content = View::factory('contextos')
                        ->bind('errors', $errors)
                        ->bind('contextos', $contextos);
        //$this->template->page_title = 'Contextos';
        //  $this->template->content = $content;
        
    }

    public function action_add() {
        
        if (isset($_POST['nomProductor'])) {
           // $mod = Arr::extract($_POST, array('nomModalidad', 'modaDescripcion', 'idMod'));
            $newmodalidad = ORM::factory('contextos');
            //print '<pre>'; print_r($cat); print '</pre>'; echo '<br>';
            $newmodalidad->nomProductor = $_POST['nomProductor'];
            $newmodalidad->nomNota = $_POST['nomNota'];
            $newmodalidad->save();
            // $newmodalidad->modaDescripcion = $mod['modaDescripcion'];
           // try {
           //     if (!$mod['idMod']) {
                   // $newmodalidad->make_root();
           //     } else {
                   // $newmodalidad->insert_as_last_child($mod['idMod']);
           //     }
          //      HTTP::redirect('contextos');
        //    } catch (ORM_Validation_Exception $e) {
        //        $errors = $e->errors('validation');
         //   }
        }
        //$categories = $categories->find_all()->as_array();
        $contextos = ORM::factory('contextos')->find_all();
        $content = View::factory('modalidadadd')
                        ->set('values', $_POST)
                        ->bind('contextos', $contextos)
                ->bind('errors', $errors);
       
        $this->template->page_title = 'contextos';
        $this->template->content = $content;
    }

    public function action_edit() {
        $contra = $_GET['contra'];
        //$contra = $this->request->param('contra');
        $content = View::factory('contextoedit')->set('values', $_POST)->bind('errors', $errors)
                        ->bind('id', $id)->bind('contextos', $contextos)->bind('data', $data);
        $contextos = ORM::factory('contextos')->where('id', '=', $contra)->find();
        $data = $contextos->as_array();
        //  if(!$contextos->loaded()){HTTP::redirect('contextos');}
        $contextos = ORM::factory('contextos')->find_all()->as_array();
        //$categories = $categories->find_all()->as_array();
        if (isset($_POST['submit'])) {
            $data[] = Arr::extract($_POST, array('nomModalidad', 'modaDescripcion', 'modaDescripcion', 'template'));
            $data = Arr::flatten($data);
            $contextos->values($data);
            try {
                $contextos->save();
                HTTP::redirect('contextos');
            } catch (ORM_Validation_Exception $e) {
                $errors = $e->errors('validation');
            }
        }
        $this->template->page_title = 'contextos';
        $this->template->content = $content;
    }

    public function action_eliminar() {
        $contra = $_GET['contra'];
        $contextos = ORM::factory('contextos', $contra);
        //$data = $contextos->as_array();   
        $contextos->delete();
        HTTP::redirect('contextos');
    }

}