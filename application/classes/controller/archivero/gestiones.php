<?php defined('SYSPATH') or die('No direct script access.');

class Controller_archivero_gestiones extends Controller_archivero_index {

    public function before() {
        $auth = Auth::instance();
        if ($auth->get_user()) {
            $user = ORM::factory('users', $auth->get_user());
        } else {
            $this->request->redirect('/login');
        }
        parent::before();
        $this->template->user = $user;
    }

    ////////////////desde aqui

    /*  protected $user;
      protected $menus;
      public function before()
      {
      $auth =  Auth::instance();
      //si el usuario esta logeado entocnes mostramos el menu
      if($auth->logged_in())
      {
      //menu top de acuerdo al nivel
      $session=Session::instance();
      $this->user=$session->get('auth_user');
      $oNivel=New Model_niveles();
      $this->menus=$oNivel->menus($this->user->nivel);
      parent::before();
      $this->template->title='Ventanilla';
      }
      else
      {
      $this->request->redirect('/login');
      }
      }

      /////////////////hasta aqui */
    public function action_index() {
        if (isset($_POST['gestion'])) {
            $gestion = $_POST['gestion'];
            if ($gestion !== '') {
                
                $mes=$_POST['mes'];
                if($mes>0){
                    $gestiones = ORM::factory('gestiones')
                        ->where('estado', '=', 1)
                        ->and_where('gestion', '=', $gestion)
                        ->and_where('mes', '=', $mes)
                        ->find_all();
                }
                //todos los meses
                else{
                $gestiones = ORM::factory('gestiones')
                        ->where('estado', '=', 1)
                        ->and_where('gestion', '=', $gestion)
                        ->find_all();
                }
            } 
            //todas las gestiones
            else {                                
                $gestiones = ORM::factory('gestiones')
                                ->where('estado', '=', 1)->find_all();
            }
        } else {
            $gestiones = ORM::factory('gestiones')
                            ->where('estado', '=', 1)->find_all();
        }
        $this->template->content = View::factory('archivero/gestiones')
                ->bind('errors', $errors)
                ->bind('gestiones', $gestiones);
    }

    public function action_add() {

        if (isset($_POST['objetoContra'])) {
            $newgestion = ORM::factory('gestiones');

            $newgestion->numContratacion = $_POST['numContratacion'];
            $newgestion->objetoContra = $_POST['objetoContra'];
            $newgestion->modalidad = $_POST['modalidad'];
            $newgestion->niCuce = $_POST['niCuce'];
            $newgestion->proponente = $_POST['proponente'];
            $newgestion->ordenCompra = $_POST['ordenCompra'];
            $newgestion->precioContra = $_POST['precioContra'];
            $newgestion->nomProceso = $_POST['nomProceso'];
            $newgestion->fuente = $_POST['fuente'];
            $newgestion->nomUnidad = $_POST['nomUnidad'];
            $newgestion->numHojaruta = $_POST['numHojaruta'];
            $newgestion->inicioContrato = $_POST['inicioContrato'];
            $newgestion->gestion = $_POST['gestion'];
            $newgestion->mes = $_POST['mes'];
            $newgestion->fechaCreacion = date('Y-m-d');
            $newgestion->id_user = $this->template->user->id;
            $newgestion->save();
            if ($newgestion->id) {
                $this->request->redirect('archivero/gestiones');
            }
        }
        $gestiones = ORM::factory('gestiones')->find_all();
        $modalidades = ORM::factory('modalidades')->find_all();
        $estadoprocesos = ORM::factory('estadoprocesos')->find_all();
        $financiamientos = ORM::factory('financiamientos')->find_all();
        $argestiones = ORM::factory('argestiones')->find_all();
        $unidades0 = ORM::factory('unidades0')->find_all();
        $content = View::factory('archivero/gestionadd')
                ->set('values', $_POST)
                ->bind('gestiones', $gestiones)
                ->bind('modalidades', $modalidades)
                ->bind('estadoprocesos', $estadoprocesos)
                ->bind('financiamientos', $financiamientos)
                ->bind('unidades0', $unidades0)
                ->bind('argestiones', $argestiones)
                ->bind('errors', $errors);

        $this->template->page_title = 'Gestiones';
        $this->template->content = $content;
    }

    public function action_edit() {
        $contra = $_GET['contra'];
        if (isset($_POST['numContratacion'])) {
            $gestion = ORM::factory('gestiones', $contra);
            $gestion->numContratacion = $_POST['numContratacion'];
            $gestion->objetoContra = $_POST['objetoContra'];
            $gestion->modalidad = $_POST['modalidad'];
            $gestion->niCuce = $_POST['niCuce'];
            $gestion->proponente = $_POST['proponente'];
            $gestion->ordenCompra = $_POST['ordenCompra'];
            $gestion->precioContra = $_POST['precioContra'];
            $gestion->nomProceso = $_POST['nomProceso'];
            $gestion->fuente = $_POST['fuente'];
            $gestion->nomUnidad = $_POST['nomUnidad'];
            $gestion->numHojaruta = $_POST['numHojaruta'];
            $gestion->save();
        }
        $gestiones = ORM::factory('gestiones', $contra);
        if ($gestiones->loaded()) {
            $content = View::factory('archivero/gestionedit')->set('values', $_POST)->bind('errors', $errors)
                            ->bind('id', $id)->bind('gestiones', $gestiones)->bind('data', $data);
            $data = $gestiones->as_array();
            $gestiones = ORM::factory('gestiones')->find_all()->as_array();
            $this->template->page_title = 'gestiones';
            $this->template->content = $content;
        } else {
            $this->template->content = "no existe el Registro";
        }
    }

    public function action_eliminar() {
        $contra = $_GET['contra'];
        $gestiones = ORM::factory('gestiones', $contra);
        if ($gestiones->loaded()) {
            $gestiones->estado = 0;
            $gestiones->save();
            $archivos = ORM::factory('aarchivos')->where('proceso_id', '=', $contra)->find_all();
            foreach ($archivos as $a) {
                $archivo = ORM::factory('aarchivos', $a->id);
                $archivo->estado = 0;
                $archivo->save();
            }
        }
        //HTTP::redirect('centrales');
        $this->action_index();
    }

    public function listar_grid() {
        //$lista=$this->->listar();
        if ($path = $this->existeFichero("gestiones.php")) {
            include ($path);
        }
    }

}