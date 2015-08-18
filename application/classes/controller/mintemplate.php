<?php
 defined('SYSPATH') or die('No direct script access.');
 
 class Controller_Mintemplate extends Controller_Template
  {
     public $template = 'templates/login';
     public function before()
      {
         // Run anything that need ot run before this.
         parent::before();
         if($this->auto_render)
          {
            // Initialize empty values
            $this->template->title            = 'AEVivienda';
            $this->template->meta_keywords    = '';
            $this->template->meta_description = '';
            $this->template->meta_copywrite   = '';
            $this->template->header           = '';
            $this->template->content          = '';
            $this->template->footer           = 'copyright AEV';
            $this->template->styles           = array();
            $this->template->scripts          = array();
            $this->template->errors           = array();
          }
      }

     /**
      * Fill in default values for our properties before rendering the output.
      */
     public function after()
      {
         if($this->auto_render)
          {
             // Define defaults
             $styles                  = array(                                              
                                              'media/template/css/style.default.css'=>'all',
                                              //'media/css/input.css'=>'screen'
                                              );
             $scripts                 = array(                                                                                                                                                       
                                              'media/template/js/custom.js',
                                              'media/template/js/jquery.cookie.js',
                                              'media/template/js/bootstrap.min.js',
                                              'media/template/js/modernizr.min.js',
                                              'media/template/js/jquery-ui-1.9.2.min.js',
                                              'media/template/js/jquery-migrate-1.1.1.min.js',
                                              'media/js/jquery.validate.js',
                                              'media/js/jquery-1.10.1.min.js',
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