<?php
 defined('SYSPATH') or die('No direct script access.');

 class Controller_IndexTemplate extends Controller_Template
  {
     public $template = 'templates/layout_administracion';
     public function before()
      {
         // Run anything that need ot run before this.
         parent::before();
         if($this->auto_render)
          {
            // Initialize empty values
            $this->template->title            = 'SiRPEC';
            $this->template->meta_keywords    = '';
            $this->template->meta_description = '';
            $this->template->meta_copywrite   = '';
            $this->template->header           = '';
            $this->template->content          = '';
            $this->template->menu             = '';
            $this->template->footer           = 'copyright AEVivienda';
            $this->template->adminmenu        = '';
            $this->template->styles           = array();
            $this->template->scripts          = array();   
            $this->template->menutop          = '';            
            $this->template->titulo           = '';            
            $this->template->descripcion      = '';            
            $this->template->menutop          = '';            
            $this->template->username          = '';            
            $this->template->submenu          = View::factory('user/menu');
            $this->template->controller       = 'index';            
            $this->template->theme            = '#modx-topbar{border-bottom: 2px solid #249cf5;} #bos-main-blocks h2 a,h2.titulo v,.colorcito {color:#249cf5;}#menu-left ul li a:hover,#menu-left ul li:hover {color:#fff; background: #249cf5; font-weight: bold; } html #modx-topnav ul.modx-subnav li a:hover {background-color:#249cf5;} input#searchsubmit:hover {background-color:#249cf5;} #icon-logo{background:#249cf5 url(/media/images/icon_user.png) scroll left no-repeat; }.button2{border: 1px solid#249cf5;background-color:#249cf5;}.button2:hover, .button2:focus {background:#249cf5;}.jOrgChart .node { background-color:#249cf5;}.widget .title {background: none repeat scroll 0 0 #249cf5;} legend {border: 1px solid #249cf5;}fieldset { border: 2px solid#249cf5;}.proveido {color:#249cf5;}';            
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
                                              'assets/css/style-responsive.css'=>'screen',
                                              'assets/css/style.css'=>'screen',   
                                              'assets/font-awesome/css/font-awesome.css'=>'screen',   
                                              'assets/css/bootstrap.css'=>'screen',
                                              );
             $scripts                 = array(                                                                                                                                            
                                                'assets/js/jquery.nicescroll.js',                                                                                                 
                                                'assets/js/jquery.scrollTo.min.js', 
                                                'assets/js/jquery.dcjqaccordion.2.7.js',     
                                                'assets/js/jquery.ui.touch-punch.min.js',                                                                                                 
                                                'assets/js/jquery-ui-1.9.2.custom.min.js',
                                                'assets/js/bootstrap.min.js',
                                                //'assets/js/jquery.js',
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