<?php defined('SYSPATH') or die('No direct script access.');

class Controller_archivero_viviendas extends Controller_archivero_index {
    
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

                $viviendas = ORM::factory('viviendas')
                        ->where('estado', '=', 1)
                        ->and_where('gestion', '=', $gestion)
                        ->find_all();
            } else {
                $viviendas = ORM::factory('viviendas')
                                ->where('estado', '=', 1)->find_all();
            }
        } else {
            $viviendas = ORM::factory('viviendas')
                            ->where('estado', '=', 1)->find_all();
        }
        $this->template->content = View::factory('archivero/viviendas')
                ->bind('errors', $errors)
                ->bind('viviendas', $viviendas);
    }
    
    public function action_add() {

        if (isset($_POST['codReferencia'])) {
            // $mod = Arr::extract($_POST, array('nomModalidad', 'modaDescripcion', 'idMod'));
            $newvivienda = ORM::factory('viviendas');
            //print '<pre>'; print_r($cat); print '</pre>'; echo '<br>';

            $fecha1 = explode('/', $_POST['fechaIni']);
            $fecha2 = explode('/', $_POST['fechaFin']);

            $newvivienda->numCaja = $_POST['numCaja'];
            $newvivienda->codReferencia = $_POST['codReferencia'];
            $newvivienda->serDocumental = $_POST['serDocumental'];
            $newvivienda->subSerie = $_POST['subSerie'];
            $newvivienda->proyecto = $_POST['proyecto'];
            $newvivienda->lugar = $_POST['lugar'];
            $newvivienda->fechaIni = $fecha1[2] . '-' . $fecha1[1] . '-' . $fecha1[0];
            // $newvivienda->fechaIni=$_POST['y/m/d'];
            $newvivienda->fechaFin = $fecha2[2] . '-' . $fecha2[1] . '-' . $fecha2[0];
            // $newvivienda->cambiarFormato('fechaIni');
            // $newvivienda->cambiarFormato('fechaFin');
            // $newvivienda->fechaIni=$_POST['fechaIni'];
            //  $newvivienda->fechaFin=$_POST['fechaFin'];
            $newvivienda->numTomo = $_POST['numTomo'];
            $newvivienda->fojas = $_POST['fojas'];
            $newvivienda->observacion = $_POST['observacion'];
            $newvivienda->fechaCreacion = date('Y-m-d');
            $newvivienda->id_user = $this->user->id;
            //$newvivienda->id_user = $this->template->user->id;
            $newvivienda->save();
            if($newvivienda->id){
                $this->request->redirect('archivero/viviendas');
            }
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
        $departamentos = ORM::factory('departamentos')->find_all();
        $viviendas = ORM::factory('viviendas')->find_all();
        $content = View::factory('archivero/viviendaadd')
                ->set('values', $_POST)
                ->bind('viviendas', $viviendas)
                ->bind('departamentos', $departamentos)
                ->bind('errors', $errors);

        $this->template->page_title = 'viviendas';
        $this->template->content = $content;
    }

    public function action_edit() {
        $contra = $_GET['contra'];
        if (isset($_POST['codReferencia'])) {
            $vivienda = ORM::factory('viviendas', $contra);
            $vivienda->numCaja = $_POST['numCaja'];
            $vivienda->codReferencia = $_POST['codReferencia'];
            $vivienda->serDocumental = $_POST['serDocumental'];
            $vivienda->subSerie = $_POST['subSerie'];
            $vivienda->proyecto = $_POST['proyecto'];
            $vivienda->lugar = $_POST['lugar'];
            $vivienda->fechaIni = $_POST['fechaIni'];
            $vivienda->fechaFin = $_POST['fechaFin'];
            $vivienda->numTomo = $_POST['numTomo'];
            $vivienda->fojas = $_POST['fojas'];
            $vivienda->observacion = $_POST['observacion'];
            $vivienda->save();
        }
        $viviendas = ORM::factory('viviendas', $contra);
        if ($viviendas->loaded()) {
            $content = View::factory('archivero/viviendaedit')->set('values', $_POST)->bind('errors', $errors)
                            ->bind('id', $id)->bind('viviendas', $viviendas)->bind('data', $data);
            $data = $viviendas->as_array();
            $viviendas = ORM::factory('viviendas')->find_all()->as_array();
            $this->template->page_title = 'viviendas';
            $this->template->content = $content;
        } else {
            $this->template->content = "no existe el Regsitro";
        }
    }

    public function action_eliminar() {
        $contra = $_GET['contra'];
        $viviendas = ORM::factory('viviendas', $contra);
       if($viviendas->loaded()){
           $viviendas->estado=0;
           $viviendas->save();
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
    

    function cambiarFormato($fecha) {
        list ( $anio, $mes, $dia ) = explode("-", $fecha);
        $meses =
                array(1 => "Enero", 2 => "Febrero", 3 => "Marzo", 4 => "Abril", 5 => "Mayo", 6 => "Junio", 7 => "Julio", 8 => "Agosto", 9 => "Septiembre", 10 => "Octubre", 11 => "Noviembre", 12 => "Diciembre");
        $mes = intval($mes);
        $mes = $meses [$mes];
        return $dia . " de " . $mes . " de " . $anio;
    }

}