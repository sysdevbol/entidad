<?php defined('SYSPATH') or die('No direct script access.');

class Controller_archivero_instituciones extends Controller_archivero_index {
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
        $instituciones = ORM::factory('instituciones');
        $instituciones = $instituciones->find_all();
        $this->template->content = View::factory('archivero/instituciones')
                        ->bind('errors', $errors)
                        ->bind('instituciones', $instituciones);
        //$this->template->page_title = 'modalidades';
        //  $this->template->content = $content;
        
    }

    public function action_add() {
        
        if (isset($_POST['descripInsititucion'])) {
           // $mod = Arr::extract($_POST, array('nomModalidad', 'modaDescripcion', 'idMod'));
            $newinstitucion = ORM::factory('instituciones');
            //print '<pre>'; print_r($cat); print '</pre>'; echo '<br>';
            $newinstitucion->nombreInstitucion = $_POST['nombreInstitucion'];
            $newinstitucion->descripInstitucion = $_POST['descripInstitucion'];
            $newinstitucion->save();
            HTTP::redirect('instituciones');
            // $newmodalidad->modaDescripcion = $mod['modaDescripcion'];
           // try {
           //     if (!$mod['idMod']) {
                   // $newmodalidad->make_root();
           //     } else {
                   // $newmodalidad->insert_as_last_child($mod['idMod']);
           //     }
          //      HTTP::redirect('instituciones');
        //    } catch (ORM_Validation_Exception $e) {
        //        $errors = $e->errors('validation');
         //   }
        }
        //$categories = $categories->find_all()->as_array();
        $instituciones = ORM::factory('Instituciones')->find_all();
        $content = View::factory('Institucionadd')
                        ->set('values', $_POST)
                        ->bind('instituciones', $instituciones)
                ->bind('errors', $errors);
       
        $this->template->page_title = 'instituciones';
        $this->template->content = $content;
    }

    public function action_edit() {
        $contra = $_GET['contra'];
        //$contra = $this->request->param('contra');
        $content = View::factory('institucionedit')->set('values', $_POST)->bind('errors', $errors)
                        ->bind('id', $id)->bind('instituciones', $instituciones)->bind('data', $data);
        $instituciones = ORM::factory('instituciones')->where('id', '=', $contra)->find();
        $data = $instituciones->as_array();
        //  if(!$instituciones->loaded()){HTTP::redirect('instituciones');}
        $instituciones = ORM::factory('instituciones')->find_all()->as_array();
        //$categories = $categories->find_all()->as_array();
        if (isset($_POST['submit'])) {
            $data[] = Arr::extract($_POST, array('nombreInstitucion', 'descripInsititucion', 'instiEstado', 'template'));
            $data = Arr::flatten($data);
            $instituciones->values($data);
            try {
                $instituciones->save();
                HTTP::redirect('instituciones');
            } catch (ORM_Validation_Exception $e) {
                $errors = $e->errors('validation');
            }
        }
        $this->template->page_title = 'instituciones';
        $this->template->content = $content;
    }

    public function action_eliminar() {
        $contra = $_GET['contra'];
        $instituciones = ORM::factory('instituciones', $contra);
        //$data = $instituciones->as_array();   
        $instituciones->delete();
        HTTP::redirect('instituciones');
    }

}