<?php
defined('SYSPATH') or die ('no tiene acceso');
//descripcion del modelo productos
class Model_Rubroarea extends ORM{
    protected $_table_names_plural = false;

    public function listaprrubrosareas($idproponente,$tipo,$clasificacion){
    	$sql = 'SELECT id, nombre, 
    	(CASE when((SELECT consultores.id_rubroarea from consultores where id = '.$idproponente.') REGEXP CONCAT("(^|,)",id,"(,|$)")) then 1 else 0 end) as "selected" 
		from rubroarea where rubroarea.id_clasificacion REGEXP "(^|,)'.$clasificacion.'(,|$)" and rubroarea.id_tipo REGEXP "(^|,)'.$tipo.'(,|$)"';
		$rubroarea = array();
		$result = db::query(Database::SELECT, $sql)->execute();
		foreach ($result as $r) {                    
                        $rubroarea[$r['id']] = array(
                            'id' => $r['id'],
                            'nombre' => $r['nombre'],
                            'selected' => $r['selected'],
                        );
                    }
           return array_values($rubroarea); 
    }
    
}



?>
