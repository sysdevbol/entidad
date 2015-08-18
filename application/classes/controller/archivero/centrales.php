<?php defined('SYSPATH') or die('No direct script access.');

class Controller_archivero_centrales extends Controller_archivero_index {
    
     public  $user;
    public function before() {
        $auth = Auth::instance();
        if ($auth->get_user()) {
            $this->user = ORM::factory('users', $auth->get_user());
        }
        else
        {
            $this->request->redirect('/login');
        }
        parent::before();
        $this->template->user = $this->user;
        
    }

    //public function before() {parent::before();}    
    public function action_index() {
        if (isset($_POST['gestion'])) {
            $gestion = $_POST['gestion'];
            if ($gestion !== '') {

                $centrales = ORM::factory('centrales')
                        ->where('estado', '=', 1)
                        ->and_where('gestion', '=', $gestion)
                        ->find_all();
            } else {
                $centrales = ORM::factory('centrales')
                                ->where('estado', '=', 1)->find_all();
            }
        } else {
            $centrales = ORM::factory('centrales')
                            ->where('estado', '=', 1)->find_all();
        }
        $this->template->content = View::factory('archivero/centrales')
                ->bind('errors', $errors)
                ->bind('centrales', $centrales);
    }

    public function action_add() {
        
        if (isset($_POST['codReferencia'])) {
        
            $newcentral = ORM::factory('centrales');
            
            $fecha1=  explode('/',$_POST['fechaIni']);
            $fecha2=  explode('/',$_POST['fechaFin']);
            
            $newcentral->numCaja = $_POST['numCaja'];
            $newcentral->codReferencia = $_POST['codReferencia'];
            $newcentral->serDocumental =$_POST['serDocumental'];
            $newcentral->subSerie =$_POST['subSerie'];
            $newcentral->proyecto =$_POST['proyecto'];
            $newcentral->lugar =$_POST['lugar'];
            
            $newcentral->fechaIni =$fecha1[2].'-'.$fecha1[1].'-'.$fecha1[0];
           
            $newcentral->fechaFin =$fecha2[2].'-'.$fecha2[1].'-'.$fecha2[0];
            $newcentral->numTomo =$_POST['numTomo'];
            $newcentral->fojas =$_POST['fojas'];
            $newcentral->observacion =$_POST['observacion'];
            $newcentral->unidad = $_POST['unidad'];
            $newcentral->fechaCreacion = date('Y-m-d');
            $newcentral->id_user = $this->user->id;
            //$newcentral->id_user = $this->template->user->id;            
            $newcentral->save();
            if($newcentral->id){
                $this->request->redirect('archivero/centrales');
            }
           
        }
        $departamentos=ORM::factory('departamentos')->find_all();
        $unidades0=ORM::factory('unidades0')->find_all();
        $centrales = ORM::factory('centrales')->find_all();
        $content = View::factory('archivero/centraladd')
                        ->set('values', $_POST)
                        ->bind('centrales', $centrales)
                        ->bind('departamentos',$departamentos)
                        ->bind('unidades0', $unidades0)
                ->bind('errors', $errors);
       
        $this->template->page_title = 'archivero/centrales';
        $this->template->content = $content;
    }

    public function action_edit() {
        $contra = $_GET['contra'];
        if (isset($_POST['codReferencia'])) {
            $central = ORM::factory('centrals',$contra);
            $central->numCaja = $_POST['numCaja'];
            $central->codReferencia = $_POST['codReferencia'];
            $central->serDocumental = $_POST['serDocumental'];
            $central->subSerie = $_POST['subSerie'];
            $central->proyecto = $_POST['proyecto'];
            $central->lugar = $_POST['lugar'];
            $central->fechaIni = $_POST['fechaIni'];
            $central->fechaFin = $_POST['fechaFin'];
            $central->numTomo = $_POST['numTomo'];
            $central->fojas = $_POST['fojas'];
            $central->observacion = $_POST['observacion'];
            $central->save();
        }
        $centrales = ORM::factory('centrales', $contra);
        if ($centrales->loaded()) {            
            $content = View::factory('archivero/centraledit')->set('values', $_POST)->bind('errors', $errors)
                            ->bind('id', $id)->bind('centrales', $centrales)->bind('data', $data);
            $data = $centrales->as_array();            
            $centrales = ORM::factory('centrales')->find_all()->as_array();
            $this->template->page_title = 'centrales';
            $this->template->content = $content;
        }
        else
        {
            $this->template->content = "no existe la Regsitro";
        }
    }
    public function action_eliminar() {
        $contra = $_GET['contra'];
        $centrales = ORM::factory('Centrales', $contra);
       if($centrales->loaded()){
           $centrales->estado=0;
           $centrales->save();
           $archivos = ORM::factory('aarchivos')->where('proceso_id','=',$contra)->find_all();
           foreach($archivos as $a){
               $archivo = ORM::factory('aarchivos',$a->id);
               $archivo->estado=0;
               $archivo->save();
           }
       } 
       //HTTP::redirect('centrales');
        $this->action_index();
    }

}