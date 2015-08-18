<?php
defined('SYSPATH') or die('Acceso denegado');
class Controller_buscador extends Controller_index{

    public function action_index() {
        $gestiones = ORM::factory('buscador');
        $gestiones = $gestiones->find_all();
        $this->template->content = View::factory('buscador')
                ->bind('errors', $errors);
               // ->bind('modalidades', $modalidades);
    
    }
}
?>
