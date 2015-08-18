<?php

defined('SYSPATH') or die('No direct script access.');

class Controller_archivero_reportes extends Controller_archivero_index {
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
	public function action_index(){
            $this->template->content=View::factory('archivero/reportes/test');
	}
	//programado vs Ejecutado por entidad
	public function modalidad() {
		$modalidades = $this->oReporte->modalidades();
		$meses = array ('Enero' => 1, 'Febrero' => 2, 'Marzo' => 3, 'Abril' => 4, 'Mayo' => 5, 'Junio' => 6, 'Julio' => 7, 'Agosto' => 8, 'Septiembre' => 9, 'Octubre' => 10, 'Noviembre' => 11, 'Diciembre' => 12 );
                if(($_SESSION['id']==1) or ($_SESSION['prioridad']==0)){
	  		$modalidades = $this->oModalidadodalidades->listar ();						
			if ($path = $this->existeFichero ( "reportes/formProgEjecEntidadGeneral.php" )) 
			include ($path);		
		}
		else 
		{			
			if ($path = $this->existeFichero ( "reportes/formProgEjecEntidad.php" )) 
			include ($path);
		}
	}	
	function viewReport() {
		$gestion = $_POST ['gestion'];
		$desde = $_POST ['desde'];
		$hasta = $_POST ['hasta'];
		if ($path = $this->existeFichero ( "reportes/reporte4.php" )) {
			include ($path);
		}
	}	
}
?>