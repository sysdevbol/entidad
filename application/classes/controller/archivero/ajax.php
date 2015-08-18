<?php defined('SYSPATH') or die('No direct script access.');
class Controller_archivero_ajax extends Controller {
public function action_gestionesJson()
{
    $gestiones=new Model_gestiones();
    echo json_encode($gestiones->listar2()->as_array());            
}
public function action_gestion()
{
    $oGestiones=new Model_gestiones();
    echo json_encode($oGestiones->lista());
}
public function action_central()
{
    $oCentrales=new Model_centrales();
    echo json_encode($oCentrales->lista());
}
 
public function action_vivienda()
{
    $oviviendas=new Model_viviendas();
    echo json_encode($oviviendas->lista());
}

public function action_gestiones()
{
    $ges=$_POST['gestiones'];
    $agestiones=ORM::factory('gestiones')
                ->where('id','=',$ges)
                ->find_all();
    $gestiones=array();
    $i=0;
    foreach ($gestiones as $g) {
        $aGestiones[$i]['key']=$p->ges;
        $aGestiones[$i]['value']=$p->ges;
        $i++;
    }
    echo json_encode($aGestiones);
}
}