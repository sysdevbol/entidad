<?php defined('SYSPATH') or die('No direct script access.');

class Controller_archivero_listaarchivo extends Controller_archivero_index{
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
    public function before(){parent::before();$this->template->page_title = 'Archivo de Gestion';}
    
    public function action_index(){
        //$listaarchivo = ORM::factory('listaarchivo')->find_all();
        $this->template->page_title = 'Archivo de Gestion';
        $this->template->content = View::factory('listaarchivo')->bind('listaarchivo',$listaarchivo);
    }
    
    public function action_listaarchivo(){
        $lista = $this->request->param('lista');
        $listaarchivo = ORM::factory('listaarchivo')->where('listaarchivo','=',$lista)->find()->as_array();
        //print '<pre>'; print_r($articles); print '</pre>'; echo '<br>'; exit;
        $archivogestiones = View::factory('listaarchivo')->bind('listaarchivo',$listaarchivo);
        $this->template->page_title = '';
        $this->template->description = $listaarchivo['niCuce'];
        $this->template->keywords = $listaarchivo['numHojaruta'];
        $this->template->content = $listaarchivo;
    }
    
}