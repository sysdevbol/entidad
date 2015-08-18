<?php

defined('SYSPATH') or die('Acceso denegado');

class Controller_archivero_reportesuser extends Controller_archivero_index {

    public $user;

    public function after() {
        $auth = Auth::instance();
        if ($auth->get_user()) {
            $user = ORM::factory('users', $auth->get_user());
        } else {
            $this->request->redirect('/login');
        }
        $this->template->user = $user;
        parent::after();
    }

    public function action_index() {
        if (isset($_POST['submit'])) {
            $archivos = new Model_aarchivos();
            $fecha_1 = explode('/', $_POST['fechaIni']);
            $fecha_2 = explode('/', $_POST['fechaFin']);
            $fecha1 = $fecha_1[2] . '-' . $fecha_1[1] . '-' . $fecha_1[0] . ' 00:00:00';
            $fecha2 = $fecha_2[2] . '-' . $fecha_2[1] . '-' . $fecha_2[0] . ' 23:59:59';
            $_POST['fecha1']=$fecha1;
            $_POST['fecha2']=$fecha2;
            switch ($_POST['tipo']) {
                case 1:
                    $result = $archivos->reporte1($_POST['user'], $fecha1, $fecha2);
                    $this->template->content = View::factory('archivero/reportes/result1')
                                                    ->bind('post', $_POST)
                                                    ->bind('result', $result);
                    break;
                case 2:
                    $result = $archivos->reporte2($_POST['user'], $fecha1, $fecha2);
                    $this->template->content = View::factory('archivero/reportes/result2')
                                                    ->bind('post', $_POST)
                                                    ->bind('result', $result);
                    break;
                default:
                    $result = $archivos->reporte3($_POST['user'], $fecha1, $fecha2);
                    $this->template->content = View::factory('archivero/reportes/result3')
                                                    ->bind('post', $_POST)
                                                    ->bind('result', $result);
                    break;
            }
        } else {
            $tipos = ORM::factory('tipoarchivos')->find_all();
            $users = ORM::factory('users')->find_all();
            $this->template->content = View::factory('archivero/reportes/vistauser')
                    ->bind('tipos', $tipos)                    
                    ->bind('users', $users);
        }
    }

    public function action_archivos(){
        $tipo=$_GET['tipo'];
        $proceso=$_GET['proceso'];
        $archivos=  ORM::factory('aarchivos')
                    ->where('central_id','=',$tipo)
                    ->and_where('proceso_id','=',$proceso)
                    ->find_all();
        $this->template->content=View::factory('archivero/reportes/result_archivo')
                            ->bind('archivos', $archivos);
    }
    
    public function action_reporteuser() {
        $data = array();
        $sql = "SELECT aarchivos.archivo,
    aarchivos.user_id,
    aarchivos.fecha,
    users.nombre
    FROM
    aarchivos ,
    users
    WHERE
    aarchivos.user_id = 95
    AND aarchivos.user_id=users.id( ";
        foreach ($usuarios as $u):
            $data1[$u->id] = array(
                'id' => $u->id,
                'nombre' => $u->nombre);
            $sql.=$u->id . ", ";
        endforeach;
        $sql = substr($sql, 0, -2);
        $sql.=" ) GROUP BY u.id";
        $a = New Model_Aarchivos();
        echo json_encode($data);
    }

}