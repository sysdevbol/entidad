<?php defined('SYSPATH') or die('No direct script access.');

class Controller_archivero_entidades0 extends Controller_archivero_index {
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
        $entidades0 = ORM::factory('entidades0');
        $entidades0 = $entidades0->find_all();
        $this->template->content = View::factory('archivero/entidades0')
                        ->bind('errors', $errors)
                        ->bind('entidades0', $entidades0);
        //$this->template->page_title = 'modalidades';
        //  $this->template->content = $content;
        
    }

    public function action_add() {
        
        if (isset($_POST['entiDescripcion'])) {
           // $mod = Arr::extract($_POST, array('nomModalidad', 'modaDescripcion', 'idMod'));
            $newentidad = ORM::factory('entidades0');
            //print '<pre>'; print_r($cat); print '</pre>'; echo '<br>';
            $newentidad->nomEntidad = $_POST['nomEntidad'];
            $newentidad->entiDescripcion = $_POST['entiDescripcion'];
            $newentidad->save();
            HTTP::redirect('entidades0');
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
        $entidades0 = ORM::factory('Entidades0')->find_all();
        $content = View::factory('archivero/entidadadd')
                        ->set('values', $_POST)
                        ->bind('entidades0', $entidades0)
                ->bind('errors', $errors);
       
        $this->template->page_title = 'entidades0';
        $this->template->content = $content;
    }

    public function action_edit() {
        $contra = $_GET['contra'];
        //$contra = $this->request->param('contra');
        $content = View::factory('archivero/entidadedit')->set('values', $_POST)->bind('errors', $errors)
                        ->bind('id', $id)->bind('entidades0', $entidades0)->bind('data', $data);
        $entidades0 = ORM::factory('entidades0')->where('id', '=', $contra)->find();
        $data = $entidades0->as_array();
        //  if(!$modalidades->loaded()){HTTP::redirect('modalidades');}
        $entidades0 = ORM::factory('entidades0')->find_all()->as_array();
        //$categories = $categories->find_all()->as_array();
        if (isset($_POST['submit'])) {
            $data[] = Arr::extract($_POST, array('nomEntidad', 'entiDescripcion', 'unifechaCrea'));
            $data = Arr::flatten($data);
            $entidades0->values($data);
            try {
                $entidades0->save();
                HTTP::redirect('entidades0');
            } catch (ORM_Validation_Exception $e) {
                $errors = $e->errors('validation');
            }
        }
        $this->template->page_title = 'entidades0';
        $this->template->content = $content;
    }

    public function action_eliminar() {
        $contra = $_GET['contra'];
        $entidades0 = ORM::factory('entidades0', $contra);
        //$data = $modalidades->as_array();   
        $entidades0->delete();
        //HTTP::redirect('entidades0');
        $this->action_index();
    }

}