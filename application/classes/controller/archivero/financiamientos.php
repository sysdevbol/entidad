<?php defined('SYSPATH') or die('No direct script access.');

class Controller_archivero_financiamientos extends Controller_archivero_index {
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
        $financiamientos = ORM::factory('financiamientos');
        $financiamientos = $financiamientos->find_all();
        $this->template->content = View::factory('archivero/financiamientos')
                        ->bind('errors', $errors)
                        ->bind('financiamientos', $financiamientos);
        //$this->template->page_title = 'modalidades';
        //  $this->template->content = $content;
        
    }

    public function action_add() {
        
        if (isset($_POST['fuenteDescripcion'])) {
           // $mod = Arr::extract($_POST, array('nomModalidad', 'modaDescripcion', 'idMod'));
            $newfinanciamiento = ORM::factory('financiamientos');
            //print '<pre>'; print_r($cat); print '</pre>'; echo '<br>';
            $newfinanciamiento->fuente = $_POST['fuente'];
            $newfinanciamiento->fuenteDescripcion = $_POST['fuenteDescripcion'];
            $newfinanciamiento->save();
            HTTP::redirect('financiamientos');
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
        $financiamientos = ORM::factory('financiamientos')->find_all();
        $content = View::factory('archivero/financiamientoadd')
                        ->set('values', $_POST)
                        ->bind('financiamientos', $financiamientos)
                        ->bind('errors', $errors);
       
        $this->template->page_title = 'financiamientos';
        $this->template->content = $content;
    }

    public function action_edit() {
        $fin = $_GET['fin'];
        //$contra = $this->request->param('contra');
        $content = View::factory('archivero/financiamientoedit')->set('values', $_POST)->bind('errors', $errors)
                        ->bind('id', $id)->bind('financiamientos', $financiamientos)->bind('data', $data);
        $financiamientos = ORM::factory('financiamientos')->where('id', '=', $fin)->find();
        $data = $financiamientos->as_array();
        //  if(!$modalidades->loaded()){HTTP::redirect('modalidades');}
        $financiamientos = ORM::factory('Financiamientos')->find_all()->as_array();
        //$categories = $categories->find_all()->as_array();
        if (isset($_POST['submit'])) {
            $data[] = Arr::extract($_POST, array('fuente', 'fuenteDescripcion', 'template'));
            $data = Arr::flatten($data);
            $financiamientos->values($data);
            try {
                $financiamientos->save();
                HTTP::redirect('financiamientos');
            } catch (ORM_Validation_Exception $e) {
                $errors = $e->errors('validation');
            }
        }
        $this->template->page_title = 'financiamientos';
        $this->template->content = $content;
    }

    public function action_eliminar() {
        $fin = $_GET['fin'];
        $financiamientos = ORM::factory('financiamientos', $fin);
        //$data = $modalidades->as_array();   
        $financiamientos->delete();
        //HTTP::redirect('financiamientos');
        $this->action_index();
    }

}