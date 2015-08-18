<?php
defined('SYSPATH') or die ('no tiene acceso');
//descripcion del modelo productos
class Model_Clasificaciones extends ORM{
    protected $_table_names_plural = false;

    public function listarClasificaciones() {
        $sql = "SELECT *
                FROM clasificaciones
                WHERE valido is null
                OR valido >= CURDATE()
                ORDER BY orden ASC";
        return db::query(Database::SELECT, $sql)->execute()->as_array();
    }
    
}



?>
