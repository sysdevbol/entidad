<?php defined('SYSPATH') or die('Acceso denegado');

class Controller_archivos1 extends Controller_index {

    public function action_index() {
        $this->template->title .='Subir Archivo';
        $this->template->content = View::factory('Archivos1');        
        $archivos1 = ORM::factory('archivos1')->where('proceso_id','=',$_GET['contra']);
        $archivos1 = $archivos1->find_all();
        $this->template->content = View::factory('archivos1')
                ->bind('errors', $errors)
                ->bind('archivos1', $archivos1);
    }

    public function action_archivos() {
        $errors = array();
        $id=$_GET['contra'];
        $proceso=ORM::factory('gestiones',$id);
        if ($_POST) {
            $id_archivo = 0;
            $archivo_texto = '';
            $post = Validation::factory($_FILES)
                    ->rule('archivo', 'Upload::not_empty')
                    ->rule('archivo', 'Upload::type', array(':value', array('jpg', 'png', 'gif', 'pdf', 'doc', 'docx', 'ppt', 'xls', 'xlsx')))
                    ->rule('archivo', 'Upload::size', array(':value', '3M'));
            // ->rules ( 'archivo', array (array ('Upload::valid' ), array ('Upload::type', array (':value', array ('pdf', 'doc', 'docx', 'ppt', 'xls', 'xlsx' ) ) ), array ('Upload::size', array (':value', '5M' ) ) ) );
            //si pasa la validacion guardamamos 
            if ($post->check()) {
                //guardamos el archivo
                $filename = upload::save($_FILES ['archivo1']);
                $archivo1 = ORM::factory('archivos1'); //intanciamos el modelo							
                $archivo1->archivo = basename($filename);
                $archivo1->extension = $_FILES ['archivo'] ['type'];
                $archivo1->size = $_FILES ['archivo'] ['size'];
                $archivo1->fecha = date('Y-m-d');
                $archivo1->proceso_id = $_POST['proceso_id'];
                // $archivo->id = $nuevo->id;
                $archivo->save();
                $_POST = array();
                //enviamos email
                // $this->template->content=View::factory('digitales');
            } else {
                $errors['Datos'] = 'No se pudo guardar, vuelva a intentarlo';
            }
        } else {
            $errors['Archivos'] = 'Ocurrio un error al subir el archivo';
        }
        $archivos=ORM::factory('archivos')->where('proceso_id','=',$id)->find_all();
        $this->template->content = View::factory('Archivos')
                ->bind('errors', $errors)
                ->bind('proceso', $proceso)
                ->bind('archivos', $archivos);
    }

    public function action_eliminar() {
        $contra = $_GET['contra'];
        $id = $_GET['a'];
        $archivo = ORM::factory('archivos', $id);
        //$data = $modalidades->as_array();   
        if($archivo->loaded())
        $archivo->delete();
        HTTP::redirect('archivos/archivos/?contra='.$contra);
    }

    //else{$this->save('','Formulario de denuncias');}
    // $this->template->title   .= 'Formulario de Denuncias';
    //$this->template->header=View::factory('menu',$ko3_inner)->render();
    // $this->template->scripts    =array('ckeditor/adapters/jquery.js','ckeditor/ckeditor.js');
    // $this->template->content = View::factory('')
    //                           ->bind('errors', $errors);                                    
}

?>
