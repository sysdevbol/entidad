<?php defined('SYSPATH') or die('No direct script access.');

class Controller_archivero_adjudicaciones extends Controller_archivero_index {
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
        $adjudicaciones = ORM::factory('adjudicaciones');
        $adjudicaciones = $adjudicaciones->find_all();
        $this->template->content = View::factory('archivero/adjudicaciones')
                        ->bind('errors', $errors)
                        ->bind('adjudicaciones', $adjudicaciones);
        //$this->template->page_title = 'adjudicaciones';
        //  $this->template->content = $content;
        
    }

    public function action_add() {
        
        if (isset($_POST['proponente'])) {
           // $mod = Arr::extract($_POST, array('nomModalidad', 'modaDescripcion', 'idMod'));
            $newadjudicacion = ORM::factory('adjudicaciones');
            //print '<pre>'; print_r($cat); print '</pre>'; echo '<br>';
            $newadjudicacion->proponente = $_POST['proponente'];
            $newadjudicacion->adjuObservacion = $_POST['adjuObservacion'];
            $newadjudicacion->save();
            HTTP::redirect('adjudicaciones');
            // $newmodalidad->modaDescripcion = $mod['modaDescripcion'];
           // try {
           //     if (!$mod['idMod']) {
                   // $newmodalidad->make_root();
           //     } else {
                   // $newmodalidad->insert_as_last_child($mod['idMod']);
           //     }
          //      HTTP::redirect('adjudicaciones');
        //    } catch (ORM_Validation_Exception $e) {
        //        $errors = $e->errors('validation');
         //   }
        }
        //$categories = $categories->find_all()->as_array();
        $adjudicaciones = ORM::factory('adjudicaciones')->find_all();
        $content = View::factory('adjudicacionadd')
                        ->set('values', $_POST)
                        ->bind('adjudicaciones', $adjudicaciones)
                ->bind('errors', $errors);
       
        $this->template->page_title = 'adjudicaciones';
        $this->template->content = $content;
        
    }

    public function action_edit() {
        $contra = $_GET['contra'];
        //$contra = $this->request->param('contra');
        $content = View::factory('adjudicacionedit')->set('values', $_POST)->bind('errors', $errors)
                        ->bind('id', $id)->bind('adjudicaciones', $adjudicaciones)->bind('data', $data);
        $adjudicaciones = ORM::factory('adjudicaciones')->where('id', '=', $contra)->find();
        $data = $adjudicaciones->as_array();
        //  if(!$adjudicaciones->loaded()){HTTP::redirect('adjudicaciones');}
        $adjudicaciones = ORM::factory('adjudicaciones')->find_all()->as_array();
        //$categories = $categories->find_all()->as_array();
        if (isset($_POST['submit'])) {
            $data[] = Arr::extract($_POST, array('proponente', 'adjuObservacion', 'template'));
            $data = Arr::flatten($data);
            $adjudicaciones->values($data);
            try {
                $adjudicaciones->save();
                HTTP::redirect('adjudicaciones');
            } catch (ORM_Validation_Exception $e) {
                $errors = $e->errors('validation');
            }
        }
        $this->template->page_title = 'adjudicaciones';
        $this->template->content = $content;
    }

    public function action_eliminar() {
        $contra = $_GET['contra'];
        $adjudicaciones = ORM::factory('adjudicaciones', $contra);
        //$data = $adjudicaciones->as_array();   
        $adjudicaciones->delete();
        HTTP::redirect('adjudicaciones');
    }

}