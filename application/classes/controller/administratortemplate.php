<?php
 defined('SYSPATH') or die('No direct script access.');

 class Controller_AdministratorTemplate extends Controller_Template
  {
     public $template = 'templates/administrator_layout';
     public function before()
      {
         parent::before();
         if($this->auto_render)
          {
            $this->template->title            = 'SiPAGO';
            $this->template->meta_keywords    = '';
            $this->template->meta_description = '';
            $this->template->meta_copywrite   = '';
            $this->template->header           = '';
            $this->template->content          = '';
            $this->template->menu             = '';
            $this->template->footer           = 'AEVivienda';
            $this->template->adminmenu        = '';
            $this->template->styles           = array();
            $this->template->scripts          = array();   
            $this->template->menutop          = '';
            $this->template->username         = '';
            $this->template->cargo            = '';
            $this->template->submenu          = View::factory('user/menu');
            $this->template->titulo           = '';                       
            $this->template->descripcion      = '';            
            $this->template->controller       = 'index';            
          }
      }
     /**
      * Fill in default values for our properties before rendering the output.
      */
     public function after()
      {
         if($this->auto_render)
          {             
             $styles                  = array(  
                                              //'media/css/bootstrap.min.css'=>'all',
                                              'media/css/jquery.jOrgChart.css'=>'all',
                                              'media/css/input.css'=>'screen',
                                              'media/css/tablas_admin.css'=>'screen',
                                              'media/css/print.css'=>'print',
                                              'media/css/main_admin.css'=>'screen',                                                                                            
                                              'media/css/style_admin.css'=>'screen',
                                              'media/css/flick/jquery-ui-1.8.21.custom.css'=>'all',                                              
                                              'media/css/modx-min.css'=>'screen',
                                              'media/css/reset.css'=>'screen'
                                              );
             $scripts                 = array(
                                              'media/js/jquery.jOrgChart.js',                                              
                                              'media/js/jquery-ui-1.8.21.custom.min.js',                                              
                                              'media/js/jquery.validate.js',                                                             
                                              'media/js/main.js',                                                             
                                              'media/js/jquery-1.10.1.min.js'
                                              );

             // Add defaults to template variables.
             $this->template->styles  = array_reverse(array_merge($this->template->styles, $styles));
             $this->template->scripts = array_reverse(array_merge($this->template->scripts, $scripts));
           }
         // Run anything that needs to run after this.
         parent::after();
      }
      public function save($entidad,$user,$accion)
	{
		$vitacora=ORM::factory('vitacora');                
                $vitacora->id_entidad=$entidad;
                $vitacora->id_usuario=$user;
                $vitacora->fecha_hora=date('Y-m-d H:i:s');
                $vitacora->accion_realizada=$accion;
                $vitacora->ip_usuario= Request::$client_ip;                         
                $vitacora->save();
	}
 }
?>