<?php defined('SYSPATH') or die('No direct script access.');

class Controller_archivero_unidades0 extends Controller_archivero_index {
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
        $unidades0 = ORM::factory('unidades0');
        $unidades0 = $unidades0->find_all();
        $this->template->content = View::factory('archivero/unidades0')
                        ->bind('errors', $errors)
                        ->bind('unidades0', $unidades0);
        //$this->template->page_title = 'modalidades';
        //  $this->template->content = $content;
        
    }

    public function action_add() {
        
        if (isset($_POST['uniDescripcion'])) {
           // $mod = Arr::extract($_POST, array('nomModalidad', 'modaDescripcion', 'idMod'));
            $newunidad = ORM::factory('unidades0');
            //print '<pre>'; print_r($cat); print '</pre>'; echo '<br>';
            $newunidad->nomUnidad = $_POST['nomUnidad'];
            $newunidad->uniDescripcion = $_POST['uniDescripcion'];
            $newunidad->save();
            HTTP::redirect('unidades0');
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
        $unidades0 = ORM::factory('unidades0')->find_all();
        $content = View::factory('archivero/unidadadd')
                        ->set('values', $_POST)
                        ->bind('unidades0', $unidades0)
                ->bind('errors', $errors);
       
        $this->template->page_title = 'unidades0';
        $this->template->content = $content;
    }

    public function action_edit() {
        $contra = $_GET['contra'];
        //$contra = $this->request->param('contra');
        $content = View::factory('archivero/unidadedit')->set('values', $_POST)->bind('errors', $errors)
                        ->bind('id', $id)->bind('unidades0', $unidades0)->bind('data', $data);
        $unidades0 = ORM::factory('unidades0')->where('id', '=', $contra)->find();
        $data = $unidades0->as_array();
        //  if(!$modalidades->loaded()){HTTP::redirect('modalidades');}
        $unidades0 = ORM::factory('unidades0')->find_all()->as_array();
        //$categories = $categories->find_all()->as_array();
        if (isset($_POST['submit'])) {
            $data[] = Arr::extract($_POST, array('nomUnidad', 'uniDescripcion'));
            $data = Arr::flatten($data);
            $unidades0->values($data);
            try {
                $unidades0->save();
                HTTP::redirect('unidades0');
            } catch (ORM_Validation_Exception $e) {
                $errors = $e->errors('validation');
            }
        }
        $this->template->page_title = 'unidades0';
        $this->template->content = $content;
    }

    public function action_eliminar() {
        $contra = $_GET['contra'];
        $unidades0 = ORM::factory('unidades0', $contra);
        //$data = $modalidades->as_array();   
        $unidades0->delete();
        //HTTP::redirect('unidades0');
        $this->action_index();
    }

}