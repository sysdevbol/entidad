<?php
 defined('SYSPATH') or die('No direct script access.');

 class Controller_TemplateEmpresasLibre extends Controller_Template
  {
     public $template = 'templates/layoutlibre';
     public function before()
      {
         parent::before();
         if($this->auto_render)
          {
            $this->template->title            = 'SiREM';
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
            $this->template->submenu          = '';
            $this->template->titulo           = '';                       
            $this->template->descripcion      = '';            
            $this->template->controller       = 'index';            
            $this->template->theme            = '#modx-topbar{border-bottom: 2px solid #249cf5;} #bos-main-blocks h2 a,h2.titulo v,.colorcito {color:#249cf5;}#menu-left ul li a:hover,#menu-left ul li:hover {color:#fff; background: #249cf5; font-weight: bold; } html #modx-topnav ul.modx-subnav li a:hover {background-color:#249cf5;} input#searchsubmit:hover {background-color:#249cf5;} #icon-logo{background:#249cf5 url(/media/images/icon_user.png) scroll left no-repeat; }.button2{border: 1px solid#249cf5;background-color:#249cf5;}.button2:hover, .button2:focus {background:#249cf5;}.jOrgChart .node { background-color:#249cf5;}.widget .title {background: none repeat scroll 0 0 #249cf5;} legend {border: 1px solid #249cf5;}fieldset { border: 2px solid#249cf5;}.proveido {color:#249cf5;}';
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
             $styles                  = array(
                                              'media/template/jquery.css'=>'screen',
                                              'media/template/jquery_002.css'=>'screen',
                                              'media/template/concursal-web-mobile.css'=>'screen',
                                              'media/template/concursal-web-bootstrap-3.css'=>'screen',
                                              'media/template/concursal-web.css'=>'screen',
                                              'media/template/corpme-bootstrap-3.css'=>'screen',
                                              'media/template/corpme.css'=>'screen',
                                              'media/template/bootstrap-glyphicons.css'=>'screen',
                                              'media/template/bootstrap.css'=>'screen',
                                              );
             $scripts                 = array(  
                                                'media/template/jquery_002.js',
                                                'media/template/bootstrap.js',
                                                'media/template/jquery_003.js',
                                                
                                                'media/template/corpme-tools.js',
                                                'media/template/concursal-web.js',
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