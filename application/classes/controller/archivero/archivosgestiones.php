<?php defined('SYSPATH') or die('No direct script access.');

class Controller_archivero_archivosgestiones extends Controller_archivero_index{
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
        $archivosgestiones = ORM::factory('archivogestiones')->find_all();
        $this->template->page_title = 'Archivo de Gestion';
        $this->template->content = View::factory('archivero/archivosgestiones')->bind('archivosgestiones',$archivosgestiones);
    }
    
    public function action_archivogestiones(){
        $contra = $this->request->param('contra');
        $archivosgestiones = ORM::factory('archivogestiones')->where('objetoContra','=',$contra)->find()->as_array();
        //print '<pre>'; print_r($articles); print '</pre>'; echo '<br>'; exit;
        $archivogestiones = View::factory('archivogestiones')->bind('archivosgestiones',$archivosgestiones);
        $this->template->page_title = 'Arcchivo gestion';
        $this->template->description = $archivosgestiones['niCuce'];
        $this->template->keywords = $archivosgestiones['numHojaruta'];
        $this->template->content = $archivogestiones;
    }
    
    public function action_add(){
        
        $content = View::factory('archivosgestionadd')->set('values',$_POST)->bind('errors',$errors)
                ->bind('mods',$modalidades)->bind('data',$data)
                ;
        $modalidades = ORM::factory('modalidades')->find_all()->as_array();
        //print '<pre>'; print_r($categories); print '</pre>'; echo '<br>'; exit;
        if(isset($_POST['submit'])){
            $data = Arr::extract($_POST,array('idMod','numContratacion','objetoContra','unidadEjecutora','niCuce','numHojaruta','precioContra'));
            $pages = ORM::factory('archivogestiones');
            $pages->values($data);
            try{$pages->save();HTTP::redirect('archivosgestiones');}
            catch(ORM_Validation_Exception $e){$errors = $e->errors('validation');}
        }
        $this->template->page_title = 'Añadir esta Pagina';
        $this->template->content = $content;
    }
    
    public function action_edit(){
        
        $contra = $this->request->param('contra');
        
        $content = View::factory('archivosgestionedit')->set('values',$_POST)->bind('errors',$errors)
                ->bind('id',$id)->bind('data',$data)->bind('mods',$modalidades)
                ;
        //echo $article_alias;
        $pages = ORM::factory('archivogestiones')->where('objetoContra','=',$contra)->find();
        //print '<pre>'; print_r($pages); print '</pre>'; echo '<br>'; exit;
        if(!$pages->loaded()){HTTP::redirect('archivosgestiones');}
        $modalidades = ORM::factory('modalidades');
        $modalidades = $modalidades->find_all()->as_array();
        $data = $pages->as_array();
        $data['idMod'] = $pages->modalidades->find_all()->as_array();
        //print '<pre>'; print_r($data['cat_id']); print '</pre>'; echo '<br>'; exit;
        if (isset($_POST['submit'])){
            //print '<pre>'; print_r($_POST); print '</pre>'; echo '<br>'; exit;
            //$data = Arr::extract($_POST,array('article_title','article_alias','article_text','article_description','article_keywords','article_status'));
            //$data = Arr::flatten($data);
            $data['numContratacion'] = Arr::get($_POST,'numContratacion');
            $data['objetoContra'] = Arr::get($_POST,'objetoContra');
            $data['unidadEjecutora'] = Arr::get($_POST,'unidadEjecutora');
            $data['niCuce'] = Arr::get($_POST,'niCuce');
            $data['numHojaruta'] = Arr::get($_POST,'numHojaruta');
            $data['precioContra'] = Arr::get($_POST,'precioContra');
            //$data[] = Arr::extract($_POST,array('cat_id'));
            
            $pages->values($data);
            //print '<pre>'; print_r($data['cat_id']); print '</pre>'; echo '<br>'; exit;
            try {
                $pages->save();
                //$pages->remove('categories');
                //$pages->add('categories',$data['cat_id']);
                ///HTTP::redirect('articles');
           }catch(ORM_Validation_Exception $e){$errors = $e->errors('validation');}
        }
        //print '<pre>'; print_r($data['cat_id']); print '</pre>'; echo '<br>'; exit;
        $this->template->page_title = 'Рagina Nueva';
        $this->template->content = $content;
    }
    
    public function action_delete(){
        $contra = $this->request->param('contra');
        $pages = ORM::factory('Archivogestiones')->where('objetoContra','=',$contra)->find();
        if(!$pages->loaded()){HTTP::redirect('archivosgestiones');}
        $pages->delete();
        HTTP::redirect('archivosgestiones');
    }

}