<?php
defined('SYSPATH') or die('Acceso denegado');
class Controller_Rankingempresas{
    

    public function calificacionautomatica($idempresa,$users,$estado){
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
        $notafinal1 = $this->califica($idempresa,$proyecto,$deptocalifica);
        $calificaciones = ORM::factory('calificaciones');
        $calificaciones->id_empresa = $idempresa;
        $calificaciones->id_user = $userid;
        $calificaciones->calificacion = $notafinal1;
        $calificaciones->comentario = "Nota para proyectos en Vivienda Nueva (GENERADO POR EL SISTEMA)";
        $calificaciones->fecha_registro = date('Y-m-d H:i:s');
        $calificaciones->id_clasificacion="1";
        $calificaciones->save();
        $proyecto = 2;
        $notafinal2 = $this->califica($idempresa,$proyecto,$deptocalifica);
        $calificaciones = ORM::factory('calificaciones');
        $calificaciones->id_empresa = $idempresa;
        $calificaciones->id_user = $userid;
        $calificaciones->calificacion = $notafinal2;
        $calificaciones->comentario = "Nota para proyectos PMAR (GENERADO POR EL SISTEMA)";
        $calificaciones->fecha_registro = date('Y-m-d H:i:s');
        $calificaciones->id_clasificacion="1";
        $calificaciones->save();
      }  
  }
    public function califica($idempresa,$id_proyecto,$deptocalifica){
        $calificaciontotal = 0;
        $clasificacion = '1';//entidad ejecutora
        $proyecto = $id_proyecto;//vivienda nueva
        if($proyecto == '1'){
            
            $area = '1';//exp general por monto
            $calificaciontotal = $calificaciontotal+$this->expgeneral($idempresa,$clasificacion,$proyecto,$area);
            $area = '2';//exp especifica
            $calificaciontotal = $calificaciontotal+$this->expespecifica($idempresa,$clasificacion,$proyecto,$area);
            $area = '3';//exp especifica estado
            $calificaciontotal = $calificaciontotal+$this->expestado($idempresa,$clasificacion,$proyecto,$area);
            $area = '4';//exp especifica por depto
            $depto = $deptocalifica;//Departamento donde se califica
            $calificaciontotal = $calificaciontotal+$this->expdepto($idempresa,$clasificacion,$proyecto,$area,$depto);
            $area = '5';//identificacion
            $calificaciontotal = $calificaciontotal+$this->identificacion($idempresa,$clasificacion,$proyecto,$area);
            
        }
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
        return $calificaciontotal;
    }
    public function expgeneral($id,$clasificacion,$proyecto,$area){
        $experienciaent = new Model_Experienciaentidad();
        $montoexpgen = $experienciaent->montoexp($id);
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
    public function expespecifica($id,$clasificacion,$proyecto,$area){
        $experienciaent = new Model_Experienciaentidad();
        $cantanios = $experienciaent->cantaniosexp($id);
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
    public function expestado($id,$clasificacion,$proyecto,$area){
        $experienciaent = new Model_Experienciaentidad();
        $porcestado = $experienciaent->porcentajeconestado($id);
        if(empty($porcestado)){
            $porcestado = 0;    
        }
        $patroncalifica = new Model_Patrondecalificacion();
        $resultado = $patroncalifica->califica1($porcestado,$clasificacion,$proyecto,$area);
        if(empty($resultado)){
            $resultado = 0;
        }
        return $resultado;
    }
    public function expdepto($id,$clasificacion,$proyecto,$area,$depto){
        $experienciaent = new Model_Experienciaentidad();
        $porcdepto = $experienciaent->porcentajepordepto($id,$depto);
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
        $experienciaent = new Model_Experienciaentidad();
        $tipo = $experienciaent->entidadtipo($id);
        if(empty($tipo)){
            $tipo = 0;    
        }
        $patroncalifica = new Model_Patrondecalificacion();
        $resultado = $patroncalifica->califica2($tipo,$clasificacion,$proyecto,$area);
        if(empty($resultado)){
            $resultado = 0;
        }
        return $resultado;
    }
    public function exparea($id,$clasificacion,$proyecto,$area){
        $experienciaent = new Model_Experienciaentidad();
        $exparea = $experienciaent->areaexp($id);
        if(empty($exparea)){
            $exparea = 0;    
        }
        $patroncalifica = new Model_Patrondecalificacion();
        $resultado = $patroncalifica->califica3($exparea,$clasificacion,$proyecto,$area);
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
