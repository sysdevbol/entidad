<?php
defined('SYSPATH') or die('Acceso denegado');
class Controller_Rankingconsultor{
    

    public function calificacionautomatica1($idempresa,$users,$estado){
      if($estado == "4"){
        $proyecto = 1;
        if($users == "564"){
            $userid = 564;
            $deptocalifica = 2;
        }else{
            $ouser = new Model_Users();
            $deptocalifica = $ouser->iddeptouser($users->id);
            $userid = $users->id;
        }
        $notafinal1 = $this->califica1($idempresa,$proyecto,$deptocalifica);
        $calificaciones = ORM::factory('calificaciones');
        $calificaciones->id_empresa = $idempresa;
        $calificaciones->id_user = $userid;
        $calificaciones->calificacion = $notafinal1;
        $calificaciones->comentario = "Nota para proyectos en Vivienda Nueva (GENERADO POR EL SISTEMA)";
        $calificaciones->fecha_registro = date('Y-m-d H:i:s');
        $calificaciones->id_clasificacion="3";
        $calificaciones->save();
      }  
  }
    public function califica1($idempresa,$id_proyecto,$deptocalifica){
        $calificaciontotal = 0;
        $clasificacion = '3';//consultores
        $proyecto = $id_proyecto;//vivienda nueva
        if($proyecto == '1'){
            
            $area = '1';//exp general por monto
            $calificaciontotal = $calificaciontotal+$this->expgeneralconsultor($idempresa,$clasificacion,$proyecto,$area);
            $area = '2';//exp especifica
            $calificaciontotal = $calificaciontotal+$this->expespecificacons($idempresa,$clasificacion,$proyecto,$area);
            $area = '4';//exp especifica por depto
            $depto = $deptocalifica;//Departamento donde se califica
            $calificaciontotal = $calificaciontotal+$this->expdeptocons($idempresa,$clasificacion,$proyecto,$area,$depto);
            $area = '7';//formacion academica
            $calificaciontotal = $calificaciontotal+$this->expformacion($idempresa,$clasificacion,$proyecto,$area);
            $area = '5';
            $calificaciontotal = $calificaciontotal+$this->identificacion($idempresa,$clasificacion,$proyecto,$area); //Identificacion Consultor +10
            
        }
        /*
        if($proyecto == '2'){
            
            $area = '1';//exp general por monto
            $calificaciontotal = $calificaciontotal+$this->expgeneral($idempresa,$clasificacion,$proyecto,$area);
            $area = '2';//exp especifica
            $calificaciontotal = $calificaciontotal+$this->expespecifica($idempresa,$clasificacion,$proyecto,$area);
            $area = '6';//exp area especifica
            $calificaciontotal = $calificaciontotal+$this->exparea($idempresa,$clasificacion,$proyecto,$area);
            $area = '4';//exp especifica por depto
            $depto = $deptocalifica;//Departamento donde se califica
            $calificaciontotal = $calificaciontotal+$this->expdepto($idempresa,$clasificacion,$proyecto,$area,$depto);
            $area = '5';//identificacion
            $calificaciontotal = $calificaciontotal+$this->identificacion($idempresa,$clasificacion,$proyecto,$area);
            
        }
        */
        return $calificaciontotal;
    }
    public function expgeneralconsultor($id,$clasificacion,$proyecto,$area){
        $experienciacons = new Model_Experienciaconsultor();
        $montoexpgen = $experienciacons->montoexp($id);
        if(empty($montoexpgen)){
            $montoexpgen = 0;    
        }
        $patroncalifica = new Model_Patrondecalificacion();
        $resultado = $patroncalifica->califica1($montoexpgen,$clasificacion,$proyecto,$area);
        if(empty($resultado)){
            $resultado = 0;
        }
        return $resultado;
    }
    public function expespecificacons($id,$clasificacion,$proyecto,$area){
        $experienciacons = new Model_Experienciaconsultor();
        $cantanios = $experienciacons->cantaniosexp($id);
        if(empty($cantanios)){
            $cantanios = 0;    
        }
        $patroncalifica = new Model_Patrondecalificacion();
        $resultado = $patroncalifica->califica1($cantanios,$clasificacion,$proyecto,$area);
        if(empty($resultado)){
            $resultado = 0;
        }
        return $resultado;
    }
    public function expdeptocons($id,$clasificacion,$proyecto,$area,$depto){
        $experienciacons = new Model_Experienciaconsultor();
        $porcdepto = $experienciacons->porcentajepordepto($id,$depto);
        if(empty($porcdepto)){
            $porcdepto = 0;    
        }
        $patroncalifica = new Model_Patrondecalificacion();
        $resultado = $patroncalifica->califica1($porcdepto,$clasificacion,$proyecto,$area);
        if(empty($resultado)){
            $resultado = 0;
        }
        return $resultado;
    }
    public function identificacion($id,$clasificacion,$proyecto,$area){
        $tipo = $clasificacion;
        $patroncalifica = new Model_Patrondecalificacion();
        $resultado = $patroncalifica->califica2($tipo,$clasificacion,$proyecto,$area);
        if(empty($resultado)){
            $resultado = 0;
        }
        return $resultado;
    }
    public function expformacion($id,$clasificacion,$proyecto,$area){
        $formacion ="";
        $formacioncons = new Model_Formacionconsultor();
        $tpn = $formacioncons->verificatpn($id);
        $postgradocons = new Model_Postgradoconsultor();
        $diplomado = $postgradocons->verificadiplomado($id);
        $maestria = $postgradocons->verificamaestria($id);
        $formacion = "'".$tpn."','".$diplomado."','".$maestria."'";
        $patroncalifica = new Model_Patrondecalificacion();
        $resultado = $patroncalifica->califica3($formacion,$clasificacion,$proyecto,$area);
        if(empty($resultado)){
            $resultado = 0;
        }
        return $resultado;
    }
    
      
}
/**
 * Función que devuelve un numero en palabras.
 */

?>
