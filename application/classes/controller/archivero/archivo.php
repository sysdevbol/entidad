<?php defined('SYSPATH') or die('Acceso denegado');

class Controller_archivero_archivo extends Controller_archivero_index {
  //  public $user;
    public function before() {
        $auth = Auth::instance();
        if ($auth->get_user()) {
            $user = ORM::factory('users', $auth->get_user());
        }
        else
        {
            $this->request->redirect('/login');
        }
        parent::before();
        $this->template->user = $user;
    }
    
    /*
      public function action_index() {
      $this->template->title .='Subir Archivo';
      $this->template->content = View::factory('archivos0');
      $archivos0 = ORM::factory('archivos0');
      $archivos0 = $archivos0->find_all();
      $this->template->content = View::factory('archivos0')
      ->bind('errors', $errors)
      ->bind('archivos0', $archivos0);
      } */

//archivo
    public function action_lista() {
        $errors = array();
        $id = $_GET['contra'];
        $tipo = $_GET['tipo'];
        switch ($tipo) {
            case 3:
                $proceso = ORM::factory('gestiones', $id);
                $nombre=$proceso->numContratacion;
                break;
            case 2:
                $proceso = ORM::factory('viviendas', $id);
                $nombre=$proceso->serDocumental;
                break;
            default :
                $proceso = ORM::factory('centrales', $id);
                $nombre='Serie Documental: '.$proceso->serDocumental;
                break;
        }        
        if ($_POST) {
            $id_archivo = 0;
            $archivo_texto = '';
            $post = Validation::factory($_FILES)
                    ->rule('archivo', 'Upload::not_empty')
                    ->rule('archivo', 'Upload::type', array(':value', array('pdf', 'doc', 'docx','xlsx')))
                    ->rule('archivo', 'Upload::size', array(':value', '3M'));
            // ->rules ( 'archivo', array (array ('Upload::valid' ), array ('Upload::type', array (':value', array ('pdf', 'doc', 'docx', 'ppt', 'xls', 'xlsx' ) ) ), array ('Upload::size', array (':value', '5M' ) ) ) );
            //si pasa la validacion guardamamos 
            if ($post->check()) {
                //guardamos el archivo
                $filename = upload::save($_FILES ['archivo']);
                $archivo = ORM::factory('aarchivos'); //intanciamos el modelo							
                $archivo->archivo = basename($filename);
                $archivo->extension = $_FILES ['archivo'] ['type'];
                $archivo->size = $_FILES ['archivo'] ['size'];
                $archivo->fecha = date('Y-m-d H:i:s');
                $archivo->proceso_id = $_POST['proceso_id'];
                $archivo->central_id = $tipo;
                $archivo->user_id = $this->template->user->id;
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
        //obentemos los archivos dato el tipo y el proceso
        $archivos = ORM::factory('aarchivos')
                ->where('proceso_id', '=', $id)
                ->where('central_id', '=', $tipo)
                ->find_all();
        $this->template->content = View::factory('archivero/lista_archivos')
                ->bind('errors', $errors)
                ->bind('proceso', $proceso)
                ->bind('nombre', $nombre)
                ->bind('archivos', $archivos);
    }

    public function action_eliminar() {
        $contra = $_GET['contra'];
        $id = $_GET['id'];
        $tipo = $_GET['tipo'];
        $archivo = ORM::factory('aarchivos', $id);
        //$data = $modalidades->as_array();   
        if ($archivo->loaded())
            $archivo->delete();
        //HTTP::redirect('archivo/lista/?contra=' . $contra.'&tipo='.$tipo);
        //$this->action_index();
        //$this->request->redirect('archivo/lista/?contra'.$contra.'&tipo='.$tipo);
        $this->request->redirect('archivero/archivo/lista/?contra='.$contra.'&tipo='.$tipo);
    }
                                        
}

?>
