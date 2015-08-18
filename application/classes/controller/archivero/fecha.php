<?php
class fechaController extends Controllerindex {
    private $fecha;
    private $anios;
	public function __construct() {
		$this->anios=array();
		require 'models/fechaModel.php';
		$this->fecha = new fechaModel();
	}
	
	public function listarAnios($ini=10,$fin=10) {		
		for($i=intval(date("Y"))-$ini;$i<intval(date("Y"))+$fin;$i++){
		$this->anios[]=$i;
		}
		return $this->anios;
	}
	public function vermes($i){
		
		
		}
}
?>