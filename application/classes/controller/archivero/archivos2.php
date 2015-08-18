<?php defined('SYSPATH') or die('Acceso denegado');

class Controller_archivos2 extends Controller_index {

    public function action_index45() {
        $this->template->title .='Subir Archivo';
        $this->template->content = View::factory('Archivos2');
        $archivos2 = ORM::factory('Archivos2')->where('proceso_id','=',$_GET['contra']);
        $archivos2 = $archivos2->find_all();
        $this->template->content = View::factory('Archivos2')
                ->bind('errors', $errors)
                ->bind('archivos2', $archivos2);
    }

    public function action_index() {
        $errors = array();
        $id=$_GET['contra'];
        $proceso=ORM::factory('gestiones',$id);
        if ($_POST) {
            $id_archivo = 0;
            $archivo_texto = '';
          /*  $post = Validation::factory($_FILES)
                    ->rule('archivo', 'Upload::not_empty')
                    ->rule('archivo', 'Upload::type', array(':value', array('jpg', 'png', 'gif', 'pdf', 'doc', 'docx', 'ppt', 'xls', 'xlsx')))
                    ->rule('archivo', 'Upload::size', array(':value', '3M'));
            // ->rules ( 'archivo', array (array ('Upload::valid' ), array ('Upload::type', array (':value', array ('pdf', 'doc', 'docx', 'ppt', 'xls', 'xlsx' ) ) ), array ('Upload::size', array (':value', '5M' ) ) ) );
           */ //si pasa la validacion guardamamos 
          //  if ($post->check()) {
                //guardamos el archivo
                $filename = upload::save($_FILES ['archivo']);
                $archivo = ORM::factory('archivos2'); //intanciamos el modelo							
                $archivo->archivo = basename($filename);
                $archivo->extension = $_FILES ['archivo'] ['type'];
                $archivo->size = $_FILES ['archivo'] ['size'];
                $archivo->fecha = date('Y-m-d');
                $archivo->proceso_id =$id;
                // $archivo->id = $nuevo->id;
                $archivo->save();
                $_POST = array();
                //enviamos email
                // $this->template->content=View::factory('digitales');
           /* } else {
                $errors['Datos'] = 'No se pudo guardar, vuelva a intentarlo';
            }*/
        } else {
            $errors['Archivos'] = 'Ocurrio un error al subir el archivo';
        }
        $archivos=ORM::factory('archivos2')->where('proceso_id','=',$id)->find_all();
        $this->template->content = View::factory('Archivos2')
                ->bind('errors', $errors)
                ->bind('proceso', $proceso)
                ->bind('archivos2', $archivos);
    }

    public function action_eliminar() {
        $contra = $_GET['contra'];
        $id = $_GET['archivos2'];
        $archivo = ORM::factory('Archivos', $id);
        //$data = $modalidades->as_array();   
        if($archivo->loaded())
        $archivo->delete();
        HTTP::redirect('archivos/archivos/?contra='.$contra);
    }
                                   
}

?>
