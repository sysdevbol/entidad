<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Ajax extends Controller {

public function action_addUser()
    {
        $id_user=$_POST['id'];        
        $destinos=explode(';',$_POST['destinos']);
        foreach($destinos as $k=>$v)
        {
            if($v!='')
            {
                $destino=ORM::factory('destinatarios');
                $destino->id_usuario=$id_user;
                $destino->id_destino=$v;
                $destino->save();
            }
        }
        echo true;
    }
    
 public function action_theme(){
      $auth=Auth::instance();
      if($auth->logged_in()){          
          $usuario=ORM::factory('user',$auth->get_user());
          $usuario->theme=$_POST['theme'];
          $usuario->save();
        }
     
 }
  public function action_listaprempresas() {
        $oEmpresas = new Model_Empresas();
        $result = $oEmpresas->listaprempresas();
        echo json_encode($result);
    
  }
  
  public function action_listaprempresasproveedor() {
        $oEmpresas = new Model_Empresas();
        $result = $oEmpresas->listaprempresasproveedor();
        echo json_encode($result);
    
  }

  public function action_listaprcalificacion() {
        $oCalificaciones = new Model_Calificaciones();
        $result = $oCalificaciones->listaprcalificaciones();
        echo json_encode($result);
    
  }
  public function action_listaprcalificacioncons() {
        $oCalificaciones = new Model_Calificaciones();
        $result = $oCalificaciones->listaprcalificacionescons();
        echo json_encode($result);
    
  }

  public function action_listaprconsultores() {
        $oEmpresas = new Model_Consultores();
        $result = $oEmpresas->listaprconsultores();
        echo json_encode($result);
    
  }

  

  public function action_listaprempresasacc() {
        $oEmpresas = new Model_Empresas();
        $result = $oEmpresas->listaprempresasacc();
        echo json_encode($result);
    
  }
  
  public function action_listaexperiencia() {
        $ide=$_GET['ide'];
        $oEmpresas = new Model_Empresas();
        $result = $oEmpresas->listaexperiencia($ide);
        echo json_encode($result);
    
  }
  
  public function action_listasocios() {
        $ide=$_GET['ide'];
        $oEmpresas = new Model_Empresas();
        $result = $oEmpresas->listasocios($ide);
        echo json_encode($result);
    
  }
 public function action_editarexperiencia() {
        $idex = $_POST['idex'];
        $oEmpresas = new Model_Empresas();
        $result = $oEmpresas->editarexperiencia($idex);
        $result = $result[0];
        echo json_encode($result, JSON_HEX_APOS);
    
  } 
  
 public function action_autocomplete(){

        if (!isset($_GET['nombre_proponente'])) {
          die("");
        }

        $nombre_proponente = $_GET['nombre_proponente'];
        $oEmpresas = new Model_Empresas();
        $result = $oEmpresas->serachForKeyword($nombre_proponente);
        //$result=array ('asocia','asocion',$nombre_proponente);
        echo json_encode($result, JSON_HEX_APOS);
  } 

  public function action_guardarcalificacion() {
        $ide = $_POST['ide'];
        $session = Session::instance();
        $user = $session->get('auth_user');
        if($_POST['idclasificacion'] == '1'){
            $oempresas = new Model_Empresas();
            $result = $oempresas->verificahabilitado($ide);
        }elseif ($_POST['idclasificacion'] == '3') {
            $oconsultor = new Model_Consultores();
            $result = $oconsultor->verifyestado($ide);
        }
        $oempresas = new Model_Empresas();
        $result = $oempresas->verificahabilitado($ide);
        if($result == "ok"){
            $calificaciones = ORM::factory('calificaciones');
            $calificaciones->id_empresa = $ide;
            $calificaciones->id_user = $user->id;
            $calificaciones->calificacion = $_POST['calificacion'];
            $calificaciones->comentario = $_POST['comentario'];
            $calificaciones->fecha_registro = date('Y-m-d H:i:s');
            $calificaciones->id_clasificacion=$_POST['idclasificacion'];
            $calificaciones->save();
            echo json_encode(1);
        }else{
            echo json_encode(3);
        }
 }

 public function action_guardarconfirmacion() {
        $ide = $_POST['ide'];
        $session = Session::instance();
        $user = $session->get('auth_user');
        $empresas = ORM::factory('empresas',$ide);
        $empresas->estado = $_POST['estado'];
        $empresas->save();
        $verifica = ORM::factory('verificaobservaciones',$ide);
        $verifica->id_empresa = $ide;
        $verifica->id_user = $user->id;
        $verifica->observacion = $_POST['obs'];
        $verifica->fecha_registro = date('Y-m-d H:m:i');
        $verifica->id_clasificacion = 1;
        $verifica->save();
        $ranking = new Controller_Rankingempresas();
        $ranking->calificacionautomatica($ide,$user,$_POST['estado']);
        echo json_encode(1);
        
 }
 public function action_guardarconfirmacionproveedor() {
        $ide = $_POST['ide'];
        $session = Session::instance();
        $user = $session->get('auth_user');
        $empresas = ORM::factory('empresas',$ide);
        $empresas->estado = $_POST['estado'];
        $empresas->save();
        $verifica = ORM::factory('verificaobservaciones',$ide);
        $verifica->id_empresa = $ide;
        $verifica->id_user = $user->id;
        $verifica->observacion = $_POST['obs'];
        $verifica->fecha_registro = date('Y-m-d H:m:i');
        $verifica->id_clasificacion = 2;
        $verifica->save();
        echo json_encode(1);
        
 }
  
  public function action_guardarconfirmacionconsultor() {
        $ide = $_POST['ide'];
        $session = Session::instance();
        $user = $session->get('auth_user');
        $empresas = ORM::factory('consultores',$ide);
        $empresas->estado = $_POST['estado'];
        //$desembolsos->fecha_registro = date('Y-m-d H:m:i');
        $empresas->save();
        
        $verifica = ORM::factory('verificaobservaciones',$ide);
        $verifica->id_empresa = $ide;
        $verifica->id_user = $user->id;
        $verifica->observacion = $_POST['obs'];
        $verifica->fecha_registro = date('Y-m-d H:m:i');
        $verifica->id_clasificacion = 3;
        $verifica->save();
        $ranking = new Controller_Rankingconsultor();
        $ranking->calificacionautomatica1($ide,$user,$_POST['estado']);
        echo json_encode(1);
    
 }
   protected function currencyFormat( $number, $decimales = null ) {
        
    	if ( empty( $decimales ) ) {
           $decimales = 2;
        }
    	$number = number_format( $number, $decimales, ',', '.' );
        /*if($number==0)
        $number=$number*(-1);*/
      
        return $number;
    }

    protected function parse_number($number, $dec_point = null) {
        if (empty($dec_point)) {
            $locale = localeconv();
            $dec_point = $locale['decimal_point'];
        }
        return floatval(str_replace($dec_point, '.', preg_replace('/[^\d' . preg_quote($dec_point) . ']/', '', $number)));
    }
 

}
