<?php defined('SYSPATH') or die('No direct script access.');
class Controller_archivero_principal extends Controller_archivero_index {
    
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
    
    
	public function action_index(){
            //$this->template->content=View::factory('reportes/dash');
            $result = mysql_query("SELECT COUNT(*) as cantidad, modalidad FROM gestiones
            GROUP BY modalidad");
            
            $gestiones=ORM::factory('gestiones')->count_all();
            $centrales=ORM::factory('centrales')->count_all();
            $viviendas=ORM::factory('viviendas')->count_all();
            //$this->template->styles=array( 'media/css/flick/jquery-ui-1.9.0.custom.css'=>'all');
           // $this->template->scripts=array(
                                      
             //                          'media/Highcharts/js/highcharts.js',  'media/Highcharts/js/modules/exporting.js',);
        
        $this->template->content=View::factory('archivero/reportes/dash')
                                    ->bind('gestiones', $gestiones)
                                    ->bind('viviendas', $viviendas)
                                    ->bind('centrales', $centrales);
            
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