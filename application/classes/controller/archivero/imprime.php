<?php

defined('SYSPATH') or die('Acceso denegado');

class Controller_archivero_reportesadjudicado extends Controller_archivero_index {

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
            $result = $gestiones->reporteproponente($_POST['proponente'], $fecha1, $fecha2);
            //var_dump($result);
            $this->template->content = View::factory('archivero/reportes/impresion')
                    ->bind('result', $result);
        
        } 
        
    }

    