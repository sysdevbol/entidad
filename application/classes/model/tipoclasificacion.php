<?php
defined('SYSPATH') or die ('no tiene acceso');
//descripcion del modelo productos
class Model_Tipoclasificacion extends ORM{
    protected $_table_names_plural = false;

    public function listaTipoClasificacion($id) {
        $sql = "SELECT *
                FROM tipoclasificacion
                WHERE clasificacion_id = $id
                AND valido is null
                OR valido >= CURDATE()";
        return db::query(Database::SELECT, $sql)->execute()->as_array();
    }
    
}



?>
