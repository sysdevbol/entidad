<?php
defined('SYSPATH') or die('No direct script access.');
class Controller_archivero_json extends Controller{
    //lista de las  
    public function action_archivosgestiones(){
        $archivosgestiones=  New Model_data();
        $archivo=$archivosgestiones->archivosgestiones();     
        //$archivosgestiones=ORM::factory('nomContratacion')->where('nomDescripcion','=','1')->find_all()->as_array();
        echo json_encode($archivo);
    }
    public function action_financiamientos(){
        $fuente=ORM::factory('fuente',HTML::chars(Arr::get($_POST, 'id')));
        echo $fuente->fuente;
    }
    public function action_adjudicaciones($id=''){
   if ($this->request->is_ajax()) {
    echo 'adjudicaciones';// Screw the master template
    // Do something shiny
} else {
    echo 'sss';// Fall back to standard page view
}
    }
}
?>
